<?php
// C 
require "top.inc.php";

// FETCH USER FROM DB 
$fetch_users_sql = "SELECT * FROM users ORDER BY id DESC ";
$result = mysqli_query($connection, $fetch_users_sql);
?>


<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Orders</h3>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">

                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Order ID</th>
                                        <th class="product-name"><span class="nobr">Order Date</span></th>
                                        <th class="product-price"><span class="nobr"> Address </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Payment Type </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Order Status </span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- SHOW DETAILS   -->
                                    <?php
                                    $res = mysqli_query($connection, "SELECT `order`.*,order_status.name FROM `order`,order_status WHERE order_status.id=`order`.order_status");
                                    // $res = mysqli_query($connection, "SELECT `order`.*,order_status.name FROM `order` JOIN order_status ON order_status.id=`order`.order_status WHERE user_id='$uid'");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <tr>
                                            <td class="product-add-to-cart"><a href="order_master_details.php?id=<?php echo $row['id'] ?>"> <?php echo $row['id'] ?></a></td>
                                            <td class="product-name"><?php echo $row['add-on'] ?></td>
                                            <td class="product-name">
                                                <?php echo $row['address'] ?><br />
                                                <?php echo $row['city'] ?><br />
                                                <?php echo $row['pincode'] ?>
                                            </td>
                                            <td class="product-name"><?php echo $row['payment_type'] ?></td>
                                            <td class="product-name"><?php echo $row['payment_status'] ?></td>
                                            <td class="product-name"><?php echo $row['name'] ?></td>

                                        </tr>
                                    <?php } ?>
                                </tbody>

                            </table>
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