<?php
require "connection.inc.php";
require "add_to_cart.inc.php";
require "function.inc.php";

$pid = get_safe_value($connection, $_POST['p_id']);
$qty = get_safe_value($connection, $_POST['qty']);
$type = get_safe_value($connection, $_POST['type']);

$obj = new add_to_cart();



if ($type == 'add') {
    $msg =  $obj->addProduct($pid, $qty);
}

// function addProduct($pid, $qty)
// {
//     $_SESSION['cart'][$pid]['qty'] = $qty;
// }


if ($type == "update") {
    $obj->UpdateProduct($pid, $qty);
}

if ($type == "remove") {
    $obj->removeProduct($pid);
}


// function totalProduct()
// {
//     if (isset($_SESSION['cart'])) {
//         return count($_SESSION['cart']);
//     } else {
//         return 0;
//     }
// }
echo $obj->totalProduct();
