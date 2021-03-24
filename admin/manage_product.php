<?php
// C 
require "top.inc.php";

$exist = "";
$ima_require = "required";
// INSERT PRODUCT
if (isset($_POST['submit']) && $_POST['up_id'] == "") {
   $product_name = get_safe_value($connection, $_POST['product']);
   $check_pro_sql = "SELECT name FROM product WHERE name='$product_name'";
   $result = mysqli_query($connection, $check_pro_sql);
   if (mysqli_num_rows($result) > 0) {
      $exist = "Product Name All Ready Exist";
   } else {
      // CHECK IMAGE FORMAT 
      if ($_FILES['img']['type'] != "" && $_FILES['img']['type'] != "image/png" && $_FILES['img']['type'] != "image/jpg" && $_FILES['img']['type'] != "image/jpeg") {
         $exist = "Please Select Valid Format";
      } else {

         $categories_id = get_safe_value($connection, $_POST['categories_id']);
         $mrp = get_safe_value($connection, $_POST['mrp']);
         $price = get_safe_value($connection, $_POST['price']);
         $qty = get_safe_value($connection, $_POST['qty']);

         $image = rand(1111111, 9999999) . '_' . $_FILES['img']['name'];
         move_uploaded_file($_FILES['img']['tmp_name'],  PRODUCT_IMG_SERVER_PATH . $image);

         $short_desc = get_safe_value($connection, $_POST['short_desc']);
         $description = get_safe_value($connection, $_POST['description']);
         $meta_title = get_safe_value($connection, $_POST['meta_title']);
         $meta_desc = get_safe_value($connection, $_POST['meta_desc']);
         $meta_keyword = get_safe_value($connection, $_POST['meta_keyword']);

         $insert_pro_sql = "INSERT INTO `product`(`category_id`, `name`, `mrp`, `price`, `qty`, `image`, `short_desc`, `description`, `meta_title`, `meta_desc`, `meta_keyword`, `product_status`) VALUES ('$categories_id','$product_name','$mrp','$price','$qty','$image','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword',1)";


         mysqli_query($connection, $insert_pro_sql);
         header("location:" . $hostUrl . "admin/product.php");
      }
   }
}


// UPDATE PRODUCT IN DB WITH CHECK DATA FROM DB

if (isset($_POST['submit']) && $_POST['up_id'] != "") {
   $id = $_POST['up_id'];
   $product_name = get_safe_value($connection, $_POST['product']);
   $check_pro_sql = "SELECT * FROM product WHERE name='$product_name'";
   $result = mysqli_query($connection, $check_pro_sql);
   if (mysqli_num_rows($result) > 0) {
      $exist = "Product Name All Ready Exist";
   } else {

      // CHECK IMAGE FORMAT 
      if ($_FILES['img']['type'] != "" && $_FILES['img']['type'] != "image/png" && $_FILES['img']['type'] != "image/jpg" && $_FILES['img']['type'] != "image/jpeg") {
         $exist = "Please Select Valid Format";
      } else {

         $categories_id = get_safe_value($connection, $_POST['categories_id']);
         $mrp = get_safe_value($connection, $_POST['mrp']);
         $price = get_safe_value($connection, $_POST['price']);
         $qty = get_safe_value($connection, $_POST['qty']);
         $short_desc = get_safe_value($connection, $_POST['short_desc']);
         $description = get_safe_value($connection, $_POST['description']);
         $meta_title = get_safe_value($connection, $_POST['meta_title']);
         $meta_desc = get_safe_value($connection, $_POST['meta_desc']);
         $meta_keyword = get_safe_value($connection, $_POST['meta_keyword']);


         if ($_FILES['img']['name'] != "") {
            $image = rand(1111111, 9999999) . '_' . $_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'], PRODUCT_IMG_SERVER_PATH . $image);

            $update_pro_sql = "UPDATE `product` SET `category_id`=$categories_id,`name`='$product_name',`mrp`=$mrp,`price`=$price,`qty`=$qty,`image`='$image',`short_desc`='$short_desc',`description`='$description',`meta_title`='$meta_title',`meta_desc`='$meta_desc',`meta_keyword`='$meta_keyword' WHERE `product_id`=$id";
         } else {
            $update_pro_sql = "UPDATE `product` SET `category_id`=$categories_id,`name`='$product_name',`mrp`=$mrp,`price`=$price,`qty`=$qty, `short_desc`='$short_desc',`description`='$description',`meta_title`='$meta_title',`meta_desc`='$meta_desc',`meta_keyword`='$meta_keyword' WHERE `product_id`=$id";
         }




         mysqli_query($connection, $update_pro_sql) or die("Failed");
         header("location:" . $hostUrl . "admin/product.php");
      }
   }
}


