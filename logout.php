<?php
require "connection.inc.php";
unset($_SESSION["USER_ID"]);
unset($_SESSION["USER_NAME"]);
unset($_SESSION["USER_LOGIN"]);
unset($_SESSION['cart']);
header("location:login.php");
