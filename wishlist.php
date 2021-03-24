<?php
// C 
require "top.inc.php";
if (!isset($_SESSION['USER_ID'])) {
    echo "<script>
               window.location.href = 'index.php';
          </script>";
} else {
    $user_id = $_SESSION['USER_ID'];
}


$sql = "SELECT whistle.*,product.product_id,product.name,product.image,product.mrp,product.price FROM whistle INNER JOIN product ON whistle.produect_id=product.product_id WHERE whistle.user_id=$user_id";
$result = mysqli_query($connection, $sql);
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
                            <span class="breadcrumb-item active">Wishlist</span>
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

                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- CHECK AND SHOW CART ITEM  -->
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td class="product-thumbnail"><a href="#"><img src="<?php echo  PRODUCT_IMAGE_SITE_PATH . $row['image'] ?>" alt="product img" /></a></td>
                                        <td class="product-name"><a href="#"><?php echo $row['name'] ?></a>
                                            <ul class="pro__prize">
                                                <li class="old__prize"><?php echo $row['mrp'] ?></li>
                                                <li><?php echo $row['price'] ?></li>
                                            </ul>
                                        </td>
                                        <td class="product-price"><span class="amount"><?php echo $row['price'] ?></span></td>
                                        <td class="product-remove parent-find"><a href="wishlist.php?wishlist_id=<?php echo $row['id'] ?>"><i class="icon-trash icons"></i></a></td>
                                    </tr>
                                <?php
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
                $(".htc__qua").html(response);
            }
        });
    }
</script>