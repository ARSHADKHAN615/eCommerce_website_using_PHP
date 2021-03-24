<?php
// c 
require "connection.inc.php";
require "function.inc.php";
$name = get_safe_value($connection, $_POST['name']);
$email = get_safe_value($connection, $_POST['email']);
$phone = get_safe_value($connection, $_POST['mobile']);
$password = get_safe_value($connection, $_POST['password']);
$addon = date('y-m-d');


$check_user = mysqli_num_rows(mysqli_query($connection, "SELECT email FROM users WHERE email='$email'"));

if ($check_user > 0) {
    echo  "EXISTED";
} else {
    $sql = "INSERT INTO `users` (`name`, `email`, `phone`, `password`, `addon_on`) VALUES ('$name','$email','$phone','$password','$addon')";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        echo 1;
    } else {
        echo $sql;
    }
}
