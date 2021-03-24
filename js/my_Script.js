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

 function msg(msg, bg_color, color) {
     let msg_box = document.createElement("div");
     msg_box.innerHTML = msg
     msg_box.style.backgroundColor = bg_color;
     msg_box.style.color = color;
     msg_box.classList.add("msg_box");
     document.body.prepend(msg_box);
     setTimeout(() => {
         msg_box.remove();
     }, 2000);
 }