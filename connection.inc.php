<?php
session_start();
$hostUrl = "http://localhost/eCommerce_website_using_PHP/";

define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'] . '/eCommerce_website_using_PHP/');
define('PRODUCT_IMG_SERVER_PATH', SERVER_PATH . 'media/');


define('SITE_PATH', 'http://localhost/eCommerce_website_using_PHP/');
define('PRODUCT_IMAGE_SITE_PATH', SITE_PATH . 'media/');

$connection = mysqli_connect("localhost", "root", "", "e-comm");
