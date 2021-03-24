<?php
// C 
require "top.inc.php";


// ACTIVE AND DEACTIVE CATEGORY 
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
      $update_status_sql = "UPDATE category SET status=$status WHERE id=$id";
      mysqli_query($connection, $update_status_sql);
   }
}

// DELETE CATEGORY 
if (isset($_GET['type']) && $_GET['type'] != '') {
   $type = $_GET['type'];
   if ($type == "delete") {
      $id = $_GET['id'];
      $delete_cat_sql = "DELETE FROM category WHERE id=$id";
      mysqli_query($connection, $delete_cat_sql);
   }
}


// FETCH CATEGORY
$fetch_cat_sql = "SELECT * FROM category ORDER BY category DESC ";
$result = mysqli_query($connection, $fetch_cat_sql);
?>


<div class="content pb-0">
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <h3>Category</h3>
                  <a href="manage_category.php" class="btn btn-primary mt-3">Add Category</a>
               </div>
               <div class="card-body--">
                  <div class="table-stats order-table ov-h">
                     <table class="table ">
                        <thead>
                           <tr>
                              <th class="serial">#</th>
                              <th>ID </th>
                              <th>Category</th>
                              <th>Status</th>
                              <th>Modify</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           if (mysqli_num_rows($result) > 0) {
                              $i = 0;
                              while ($row = mysqli_fetch_assoc($result)) { ?>
                                 <tr>
                                    <td class="serial"><?php echo $i += 1 ?></td>
                                    <td> <?php echo $row['id'] ?> </td>
                                    <td> <?php echo $row['category'] ?> </td>
                                    <td> <?php
                                          status($row['status'], 1, $row['id']);
                                          ?></td>
                                    <td>
                                       <?php
                                       Modify_btn($row['id']);
                                       ?>
                                    </td>
                                 </tr>
                           <?php }
                           } else {
                              echo not_found(5);
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