<?php
require "top.inc.php";
// CHECK USER LOGIN OR NOT 
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) < 1) {
?>
    <script>
        window.location.href = "index.php";
    </script>
<?php
}

?>

<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(html/5011439_about-bg.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.html">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">checkout</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CHECKOUT FORM  -->

<div class="checkout-wrap ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout__inner">
                    <div class="accordion-list">
                        <div class="accordion">
                            <!-- // CHECK USER LOGIN OR NOT -->
                            <?php
                            if (!isset($_SESSION['USER_LOGIN'])) {
                            ?>
                                <div class="accordion__title">
                                    Checkout Method
                                </div>
                                <div class="accordion__body">
                                    <div class="accordion__body__form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="checkout-method__login">
                                                    <form id="login-form" method="post">
                                                        <h5 class="checkout-method__title">Login</h5>
                                                        <div class="single-input">
                                                            <label for="login_name">Email Address</label>
                                                            <input type="text" name="login_name" id="login_name" placeholder="Your Email*">
                                                        </div>
                                                        <div class="single-input">
                                                            <label for="login_password">Password</label>
                                                            <input type="password" name="login_password" id="login_password" placeholder="Your Password*">
                                                        </div>

                                                        <div class="dark-btn">
                                                            <a type="submit" id="login_btn">Login</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="checkout-method__login">
                                                    <form id="register-form" method="post">
                                                        <h5 class="checkout-method__title">Register</h5>
                                                        <div class="single-input">
                                                            <label for="name">Name</label>
                                                            <input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
                                                        </div>
                                                        <div class="single-input">
                                                            <label for="email">Email Address</label>
                                                            <input type="text" name="email" id="email" placeholder="Your Email*" style="width:100%">
                                                        </div>

                                                        <div class="single-input">
                                                            <label for="mobile">Mobile</label>
                                                            <input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:100%">

                                                        </div>
                                                        <div class="single-input">
                                                            <label for="password">Password</label>
                                                            <input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%">

                                                        </div>
                                                        <div class="dark-btn">
                                                            <a href="#" type="submit" id="Register-submit">Register</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h1>Please Login to continues</h1>
                            <?php
                            } else {
                            ?>
                                <form action="checkout.php" method="post">
                                    <div class="accordion__title">
                                        Address Information
                                    </div>
                                    <div class="accordion__body">
                                        <div class="bilinfo">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="single-input">
                                                        <input type="text" placeholder="Street Address" name="address">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="single-input">
                                                        <input type="text" placeholder="City/State" name="city">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-input">
                                                        <input type="text" placeholder="Post code/ zip" name="pincode">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion__title">
                                        payment information
                                    </div>
                                    <div class="accordion__body">
                                        <div class="paymentinfo">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="COD" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                    COD
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="Instamojo" checked>
                                                <label class="form-check-label" for="exampleRadios2">
                                                    Instamojo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dark-btn">
                                        <input type="submit" id="Checkout-submit" name="Checkout-submit" class="btn btn-primary">
                                    </div>
                                </form>
                            <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SHOW PRODUCT TOTAL -->
            <div class="col-md-4">
                <div class="order-details">
                    <h5 class="order-details__title">Your Order</h5>
                    <div class="order-details__item">
                        <!-- FETCH PRODUCT IN SESSION  AND SHOW -->
                        <?php
                        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                            $My_price = 0;
                            foreach ($_SESSION['cart'] as $key => $val) {
                                $productArr =  get_product('latest', '', "", $key, "", "", $connection);
                                $pname = $productArr[0]['name'];
                                $mrp = $productArr[0]['mrp'];
                                $price = $productArr[0]['price'];
                                $image = $productArr[0]['image'];
                                $qty = $val['qty'];
                                $total_price = $qty * $price;
                        ?>
                                <div class="single-item">
                                    <div class="single-item__thumb">
                                        <img src="<?php echo  PRODUCT_IMAGE_SITE_PATH . $image ?>" alt="ordered item">
                                    </div>
                                    <div class="single-item__content">
                                        <a href="#"><?php echo $pname ?></a>
                                        <span class="price"><?php echo $total_price ?></span>
                                    </div>
                                    <div class="single-item__remove">
                                        <a href="#" onclick="manage_cart('<?php echo  $key ?>','remove')"><i class="zmdi zmdi-delete"></i></a>
                                    </div>
                                </div>
                            <?php
                                $My_price += $total_price;
                            }

                            ?>
                    </div>
                    <div class="order-details__count">
                        <div class="order-details__count__single">
                            <h5>sub total</h5>
                            <span class="price"><?php echo $My_price ?></span>
                        </div>
                        <div class="order-details__count__single">
                            <h5>Tax 18%</h5>
                            <span class="price"><?php $tax = ($My_price * 18) / 100;
                                                echo round($tax, 2) ?></span>
                        </div>
                    </div>
                    <div class="ordre-details__total">
                        <h5>Order total</h5>
                        <span class="price"><?php echo round($My_price + $tax, 2) ?></span>
                    </div>
                <?php
                        }

                ?>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- WHEN CHECKOUT TIME  -->
<?php
if (isset($_POST['Checkout-submit'])) {
    $user_id = $_SESSION['USER_ID'];
    $address = get_safe_value($connection, $_POST['address']);
    $city = get_safe_value($connection, $_POST['city']);
    $pincode = get_safe_value($connection, $_POST['pincode']);
    $payment_type = get_safe_value($connection, $_POST['exampleRadios']);
    $total_price = round($My_price + $tax, 2);
    $payment_status = "Pending";
    if ($payment_type == "COD") {
        $payment_status = "Success";
    }
    $order_status  = 1;
    $add_on = date("Y-m-d h:i:s");

    // PAYMENT GETAWAY IS INSTAMOJO 
    if ($payment_type == 'Instamojo') {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                "X-Api-Key:test_c403ab0348e327e85402cd3bebe",
                "X-Auth-Token:test_28b25bf070748fe376a259bab6e"
            )
        );
        $userArr = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * from users where id='$user_id'"));
        $payload = array(
            'purpose' => 'Buy Domine Name',
            'amount' => $total_price,
            'phone' => $userArr['phone'],
            'buyer_name' => $userArr['name'],
            'redirect_url' => 'http://localhost/eCommerce_website_using_PHP/payment_complete.php',
            'send_email' => true,
            'webhook' => 'http://www.example.com/webhook/',
            'send_sms' => true,
            'email' => $userArr['email'],
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        $T_id = $response->payment_request->id;
        echo "<script>
                window.location.href = '{$response->payment_request->longurl}';
             </script>";
    }

    // INSERT ORDER PRODUCT IN DB 
    $sql = "INSERT INTO `order`(`user_id`, `address`, `city`, `pincode`, `payment_type`, `total_price`, `payment_status`, `order_status`, `add-on`,`txnid`) VALUES ('$user_id','$address','$city','$pincode','$payment_type','$total_price','$payment_status','$order_status','$add_on','$T_id')";
    $result = mysqli_query($connection, $sql);
    $order_id = mysqli_insert_id($connection);

    //FETCH DATA IN SESSION AND INSERT ORDER DETAIL IN DB 
    foreach ($_SESSION['cart'] as $key => $val) {
        $productArr =  get_product('latest', '', "", $key, "", "", $connection);
        $product_id = $key;
        $price = $productArr[0]['price'];
        $qty = $val['qty'];
        $total_price = $qty * $price;
        $sql = "INSERT INTO `order_details`(`order_id`, `produect_id`, `qty`, `price`, `add-on`) VALUES ('$order_id','$product_id','$qty','$total_price','$add_on')";
        $result = mysqli_query($connection, $sql);
    }

    unset($_SESSION['cart']);

    // JOB COD HO TO THANK KE PAGE PE 
    if ($payment_type == 'COD') {
        echo "<script>
               window.location.href = 'thank_you.php';
              </script>";
    }
}
?>




