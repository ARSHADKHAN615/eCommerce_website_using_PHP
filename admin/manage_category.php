<?php
//  C 

require "top.inc.php";
$exist = "";

// INSERT CATEGORY
if (isset($_POST['submit']) && $_POST['up_id'] == "") {
   $cat = get_safe_value($connection, $_POST['category']);
   $check_cat_sql = "SELECT * FROM category WHERE category='$cat'";
   $result = mysqli_query($connection, $check_cat_sql);
   if (mysqli_num_rows($result) > 0) {
      $exist = "All Ready Exist";
   } else {
      $insert_cat_sql = "INSERT INTO category (category,status) VALUES ('$cat',1)";
      mysqli_query($connection, $insert_cat_sql);
      header("location:" . SITE_PATH . "admin/index.php");
   }
}


// UPDATE CATEGORY IN DB WITH CHECK DATA FROM DB
if (isset($_POST['submit']) && $_POST['up_id'] != "") {
   $id = $_POST['up_id'];
   $name = get_safe_value($connection, $_POST['category']);
   $check_cat_sql = "SELECT * FROM category WHERE category='$name'";
   $result = mysqli_query($connection, $check_cat_sql);
   if (mysqli_num_rows($result) > 0) {
      $exist = "All Ready Exist";
   } else {
      $update_cat_sql = "UPDATE category SET category='$name' WHERE id=$id";
      mysqli_query($connection, $update_cat_sql);
      header("location:" . SITE_PATH . "admin/index.php");
   }
}


// CHECK DATA FROM UPDATE OPERATION 
$mess = "";
$disable = "";
$update_id = "";
if (isset($_GET['type']) && $_GET['type'] == "edit") {
   if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $fetch_record = "SELECT * FROM category WHERE id=$id";
      $result = mysqli_query($connection, $fetch_record);
      $row = mysqli_fetch_assoc($result);

      if (mysqli_num_rows($result) == 1) {
         $mess = $row['category'];
         $disable = "";
         $update_id = $row['id'];
      } else {
         $mess = "Not Found";
         $disable = "disabled";
      }
   } else {
      header("location:" . SITE_PATH . "admin/index.php");
      die();
   }
}
?>
<div class="content pb-0">
   <div class="animated fadeIn">
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-header"><strong>Category</strong><small> Form</small></div>
               <div class="card-body card-block">
                  <form action="" method="post">
                     <input type="hidden" name="up_id" value="<?php echo $update_id ?>">
                     <div class="form-group"><label for="company" class=" form-control-label">Category</label><input type="text" id="company" placeholder="Enter your Category name" class="form-control" name="category" value="<?php echo $mess ?>"></div>
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