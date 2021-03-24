<?php
// c 
require "connection.inc.php";
require "function.inc.php";

$login_name =  get_safe_value($connection, $_POST['login_name']);
$login_password =  get_safe_value($connection, $_POST['login_password']);



$result =  mysqli_query($connection, "SELECT * FROM users WHERE password='$login_password' AND email='$login_name'");
$check_user = mysqli_num_rows($result);

if ($check_user > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['USER_ID'] = $row["id"];
    $_SESSION['USER_NAME'] = $row["name"];
    $_SESSION['USER_LOGIN'] = "YES";
    echo  1;
} else {

    echo 0;
}
