<?php
// C 
require "top.inc.php";


// UPDATE ODER STATUS AND PAYMENT STATUS THEN ODER_ID 
$order_id = htmlentities($_GET['id']);
if (isset($_POST['update_order_status'])) {
    $update_order_status = $_POST['update_order_status'];
    if ($update_order_status == '5') {
        mysqli_query($connection, "update `order` set order_status='$update_order_status',payment_status='Success' where id='$order_id'");
    } else {
        mysqli_query($connection, "update `order` set order_status='$update_order_status' where id='$order_id'");
    }
}


?>


<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Order Details</h3>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Product Name</th>
                                        <th class="product-thumbnail">Product Image</th>
                                        <th class="product-name">Qty</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-price">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // $sql = "SELECT order_details.*,product.name,product.image FROM order_details JOIN product ON order_details.produect_id=product.product_id WHERE order_details.order_id='$order_id'";
                                    // $res = mysqli_query($connection, $sql);

                                    $res = mysqli_query($connection, "SELECT distinct(order_details.id),order_details.*,product.name,product.image,`order`.address,`order`.city,`order`.pincode,`order`.order_status FROM order_details,product,`order` WHERE order_details.order_id='$order_id' AND order_details.produect_id=product.product_id GROUP by order_details.id");

                                    $total_price = 0;
                                    while ($row = mysqli_fetch_assoc($res)) {

                                        $address = $row['address'];
                                        $city = $row['city'];
                                        $pincode = $row['pincode'];
                                        $order_status = $row['order_status'];
                                        $total_price = $total_price + ($row['qty'] * $row['price']);
                                    ?>
                                        <tr>
                                            <td class="product-name"><?php echo $row['name'] ?></td>
                                            <td class="product-name"> <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image'] ?>"></td>
                                            <td class="product-name"><?php echo $row['qty'] ?></td>
                                            <td class="product-name"><?php echo $row['price'] ?></td>
                                            <td class="product-name"><?php echo $row['qty'] * $row['price'] ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="product-name">Total Price</td>
                                        <td class="product-name"><?php echo $total_price ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="address">
                                <!-- UPDATE ORDER STATUS  -->
                                <strong>Address</strong>
                                <?php echo $address ?>, <?php echo $city ?>, <?php echo $pincode ?><br /><br />
                                <strong>Order Status</strong>
                                <?php
                                $order_status_arr = mysqli_fetch_assoc(mysqli_query($connection, "SELECT order_status.name from order_status,`order` where `order`.id='$order_id' and `order`.order_status=order_status.id"));
                                echo $order_status_arr['name'];
                                ?>

                                <div>
                                    <form method="post">
                                        <select class="form-control" name="update_order_status" required>
                                            <option value="">Select Status</option>
                                            <?php
                                            $res = mysqli_query($connection, "SELECT * FROM order_status");
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                if ($row['id'] == $order_status) {
                                                    echo "<option selected value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                                } else {
                                                    echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="submit" class="form-control btn btn-primary d-inline" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require "footer.inc.php";
?>