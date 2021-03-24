<?php
// C 
require "connection.inc.php";
session_unset();
session_destroy();
header("location:" . $hostUrl . "admin/login.php");
