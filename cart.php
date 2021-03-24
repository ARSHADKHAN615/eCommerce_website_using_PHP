<?php
// C 
require "top.inc.php";
?>

<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(html/5011439_about-bg.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.html">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">shopping cart</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="cart-main-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form action="#">
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">products</th>
                                    <th class="product-name">name of products</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- CHECK AND SHOW CART ITEM  -->
                                <?php
                                if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                                    foreach ($_SESSION['cart'] as $key => $val) {
                                        $productArr =  get_product('latest', '', "", $key, "", "", $connection);
                                        $pname = $productArr[0]['name'];
                                        $mrp = $productArr[0]['mrp'];
                                        $price = $productArr[0]['price'];
                                        $image = $productArr[0]['image'];
                                        $qty = $val['qty'];
                                ?>
                                        <tr>
                                            <td class="product-thumbnail"><a href="#"><img src="<?php echo  PRODUCT_IMAGE_SITE_PATH . $image ?>" alt="product img" /></a></td>
                                            <td class="product-name"><a href="#"><?php echo $pname ?></a>
                                                <ul class="pro__prize">
                                                    <li class="old__prize"><?php echo $mrp ?></li>
                                                    <li><?php echo $price ?></li>
                                                </ul>
                                            </td>
                                            <td class="product-price"><span class="amount"><?php echo $price ?></span></td>
                                            <td class="product-quantity"><input type="number" id="<?php echo $key ?>qty" value="<?php echo $qty ?>" />
                                                <br><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','update')">Update</a>
                                            </td>
                                            <td class="product-subtotal"><?php echo $qty * $price ?></td>
                                            <td class="product-remove parent-find"><a href="javascript:void(0)" onclick="manage_cart('<?php echo  $key ?>','remove')"><i class="icon-trash icons"></i></a></td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='6'><h1>Empty Cart</h1></td><tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="buttons-cart--inner">
                                <div class="buttons-cart">
                                    <a href="index.php">Continue Shopping</a>
                                </div>
                                <div class="buttons-cart checkout--btn">
                                    <a href="checkout.php">checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
require "footer.inc.php";
?>

<script>
    function manage_cart(id, type) {
        const product_remove = event.target.parentNode.parentNode.parentNode;
        let qty = $("#" + id + "qty").val();
        $.ajax({
            type: "POST",
            url: "manage_cart.php",
            data: {
                "p_id": id,
                "qty": qty,
                "type": type,
            },
            success: function(response) {
                if (type == "remove") {
                    msg("Deleted Successfully", "red", "white");
                    $(product_remove).hide();
                } else {
                    window.location.href = "cart.php";
                    // msg("Update Successfully", "green", "white");
                }
                $("#cart").html(response);
            }
        });
    }
</script>