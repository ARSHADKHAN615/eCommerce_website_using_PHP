<?php
require "top.inc.php";

if (isset($_GET['id'])) {
    $product_id = htmlentities($_GET['id']);
    $get_product = get_product('latest', 2, "", $product_id, "", "", $connection);
} else {
    $get_product = get_product('latest', 4, "", "", "", "", $connection);
}

?>

<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(html/5011439_about-bg.jpg)  no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.php">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <a class="breadcrumb-item" href="category.php?id=<?php echo $get_product[0]['category_id'] ?>"><?php echo $get_product[0]['category'] ?></a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active"><?php echo $get_product[0]['name'] ?></span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<section class="htc__product__details bg__white ptb--100">
    <div class="htc__product__details__top">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                    <div class="htc__product__details__tab__content">
                        <div class="product__big__images">
                            <div class="portfolio-full-image tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                    <img src="<?php echo  PRODUCT_IMAGE_SITE_PATH . $get_product[0]['image'] ?>" alt="full-image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                    <div class="ht__product__dtl">
                        <h2><?php echo $get_product[0]['name'] ?></h2>
                        <ul class="pro__prize">
                            <li class="old__prize"><?php echo $get_product[0]['mrp'] ?></li>
                            <li><?php echo $get_product[0]['price'] ?></li>
                        </ul>
                        <p class="pro__info"><?php echo $get_product[0]['short_desc'] ?> </p>
                        <div class="ht__pro__desc">
                            <div class="sin__desc">
                                <p><span>Availability:</span> In Stock</p>
                            </div>
                            <div class="sin__desc">
                                <p><span>Qty:</span>
                                    <select name="" id="qty">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </p>
                            </div>
                            <div class="sin__desc align--left">
                                <p><span>Categories:</span></p>
                                <ul class="pro__cat__list">
                                    <li><a href="#"><?php echo $get_product[0]['category'] ?></a></li>
                                </ul>
                            </div>

                        </div>
                        <div class="cr__btn">
                            <a href="#" onclick="manage_cart('<?php echo $get_product[0]['product_id'] ?>','add')">Add Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<section class=" htc__produc__decription bg__white">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <!-- Start List And Grid View -->
                <ul class="pro__details__tab" role="tablist">
                    <li role="presentation" class="description active"><a href="#description" role="tab" data-toggle="tab">description</a></li>
                </ul>
                <!-- End List And Grid View -->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="ht__pro__details__content">
                    <!-- Start Single Content -->
                    <div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
                        <div class="pro__tab__content__inner">
                            <p>Formfitting clothing is all about a sweet spot. That elusive place where an item is tight but not clingy, sexy but not cloying, cool but not over the top. Alexandra Alvarez’s label, Alix, hits that mark with its range of comfortable,
                                minimal, and neutral-hued bodysuits.
                            </p>
                            <h4 class="ht__pro__title">Description</h4>
                            <p><?php echo $get_product[0]['description'] ?></p>
                            <h4 class="ht__pro__title">Standard Featured</h4>
                            <p> </p>
                        </div>
                    </div>
                    <!-- End Single Content -->

                </div>
            </div>
        </div>
    </div>
</section>

<?php
require "footer.inc.php";
?>

<script>
    function manage_cart(id, type) {
        let qty = $("#qty").val();
        $.ajax({
            type: "POST",
            url: "manage_cart.php",
            data: {
                "p_id": id,
                "qty": qty,
                "type": type,
            },
            success: function(response) {
                $(".htc__qua").html(response);
            }
        });
    }
</script>