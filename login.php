<?php
  include "include/db_connect.inc.php";
  require_once("products/products.php");
  require_once("form/profile-form.php");

  session_start();
  $u_email = $u_pass = $login = $message = $emi =  $sql = $message1 = $a = $id = "";
  $admin = '5';

  // $a = 'chor';
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST['user_log_email'])){
      $u_email = mysqli_real_escape_string($conn, $_POST['user_log_email']);
    }
    if(!empty($_POST['user_log_pass'])){
      $u_pass = mysqli_real_escape_string($conn, $_POST['user_log_pass']);
    }

    $sql = "SELECT uid, email, username, pass FROM users  WHERE email = '$u_email';";

    $sql1 = "SELECT uid, email, username, pass FROM admin  WHERE email = '$u_email';";

    $result = mysqli_query($conn, $sql);
    $user_check = mysqli_num_rows($result);

    // while($row = mysqli_fetch_assoc($result)){
    //           $id = $row['uid'];
    //           // $name = $row['name'];
    //           // $username = $row['username'];
    //           // $gender = $row['gender'];
    //           // $phone = $row['phone'];
    //           // $pass = $row['pass'];
    //           // $address = $row['address'];
    //   }

    $result1 = mysqli_query($conn, $sql1);
    $user_check1 = mysqli_num_rows($result1);

    // // $sql1 = "SELECT * FROM admin  WHERE email = '$email';";
    // // $result1 = mysqli_query($conn, $sql1);
    // while($row = mysqli_fetch_assoc($result1)){
    //           $id = $row['uid'];
    //           // $name = $row['name'];
    //           // $username = $row['username'];
    //           // $gender = $row['gender'];
    //           // $phone = $row['phone'];
    //           // $pass = $row['pass'];
    //           // $address = $row['address'];
    //   }

    while($row = mysqli_fetch_assoc($result)){
        $id = $row['uid'];
        $emi = $row['email'];
        $u_pass_db = $row['pass'];

        if(password_verify($u_pass, $u_pass_db)){
          $_SESSION['email'] = $u_email;
          $_SESSION['uid'] = $id;

          header("Location: home.php");
        }
        else{
          $message = "Wrong email or password!";
        }
      }

      while($row = mysqli_fetch_assoc($result1)){
        $u_pass_db = $row['pass'];
        $id = $row['uid'];
        $emi = $row['email'];

        if($u_pass == $u_pass_db){
          $_SESSION['email'] = $u_email;
          $_SESSION['uid'] = $id;
          $_SESSION['admin'] = $admin;

          header("Location: home.php");
        }
        else{
          $message = "Wrong email or password!";
        }
      }
  }
 ?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <style media="screen">
    #cart_button1
    {
      margin-top:-100px;
      margin-left:80px;
      cursor:pointer;
      float:right;
    }
    #cart_button1 input[type="button"]
    {
      background:none;
      border:none;
      background-color:#720a4a;
      border-radius:100%;
      height:20px;
      width:20px;
      margin-top: 30px;
      margin-right: 45px;
      color:white;
      font-size:10px;
      cursor:pointer;
      position:relative;
    }
    #mycart1
    {
      display:none;
      background:white;
      width:400px;
      /* margin-right: 60px;
       */
       margin-top: 0px;
      /* padding: 10px; */
      /* color: #720a4a; */
      border-radius: 10px;
      border:2px solid #720a4a;
      position:absolute; right:0px; top:120px;
      z-index:1;
    }
    #mycart1 .cart_items
    {
      border-bottom:1px #720a4a;
      padding:20px;
      /* color: #720a4a; */
      padding-left:10px;
    }
    #mycart1 .cart_items img
    {
      width:70px;
      height:50px;
      color: #720a4a;
      float:left;
    }
    #mycart1 .cart_items p
    {
      margin:0px;
      color: #720a4a;
      font-size:15px;
    }
    </style>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link href="css/fontawesome/css/all.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css"> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script> -->

    <script type="text/javascript">
      // var flag = "0";
          $(document).ready(function(){

            $.ajax({
              type:'post',
              url:'store_items.php',
              data:{
                total_cart_items:"totalitems"
              },
              success:function(response) {
                document.getElementById("total_items").value=response;
              }
            });

          });

          function cart(id){

            var pid = id;
            var ele=document.getElementById(id);
            var img_src=ele.getElementsByTagName("img")[0].src;
            var name=document.getElementById("name").value;
            var price=document.getElementById("price").value;

            $.ajax({
                type:'post',
                url:'store_items.php',
                data:{
                  item_id: pid,
                  item_src:img_src,
                  item_name:name,
                  item_price:price
                },
                success:function(response) {
                  document.getElementById("total_items").value=response;
              $('.cap_status').html("product added to cart").fadeIn('slow').delay(100).fadeOut('slow');
                }

              });
           }

          function show_cart()
          {
            $.ajax({
            type:'post',
            url:'store_items.php',
            data:{
              showcart:"cart"
            },
            success:function(response) {
              document.getElementById("mycart1").innerHTML=response;
              $("#mycart1").slideToggle();

            }
           });

          }

      </script>
  </head>
  <body>
    <div class="main" align="center">
      <div class="brand_name">
        <a href="home.php"><img src="image/logo.png" alt="" height="80" width="140"> </a>
      </div>
      <div class="topbar">
      </div>
      <div class="menu">
        <span class="catagory_type" onclick="openMens()">Mens</span>
        <?php openMens() ?>
        <!-- <a href="mens_catagory.php" class="catagory_type" >Mens</a> -->
        <span class="catagory_type" onclick="openWomens()">Womens</span>
        <?php openWomens() ?>
        <div class="user_section" >
          <!-- <img src="image/search.png" alt="" >
          <input type="text" name="search" placeholder="Search Products"> -->
          <!-- <a href="cart.php" class="hover_effects"><img src="image/shopping-bag.png" alt=""></a> -->
          <a href="cart.php" class="hover_effects" ><img  src="image/shopping-cart.png" alt=""></a>
          <img src="image/user.png" id="log_btn" onclick="openForm()" alt="">
        </div>
        </div>
        <div class="form-popup" id="myForm">
         <div class="form-container">
           <a href="login.php" class="popup_form"><label> Login</label></a>
           <a href="registration.php" class="popup_form"><label > Registration</label></a>
           <a href="#" onclick="closeForm()"><img src="image/cancel.png" alt=""  ></a>
        </div>
        </div>
        <div>
          <br><br><br>
          <p id="cart_button1" onclick="show_cart();">
           <input type="button" id="total_items" value="">
           </p>

           <div id="mycart1"> </div>
           <div class="cap_status"></div>
          <form class="registration"  method="post">
            <article id="register" >
              WELCOME, PLEASE SIGN IN !
            </article>
            <br>
            <table>
              <tr>
                <td><img class="login_form" src="image/man-user.png" alt=""></td>
                <!-- <td>First Name:</td> -->
                <td><input class="login_form" type="text" placeholder="Enter Email" name="user_log_email" required></td>
              </tr>
              <tr>
                <td><img class="login_form" src="image/lock.png" alt=""></td>
                <!-- <td>Last Name:</td> -->
                <td><input class="login_form" type="password" placeholder="Enter Password" name="user_log_pass" required></td>
              <tr>
                  <td colspan="2" ><input class="register_form_btn" type="submit" name="submit" value="LOGIN"></td>
              </tr>
            </table>
            <!-- <div>
              <table>
                <tr>
                  <td colspan="1" id="btn-flot"><input class="register_form_btn" type="submit" name="submit" value="REGISTER"></td>
                </tr>
              </table>
            </div> -->
          </form>
          <span style="color:white;"><?php echo $a; ?></span>
          <span style="color:white;"><?php echo $message1; ?></span>
          <span style="color:red;"><?php echo $message; ?></span>
        </div>
    </div>
    <br><br><br> <div align="center"><a href="registration.php" class="log_reg-1"><p>Not a member? Click here.</p></a></div> <br>
    <div class="footer">
      <div class="footer_contant">
        <div class="footer_about">
          <h1>
            <article class="">
              E l e g a n z a
            </article></h1>
          <br>
          <p>Eleganza is a trendiest fashion, clothing and lifestyle Bangladeshi
            brand which is mostly distinguished for its quality designs at reasonable
            price and fabrics. Clients satisfactions is the main priority of eleganza.
          </p>
          <br>
          <div class="socials">
            <a href="https://www.facebook.com/eleganzainsa/" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/wear_eleganza/" target="_blank"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
        <div class="footer_link">
          <h2>Categories</h2>
          <br>
            <a href="home.php">Home</a>
            <a href="mens_catagory.php">Mens</a>
            <a href="womens_catagory.php">Womens</a>
            <!-- <a href="kids_catagory.php">Kids</a> -->

        </div>
        <div class="footer_contact">
          <h2> Contact us</h2>
          <br>
          <div class="contact">
            <i class="fas fa-phone"></i> +8801627698148
            <br><br><br> <i class="fas fa-envelope"></i> eleganza.co@gmail.com
          </div>
        </div>
      </div>
      <div class="footer_bottom">
        &copy; eleganza.com | Design By eleganza Clothing Co
      </div>
    </div>
    <script>
      function openForm() {
        document.getElementById("myForm").style.display = "block";
      }

      function closeForm() {
        document.getElementById("myForm").style.display = "none";
      }

      function openMens(){
        document.getElementById("men").style.display = "block";
        var women = document.getElementById("women");
        if(women.style.display == "block"){
          women.style.display = "none";
        }
      }

      function openWomens(){
        document.getElementById("women").style.display = "block";
        var men = document.getElementById("men");
        if(men.style.display == "block"){
          men.style.display = "none";
        }
      }

      function closeMen() {
        document.getElementById("men").style.display = "none";
      }

      function closeWomen() {
        document.getElementById("women").style.display = "none";
      }
      </script>
  </body>
</html>