// CHECK DATA FROM UPDATE OPERATION 
$mess = "";
$disable = "";
$update_id = "";

$mrp = "";
$price = "";
$qty = "";
$image = "";
$short_desc = "";
$description = "";
$meta_title = "";
$meta_desc = "";
$meta_keyword = "";

if (isset($_GET['type']) && $_GET['type'] == "edit") {
   if (isset($_GET['id']) && $_GET['id'] != "") {
      $ima_require = "";
      $id = $_GET['id'];
      $fetch_record = "SELECT * FROM product WHERE product_id=$id";
      $result = mysqli_query($connection, $fetch_record);
      $row = mysqli_fetch_assoc($result);

      if (mysqli_num_rows($result) == 1) {
         $mess = $row['name'];
         $disable = "";
         $update_id = $row['product_id'];

         $mrp = $row['mrp'];
         $price = $row['price'];
         $qty = $row['qty'];
         $short_desc = $row['short_desc'];
         $description = $row['description'];
         $meta_title = $row['meta_title'];
         $meta_desc = $row['meta_desc'];
         $meta_keyword = $row['meta_keyword'];
      } else {
         $mess = "Not Found";
         $disable = "disabled";
      }
   } else {
      header("location:" . SITE_PATH . "admin/product.php");
      die();
   }
}
?>
<div class="content pb-0">
   <div class="animated fadeIn">
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-header"><strong>Product</strong><small> Form</small></div>
               <div class="card-body card-block">
                  <form action="" method="post" enctype="multipart/form-data">
                     <input type="hidden" name="up_id" value="<?php echo $update_id ?>">
                     <div class="form-group">
                        <label for="company" class=" form-control-label">Product</label>
                        <input type="text" id="company" placeholder="Enter your Product name" class="form-control" name="product" value="<?php echo $mess ?>" required>
                     </div>
                     <select class="form-select my-2" aria-label="Default select example" name="categories_id">
                        <option selected disabled>Selected Category</option>
                        <?php
                        $fetch_record = "SELECT * FROM category";
                        $result = mysqli_query($connection, $fetch_record);
                        while ($row1 = mysqli_fetch_assoc($result)) {
                           if ($row['category_id'] == $row1['id']) {
                              $select = "selected";
                           } else {

                              $select = "";
                           }
                           echo "<option value='{$row1['id']}' $select>{$row1['category']}</option>";
                        }
                        ?>
                     </select>

                     <div class="form-group">
                        <label for="company" class=" form-control-label">MRP</label>
                        <input type="text" id="company" placeholder="Enter your MRP" class="form-control" name="mrp" value="<?php echo $mrp ?>" required>
                     </div>
                     <div class="form-group">
                        <label for="company" class=" form-control-label">Price</label>
                        <input type="text" id="company" placeholder="Enter your Price" class="form-control" name="price" value="<?php echo $price ?>" required>
                     </div>
                     <div class="form-group">
                        <label for="company" class=" form-control-label">Qty</label>
                        <input type="text" id="company" placeholder="Enter your Qty" class="form-control" name="qty" value="<?php echo $qty ?>" required>
                     </div>
                     <div class="mb-3">
                        <label for="formFile" class="form-label">Choose Img</label>
                        <input class="form-control" type="file" id="formFile" name="img" <?php echo $ima_require ?> value="<?php echo $image ?>">
                     </div>
                     <div class="form-group">
                        <label for="company" class=" form-control-label">Short Description</label>
                        <input type="text" id="company" placeholder="Enter your Short Description" class="form-control" name="short_desc" value="<?php echo $short_desc ?>" required>
                     </div>
                     <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" required><?php echo $description ?></textarea>
                     </div>
                     <div class="form-group">
                        <label for="company" class=" form-control-label">Meta Title</label>
                        <input type="text" id="company" placeholder="Enter your Meta Title" class="form-control" name="meta_title" value="<?php echo $meta_title ?>">
                     </div>
                     <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Meta Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="meta_desc"><?php echo $meta_desc ?></textarea>
                     </div>
                     <div class="form-group">
                        <label for="company" class=" form-control-label">Meta Keyword</label>
                        <input type="text" id="company" placeholder="Enter your Meta Keyword" class="form-control" name="meta_keyword" value="<?php echo $meta_keyword ?>">
                     </div>
                     <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="submit" <?php echo $disable ?>>
                        <span id="payment-button-amount">Submit</span>
                     </button>
                     <?php echo $exist ?>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
require "footer.inc.php";

?>