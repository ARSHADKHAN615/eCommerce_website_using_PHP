<?php
require "connection.inc.php";


$name = htmlentities($_POST['name']);
$email = htmlentities($_POST['email']);
$phone = htmlentities($_POST['mobile']);
$message = htmlentities($_POST['message']);
$addon = date('y-m-d');

$sql = "INSERT INTO `contact_us`(`name`, `email`, `phone`, `comment`, `adden_on`) VALUES ('$name','$email','$phone','$message','$addon')";
$result = mysqli_query($connection, $sql);

if ($result) {
    echo 1;
} else {
    echo 0;
}
