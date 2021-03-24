<?php
require "top.inc.php";
$search = htmlentities($_GET['search']);
$get_product = get_product('latest', 5,  "", "", $search, "", $connection);

?>


<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(html/5011439_about-bg.jpg) no-repeat scroll center center / cover ;">
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
                                <a class="breadcrumb-item" href="category.php?id=<?php echo $get_product[0]['category_id'] ?>"><?php echo $get_product[0]['category'] ?>
                                    <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                    <a class="breadcrumb-item"><?php echo $_GET['search'] ?></a>
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