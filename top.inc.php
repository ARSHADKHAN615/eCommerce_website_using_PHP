<?php
// C 
require "connection.inc.php";
require "function.inc.php";
// FETCH CATEGORY AND SHOW NAVBAR 

$fetch_record = "SELECT * FROM category where status=1";
$result = mysqli_query($connection, $fetch_record) or die("Failed");
$cat_arr = [];
while ($row1 = mysqli_fetch_assoc($result)) {
    $cat_arr[] = $row1;
}

require "add_to_cart.inc.php";
$obj = new add_to_cart();
$totalProduct = $obj->totalProduct();



if (isset($_SESSION['USER_ID'])) {
    $user_id = $_SESSION['USER_ID'];

    if (isset($_GET['wishlist_id'])) {
        $id = $_GET['wishlist_id'];
        mysqli_query($connection, "DELETE FROM whistle WHERE id=$id AND user_id=$user_id");
    }

    $sql = "SELECT whistle.*,product.product_id,product.name,product.image,product.mrp,product.price FROM whistle INNER JOIN product ON whistle.produect_id=product.product_id WHERE whistle.user_id=$user_id";
    $wishlist_num = mysqli_num_rows(mysqli_query($connection, $sql));
}
?>



<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Asbab - eCommerce HTML5 Templatee</title>
    <meta name="description" content="">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/core.css">
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <style>
        .msg_box {
            width: 200px;
            padding: 10px;
            position: fixed;
            z-index: 100;
            top: 14%;
            right: 4%;
            display: inline;
            font-size: 16px;
            font-family: 'Franklin Gothic Medium';
            border-radius: 0.5rem;
            animation: msg 0.5s;
        }

        @keyframes msg {
            from {
                transform: translate(400px);
            }

            to {
                transform: translateX(0px);
            }

        }
    </style>
</head>

<body>


    <div class="wrapper">
        <header id="htc__header" class="htc__header__area header--one">
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                                <div class="logo">
                                    <a href="index.php"><img src="images/web.png" alt="logo images" width="80px"></a>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8 col-sm-5 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="index.php">Home</a></li>
                                        <?php
                                        foreach ($cat_arr as $list) {
                                            echo "<li><a href='category.php?id={$list['id']}'>{$list['category']}</a></li>";
                                        }
                                        ?>
                                        <li><a href="contact.php">contact</a></li>
                                    </ul>
                                </nav>

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <?php
                                            foreach ($cat_arr as $list) {
                                                echo "<li><a href='category.php?id={$list['id']}'>{$list['category']}</a></li>";
                                            }
                                            ?>
                                            <li><a href="contact.php">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2 col-sm-4 col-xs-4">
                                <div class="header__right">
                                    <div class="header__search search search__open">
                                        <a href="#"><i class="icon-magnifier icons"></i></a>
                                    </div>
                                    <div class="header__account">
                                        <?php
                                        if (isset($_SESSION['USER_LOGIN'])) {
                                            echo '<a href="myOrder.php">MyOrder</a>';
                                        } else {
                                            echo '<a href="login.php">Login/Register</a>';
                                        }
                                        ?>
                                    </div>
                                    <div class="header__account">
                                        <?php
                                        if (isset($_SESSION['USER_LOGIN'])) {
                                            echo '<a href="logout.php">Logout</a>';
                                        }
                                        ?>
                                    </div>
                                    <div class="htc__shopping__cart" style="margin-right: 20px;">
                                        <a class="#" href="cart.php"><i class="icon-handbag icons"></i></a>
                                        <a href="cart.php"><span class="htc__qua" id="cart"><?php echo $totalProduct ?></span></a>
                                    </div>
                                    <?php
                                    if (isset($_SESSION['USER_LOGIN'])) {
                                    ?>
                                        <div class="htc__shopping__cart">
                                            <a class="#" href="wishlist.php"><i class="icon-heart icons"></i></a>
                                            <a href="wishlist.php"><span class="htc__qua" id="wishlist"><?php echo $wishlist_num ?></span></a>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
        </header>
        <div class="body__overlay"></div>
        <div class="offset__wrapper">
            <div class="search__area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search__inner">
                                <form action="search.php" method="get">
                                    <input placeholder="Search here... " type="text" name="search">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shopping__cart">
                <div class="shopping__cart__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="shp__cart__wrap">
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="images/product-2/sm-smg/1.jpg" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.html">BO&Play Wireless Speaker</a></h2>
                                <span class="quantity">QTY: 1</span>
                                <span class="shp__price">$105.00</span>
                            </div>
                            <div class="remove__btn">
                                <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="images/product-2/sm-smg/2.jpg" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.html">Brone Candle</a></h2>
                                <span class="quantity">QTY: 1</span>
                                <span class="shp__price">$25.00</span>
                            </div>
                            <div class="remove__btn">
                                <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                    </div>
                    <ul class="shoping__total">
                        <li class="subtotal">Subtotal:</li>
                        <li class="total__price">$130.00</li>
                    </ul>
                    <ul class="shopping__btn">
                        <li><a href="cart.html">View Cart</a></li>
                        <li class="shp__checkout"><a href="checkout.html">Checkout</a></li>
                    </ul>
                </div>
            </div>

        </div>