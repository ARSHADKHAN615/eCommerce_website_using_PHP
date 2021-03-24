<?php
require "connection.inc.php";
require "add_to_cart.inc.php";
require "function.inc.php";


$pid = get_safe_value($connection, $_POST['p_id']);
$type = get_safe_value($connection, $_POST['type']);

if (isset($_SESSION['USER_NAME'])) {
    $user_id = $_SESSION['USER_ID'];
    $product_id = $pid;
    $date = date("Y-m-d");
    if (mysqli_num_rows(mysqli_query($connection, "SELECT * FROM whistle WHERE user_id='$user_id' AND produect_id='$product_id'")) > 0) {
        echo "Already Existed";
    } else {
        $result = mysqli_query($connection, "INSERT INTO `whistle` (`user_id`,`produect_id`,`added_on`) VALUES ('$user_id','$product_id','$date')");
        if ($result) {
            // echo true;
        } else {
            echo false;
        }
        echo $count = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM whistle WHERE user_id='$user_id'"));
    }
} else {
    echo "not_login";
}
