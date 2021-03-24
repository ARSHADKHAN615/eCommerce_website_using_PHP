<?php
require "top.inc.php";
?>





<div class="slider__container slider--one bg__cat--3">
    <div class="slide__container slider__activation__wrap owl-carousel">
        <div class="single__slide animation__style01 slider__fixed--height">
            <div class="container">
                <div class="row align-items__center">
                    <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                        <div class="slide">
                            <div class="slider__inner">
                                <h2>collection <?php echo date("Y") ?></h2>
                                <h1>NICE CHAIR</h1>
                                <div class="cr__btn">
                                    <a href="product.php">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                        <div class="slide__thumb">
                            <img src="images/1.png" alt="slider images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single__slide animation__style01 slider__fixed--height">
            <div class="container">
                <div class="row align-items__center">
                    <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                        <div class="slide">
                            <div class="slider__inner">
                                <h2>collection <?php echo date("Y") ?></h2>
                                <h1>NICE CHAIR</h1>
                                <div class="cr__btn">
                                    <a href="cart.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                        <div class="slide__thumb">
                            <img src="images/2.png" alt="slider images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slide -->
    </div>
</div>



<!-- CODE START  -->
<section class="htc__category__area ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title--2 text-center">
                    <h2 class="title__line">New Arrivals</h2>
                    <p>But I must explain to you how all this mistaken idea</p>
                </div>
            </div>
        </div>
        <div class="htc__product__container">
            <div class="row">
                <div class="product__list clearfix mt--30">
                    <!-- FETCH DATA FROM DB  -->
                    <?php
                    $get_product = get_product('latest', 4, "", "", "", "", $connection);
                    foreach ($get_product as $value) {
                    ?>
                        <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                            <div class="category">
                                <div class="ht__cat__thumb">
                                    <a href="product.php?id=<?php echo $value['product_id'] ?>">
                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $value['image'] ?>" alt="product images">
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
                        <!-- End Single Category -->
                    <?php
                    }
                    ?>
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
        let qty = 1;
        $.ajax({
            type: "POST",
            url: "manage_cart.php",
            data: {
                "p_id": id,
                "qty": qty,
                "type": type,
            },
            success: function(response) {
                if (type == "add") {
                    msg("Add To Cart Successfully", "green", "white");
                }
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