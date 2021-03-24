<?php
require "top.inc.php";
$cat_id = htmlentities($_GET['id']);
$sort_sql = "";


$price_hight = "";
$price_low = "";
$new = "";
$old = "";

if (isset($_GET['sort'])) {
    $sort = htmlentities($_GET['sort']);
    if ($sort == "price_hight") {
        $sort_sql = " ORDER BY product.price DESC";
        $price_hight = "selected";
    }
    if ($sort == "price_low") {
        $sort_sql = " ORDER BY product.price ASC";
        $price_low = "selected";
    }
    if ($sort == "new") {
        $sort_sql = " ORDER BY product.product_id DESC";
        $new = "selected";
    }
    if ($sort == "old") {
        $sort_sql = " ORDER BY product.product_id ASC";
        $old = "selected";
    }
}
$get_product = get_product('', 5, $cat_id, "", "", $sort_sql, $connection);

?>


<div class="ht__bradcaump__area" style="background: rgb(0, 0, 0) url(html/5011439_about-bg.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.php">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <?php
                            if (count($get_product) > 0) {
                            ?>
                                <a class="breadcrumb-item" href="category.php?id=<?php echo $get_product[0]['category_id'] ?>"><?php echo $get_product[0]['category'] ?></a>
                            <?php
                            }
                            ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="htc__product__grid bg__white ptb--100">
    <div class="container">
        <div class="row">


            <?php
            if (count($get_product) > 0) {
            ?>

                <div class="col-lg-12   col-md-12   col-sm-12 col-xs-12">
                    <div class="htc__product__rightidebar">
                        <div class="htc__grid__top">
                            <div class="htc__select__option">
                                <select class="ht__select" onchange="sort_product_drop('<?php echo $cat_id ?>','<?php echo SITE_PATH ?>')" id="sort_product">
                                    <option value="">Default softing</option>
                                    <option value="price_hight" <?php echo $price_hight ?>>Sort by price_hight</option>
                                    <option value="price_low" <?php echo $price_low ?>>Sort by price_low</option>
                                    <option value="new" <?php echo $new ?>>Sort by new</option>
                                    <option value="old" <?php echo $old ?>>Sort by old</option>
                                </select>
                            </div>


                            <ul class="view__mode" role="tablist">
                                <li role="presentation" class="grid-view active"><a href="#grid-view" role="tab" data-toggle="tab"><i class="zmdi zmdi-grid"></i></a></li>
                                <li role="presentation" class="list-view"><a href="#list-view" role="tab" data-toggle="tab"><i class="zmdi zmdi-view-list"></i></a></li>
                            </ul>

                        </div>
                        <!-- Start Product View -->
                        <div class="row">
                            <div class="shop__grid__view__wrap">
                                <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">

                                    <?php
                                    foreach ($get_product as $value) {
                                    ?>
                                        <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                            <div class="category">
                                                <div class="ht__cat__thumb">
                                                    <a href="product.php?id=<?php echo $value['product_id'] ?>">
                                                        <img src=" media/<?php echo $value['image'] ?>" alt="product images">
                                                    </a>
                                                </div>
                                                <div class="fr__hover__info">
                                                    <ul class="product__action">
                                                        <li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $value['product_id'] ?>','add')"><i class="icon-heart icons"></i></a></li>
                                                        <li><a href="javascript:void(0)" onclick="manage_cart('<?php echo $value['product_id'] ?>','add')"><i class="icon-handbag icons"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="fr__product__inner">
                                                    <h4><a href="product.php?id=<?php echo $value['product_id'] ?>"> <?php echo $value['name'] ?></a></h4>
                                                    <ul class="fr__pro__prize">
                                                        <li class="old__prize">$<?php echo $value['mrp'] ?></li>
                                                        <li>$ <?php echo $value['price'] ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <!-- <div class="cr__btn">
                                        <a href="#" onclick="manage_cart('<?php echo $get_product[0]['product_id'] ?>','add')">Add Cart</a>
                                    </div> -->
                                </div>
                                <div role="tabpanel" id="list-view" class="single-grid-view tab-pane fade clearfix">
                                    <div class="col-xs-12">
                                        <div class="ht__list__wrap">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


            <?php
            } else {
                not_found(0);
            }

            ?>
        </div>
    </div>
</section>
<?php
require "footer.inc.php";
?>
<script>
    function manage_cart(id, type) {
        let qty = 2;
        $.ajax({
            type: "POST",
            url: "manage_cart.php",
            data: {
                "p_id": id,
                "qty": qty,
                "type": type,
            },
            success: function(response) {
                $("#cart").html(response);
            }
        });
    }

    function sort_product_drop(cat_id, path) {
        let sort_product = $("#sort_product").val();
        console.log(sort_product + cat_id);
        window.location.href = path + "category.php?id=" + cat_id + "&sort=" + sort_product;
    }


    function wishlist_manage(pid, type) {
        $.ajax({
            type: "POST",
            url: "wishlist_manage.php",
            data: {
                "p_id": pid,
                "type": type,
            },
            success: function(response) {
                if (response == "not_login") {
                    window.location.href = "login.php";
                }
                if (response == "Already Existed") {
                    msg("Already Existed", "red", "white");
                }
                if (response == Number) {
                    msg("Add Successfully", "green", "white");
                }
                if (response != "Already Existed") {
                    $("#wishlist").html(response);
                }
            }
        });
    }
</script>