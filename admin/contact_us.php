<?php
// C 
require "top.inc.php";


// DELETE CONTACT 
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = $_GET['type'];
    if ($type == "delete") {
        $id = $_GET['id'];
        $delete_contact_sql = "DELETE FROM contact_us WHERE id=$id";
        mysqli_query($connection, $delete_contact_sql);
    }
}


// FETCH CONTACT FROM DB 
$fetch_contact_sql = "SELECT * FROM contact_us ORDER BY id DESC ";
$result = mysqli_query($connection, $fetch_contact_sql);
?>


<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Contact Us</h3>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>ID </th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Query</th>
                                        <th>Date</th>
                                        <th>Delete</th>
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
                                                <td> <?php echo $row['name'] ?> </td>
                                                <td> <?php echo $row['email'] ?> </td>
                                                <td> <?php echo $row['phone'] ?> </td>
                                                <td> <?php echo $row['comment'] ?> </td>
                                                <td> <?php echo $row['adden_on'] ?> </td>
                                                <td>
                                                    <?php
                                                    echo "<a href='?type=delete&id={$row['id']}' class='btn btn-danger'>Delete</a>";
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php }
                                    } else {
                                        echo not_found(8);
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