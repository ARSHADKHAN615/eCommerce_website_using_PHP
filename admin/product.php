<?php
// c 
require "top.inc.php";
// require "function.inc.php";

// ACTIVE AND DEACTIVE PRODUCTS 
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = $_GET['type'];
    if ($type == "status") {
        $operation = $_GET['operation'];
        $id = $_GET['id'];
        if ($operation == "active") {
            $status = 1;
        } else {
            $status = 0;
        }
        $update_status_sql = "UPDATE product SET product_status=$status WHERE product_id=$id";
        mysqli_query($connection, $update_status_sql);
    }
}

// DELETE PRODUCTS 
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = $_GET['type'];
    if ($type == "delete") {
        $id = $_GET['id'];
        $delete_product_sql = "DELETE FROM product WHERE product_id=$id";
        mysqli_query($connection, $delete_product_sql);
    }
}


// FETCH PRODUCTS
$fetch_product_sql = "SELECT * FROM product INNER JOIN category ON product.category_id=category.id";
// $fetch_product_sql = "SELECT * FROM product";
$result = mysqli_query($connection, $fetch_product_sql);
?>


<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Products</h3>
                        <a href="manage_product.php" class="btn btn-primary mt-3">Add Products</a>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>ID </th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Img</th>
                                        <th>MRP</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Status</th>
                                        <th>Modify</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <tr>
                                                <td class="serial"><?php echo $i += 1 ?></td>
                                                <td> <?php echo $row['product_id'] ?> </td>
                                                <td> <?php echo $row['category'] ?> </td>
                                                <td> <?php echo $row['name'] ?> </td>
                                                <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image'] ?>" alt="AA"> </td>
                                                <td> <?php echo $row['mrp'] ?> </td>
                                                <td> <?php echo $row['price'] ?> </td>
                                                <td> <?php echo $row['qty'] ?> </td>
                                                <td> <?php
                                                        status($row['product_status'], 1, $row['product_id']);
                                                        ?></td>
                                                <td>
                                                    <?php
                                                    echo "<a href='manage_product.php?type=edit&id={$row['product_id']}' class='btn btn-primary mx-3'>Edit</a>" . "<a href='?type=delete&id={$row['product_id']}' class='btn btn-danger'>Delete</a>";
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php }
                                    } else {
                                        not_found(10);
                                    }
                                    ?>
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