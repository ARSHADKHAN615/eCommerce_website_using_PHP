  <?php
   //   c 
   require('top.inc.php');
   if (isset($_SESSION['USER_LOGIN'])) {
      echo "<script>
               window.location.href = 'index.php';
            </script>";
   }
   ?>
  <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) no-repeat scroll center center / cover ;">
     <div class="ht__bradcaump__wrap">
        <div class="container">
           <div class="row">
              <div class="col-xs-12">
                 <div class="bradcaump__inner">
                    <nav class="bradcaump-inner">
                       <a class="breadcrumb-item" href="index.html">Home</a>
                       <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                       <span class="breadcrumb-item active">Login</span>
                    </nav>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </div>
  <section class="htc__contact__area ptb--100 bg__white">
     <div class="container">
        <div class="row">
           <div class="col-md-6">
              <div class="contact-form-wrap mt--60">
                 <div class="col-xs-12">
                    <div class="contact-title">
                       <h2 class="title__line--6">Login</h2>
                    </div>
                 </div>
                 <div class="col-xs-12">
                    <form id="login-form" method="post">
                       <div class="single-contact-form">
                          <div class="contact-box name">
                             <input type="text" name="login_name" id="login_name" placeholder="Your Email*" style="width:100%">
                          </div>
                       </div>
                       <div class="single-contact-form">
                          <div class="contact-box name">
                             <input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
                          </div>
                       </div>

                       <div class="contact-btn">
                          <button type="submit" id="login_btn" class="fv-btn">Login</button>
                       </div>
                    </form>
                    <div class="form-output">
                       <p class="form-messege login"></p>
                    </div>
                 </div>
              </div>

           </div>


           <div class="col-md-6">
              <div class="contact-form-wrap mt--60">
                 <div class="col-xs-12">
                    <div class="contact-title">
                       <h2 class="title__line--6">Register</h2>
                    </div>
                 </div>
                 <div class="col-xs-12">
                    <form id="register-form" method="post">
                       <div class="single-contact-form">
                          <div class="contact-box name">
                             <input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
                          </div>
                       </div>
                       <div class="single-contact-form">
                          <div class="contact-box name">
                             <input type="text" name="email" id="email" placeholder="Your Email*" style="width:100%">
                          </div>
                       </div>
                       <div class="single-contact-form">
                          <div class="contact-box name">
                             <input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:100%">
                          </div>
                       </div>
                       <div class="single-contact-form">
                          <div class="contact-box name">
                             <input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%">
                          </div>
                       </div>

                       <div class="contact-btn">
                          <button type="submit" id="Register-submit" class="fv-btn">Register</button>
                       </div>
                    </form>
                    <div class="form-output">
                       <p class="form-messege"></p>
                    </div>
                 </div>
              </div>

           </div>

        </div>
  </section>
  <?php
   require "footer.inc.php";
   ?>
  <!-- <script>
     $("#Register-submit").click(function(e) {
        e.preventDefault();
        let name = $("#name").val();
        let email = $("#email").val();
        let phone = $("#mobile").val();
        let password = $("#password").val();


        if (name == "") {
           alert("Enter Name");
        } else if (email == "") {
           alert("Enter email");

        } else if (phone == "") {
           alert("Enter phone");

        } else if (password == "") {
           alert("Enter password");

        } else {
           console.log(phone);
           $.ajax({
              type: "POST",
              url: "register_user.php",
              data: "name=" + name + "&email=" + email + "&mobile=" + phone + "&password=" + password,
              success: function(response) {
                 if (response == 1) {
                    alert("Register Successfully");
                    $("#register-form").trigger("reset");
                 } else {
                    alert(response);
                 }

              }
           });
        }


     });
     $("#login_btn").click(function(e) {
        e.preventDefault();
        $(".form-messege.login").html("");

        let login_name = $("#login_name").val();
        let login_password = $("#login_password").val();

        if (login_name == "") {
           $(".form-messege.login").html("Enter Email");
        } else if (login_password == "") {
           $(".form-messege.login").html("Enter Password");
        } else {
           $.ajax({
              type: "POST",
              url: "login_user.php",
              data: {
                 "login_name": login_name,
                 "login_password": login_password,
              },
              success: function(response) {
                 if (response == 1) {
                    alert("Login Successfully");
                    $("#register-form").trigger("reset");
                    window.location.href = "index.php";
                 } else {
                    alert("Enter Valid Detail");
                 }

              }
           });
        }


     });
  </script> -->