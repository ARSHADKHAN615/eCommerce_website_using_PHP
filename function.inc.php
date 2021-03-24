<?php
// c 
function prx($arr)
{
    echo "<pre>";
    print_r($arr);
    die();
}

function pr($arr)
{
    echo "<pre>";
    print_r($arr);
}


function get_safe_value($conn, $str)
{
    if ($str != "") {
        $str = htmlentities(trim($str));
        return  mysqli_real_escape_string($conn, $str);
    }
}


function not_found($col)
{
    echo "<tr>
             <td colspan='{$col}' class='text-center'><h1>Record Not Found</h1></td>              
           </tr>";
}

function status($status, $active, $status_id)
{
    if ($status == $active) {
        echo "<a href='?type=status&operation=deactive&id={$status_id}' class='btn btn-success'>Active</a>";
    } else {
        echo "<a href='?type=status&operation=active&id={$status_id}' class='btn btn-danger'>Deactive</a> ";
    }
}


function Modify_btn($id)
{
    echo "<a href='manage_category.php?type=edit&id={$id}' class='btn btn-primary mx-3'>Edit</a>" . "<a href='?type=delete&id={$id}' class='btn btn-danger'>Delete</a>";
}

function get_product($type = "", $limit = "", $cat_id = "", $product_id = "", $search = "", $sort_sql = "", $con)
{

    $sql = "SELECT * FROM product INNER JOIN category ON product.category_id=category.id WHERE product_status=1";

    if ($cat_id != "") {
        $sql .= " AND category_id=$cat_id";
    }

    if ($product_id != "") {
        $sql .= " AND product_id=$product_id";
    }
    if ($search != "") {
        $sql .= " AND product.name LIKE '%$search%' or product.description LIKE '%$search%'";
    }

    if ($sort_sql != "") {
        $sql .= $sort_sql;
    }

    if ($type == "latest") {
        $sql .= " ORDER BY product_id DESC";
    }

    if ($limit != "") {
        $sql .= " limit $limit";
    }

    $res = mysqli_query($con, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
    return $data;
}