<?php
require "footer.inc.php";
?>
<script>
    function manage_cart(id, type) {
        let qty = 1;
        $.ajax({
            type: "POST",
            url: "manage_cart.php",
            data: {
                "p_id": id,
                "qty": qty,
                "type": type,
            },
            success: function(response) {
                if (type == "remove") {
                    window.location.href = "checkout.php";
                }
                $("#cart").html(response);
            }
        });
    }

    // $("#Register-submit").click(function(e) {
    //     e.preventDefault();

    //     let name = $("#name").val();
    //     let email = $("#email").val();
    //     let phone = $("#mobile").val();
    //     let password = $("#password").val();


    //     if (name == "") {
    //         alert("Enter Name");
    //     } else if (email == "") {
    //         alert("Enter email");

    //     } else if (phone == "") {
    //         alert("Enter phone");

    //     } else if (password == "") {
    //         alert("Enter password");

    //     } else {
    //         console.log(phone);
    //         $.ajax({
    //             type: "POST",
    //             url: "register_user.php",
    //             data: "name=" + name + "&email=" + email + "&mobile=" + phone + "&password=" + password,
    //             success: function(response) {
    //                 if (response == 1) {
    //                     alert("Register Successfully");
    //                     $("#register-form").trigger("reset");
    //                 } else {
    //                     alert(response);
    //                 }

    //             }
    //         });
    //     }


    // });
    // $("#login_btn").click(function(e) {
    //     e.preventDefault();
    //     $(".form-messege.login").html("");

    //     let login_name = $("#login_name").val();
    //     let login_password = $("#login_password").val();

    //     if (login_name == "") {
    //         $(".form-messege.login").html("Enter Email");
    //     } else if (login_password == "") {
    //         $(".form-messege.login").html("Enter Password");
    //     } else {
    //         $.ajax({
    //             type: "POST",
    //             url: "login_user.php",
    //             data: {
    //                 "login_name": login_name,
    //                 "login_password": login_password,
    //             },
    //             success: function(response) {
    //                 if (response == 1) {
    //                     alert("Login Successfully");
    //                     $("#register-form").trigger("reset");
    //                     window.location.href = window.location.href;
    //                 } else {
    //                     alert("Enter Valid Detail");
    //                 }

    //             }
    //         });
    //     }
    // });
</script>