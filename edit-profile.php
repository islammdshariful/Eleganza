<?php
include "include/db_connect.inc.php";
require_once("form/profile-form.php");
session_start();
$id = $name  = $gender = $email = $phone = $pass = $con_pass =  $exist_email = $error = $success = $sql =  $username = $username_e =  $name_in_db = $username_in_db =  $phone_in_db =  $email_in_db = "";
$new_email = $error = $success = $exist_email = $address = $id = $exist_username = "";

$username = $_SESSION["username"];
$email = $_SESSION["email"];
$id = $_SESSION["uid"];
$show_email = $email;
$eee = "";

$sql = "SELECT * FROM users  WHERE email = '$email';";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
          $id = $row['uid'];
          $name = $row['name'];
          $username = $row['username'];
          $gender = $row['gender'];
          $phone = $row['phone'];
          $address = $row['address'];
          $pass = $row['pass'];
  }
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //general
    if(isset($_POST['submit_general'])){
      // $eee = '88888';
      if(!empty($_POST['name'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
      }
      if(!empty($_POST['phone'])){
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
      }
      if(!empty($_POST['address'])){
        $address = mysqli_real_escape_string($conn, $_POST['address']);
      }

      $sql1 = "UPDATE users SET name = '$name', phone = '$phone', address = '$address'  WHERE email = '$email' ;";

      mysqli_query($conn, $sql1);
      $success = 'Update successful.';

    }
    //email
    if(isset($_POST['submit_email'])){
      if(!empty($_POST['new_email'])){
        $new_email = mysqli_real_escape_string($conn, $_POST['new_email']);
      }


      $email_check = "SELECT email FROM users WHERE email = '$new_email' ;" ;
      $result = mysqli_query($conn, $email_check);

      while($row = mysqli_fetch_assoc($result)){
        $exist_email = $row['email'];
      }

      if($exist_email == $new_email){
        $error = "You're already a member";
      }else{
        $sql = "UPDATE users SET email = '$new_email'  WHERE uid = '$id' ;";
        mysqli_query($conn, $sql);

        $success = 'Update successful.';
        $show_email = $new_email;
        $_SESSION['email'] = $new_email;
      }
      // $error = mysqli_error($con);
    }
    //username
    if(isset($_POST['submit_username'])){
      if(!empty($_POST['new_username'])){
        $new_username = mysqli_real_escape_string($conn, $_POST['new_username']);
      }

      $username_check = "SELECT username FROM users WHERE username = '$new_username' ;" ;
      // $username_check = "SELECT username FROM users;" ;
      $result = mysqli_query($conn, $username_check);

      while($row = mysqli_fetch_assoc($result)){
        $exist_username = $row['username'];
      }

      if($exist_username == $new_username){
        $error = "Username already exist!!";
      }else{
        $sql = "UPDATE users SET username = '$new_username'  WHERE uid = '$id' ;";
        mysqli_query($conn, $sql);
        $success = 'Update successful.';
      //   $_SESSION['username'] = $exist_username;
      }
    }
    //password
    if(isset($_POST['submit_password'])){
      if(!empty($_POST['current_password'])){
        $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
      }
      if(!empty($_POST['new_password'])){
      $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
      }
      if(!empty($_POST['con_password'])){
      $con_password = mysqli_real_escape_string($conn, $_POST['con_password']);
      $u__hash_pass = password_hash($con_password, PASSWORD_DEFAULT);
      }

      $password_check = "SELECT pass FROM users WHERE email = '$email' ;" ;
      $result = mysqli_query($conn, $password_check);

      while($row = mysqli_fetch_assoc($result)){
       $exist_pass = $row['pass'];

       if(!password_verify($current_password, $exist_pass)){
           $error = "Password Not Correct!";
       }
       elseif($new_password != $con_password){
           $error = "Password Not Matched!";
       }else{
           $sql =  "UPDATE users SET pass='$u__hash_pass' WHERE uid='$id' ;";
           mysqli_query($conn, $sql);
           $success = "Successfull";
       }
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
    <title>Edit profile</title>
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
              document.getElementById("mycart").innerHTML=response;
              $("#mycart").slideToggle();

            }
           });

          }

      </script>
  </head>
  <body>
    <div  align="center" class='main'>
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
          <!-- <img src="image/search.png" alt="" > -->
          <!-- <input type="text" name="search" placeholder="Search Products"> -->
          <!-- <a href="cart.php" class="hover_effects"><img src="image/shopping-bag.png" alt=""></a> -->
          <a href="cart.php" class="hover_effects" ><img  src="image/shopping-cart.png" alt=""></a>

          <?php
           if(isset($_SESSION['uid'])){
           ?>
           <img src="image/user.png" id="log_btn" onclick="profile()" alt="">
           <!-- <img src="image/user.png" id="log_btn" onclick="openForm()" alt=""> -->
           <?php
         }else{
           ?>
           <!-- <img src="image/user.png" id="log_btn" onclick="profile()" alt=""> -->
          <img src="image/user.png" id="log_btn" onclick="openForm()" alt="">
         <?php
          }
           ?>
        </div>
        </div>
        <?php
          // echo $id;
          if(isset($_SESSION['admin'])){
            profile_admin_Details();
          }else {
            profileDetails();
          }
          openProfile();

        ?>
      <br><br><br>
      <p id="cart_button1" onclick="show_cart();">
       <input type="button" id="total_items" value="">
       </p>

       <div id="mycart1"> </div>
       <div class="cap_status"></div>
      <?php echo $conn->error; ?>

      <div class="" align=center>
        <span style="color:green;"><?php echo $success; ?></span>
        <span style="color:red;"><?php echo $error; ?></span>
        <?php echo $eee; ?>
      </div>

      <div class="edit-profile" align="center">
        <!-- <div class="edit-general" > -->
          <fieldset>
            <details id="general" onclick="general()">
              <summary class="profile">Genral information</summary>
              <form class="profile" action="edit-profile.php" method="post">
                <table class="tabel-profile" id="change_1">
                  <tr>
                    <td>Name: </td>
                    <td><input  class="profile_txt_f" type="text" name="name" value= <?php echo $name; ?> ></td>
                  </tr>
                  <tr>
                    <td>phone: </td>
                    <td><input  class="profile_txt_f" type="text" name="phone" value= <?php echo $phone; ?> ></td>
                  </tr>
                  <tr>
                    <td>Address: </td>
                    <td><textarea name="address" rows="8" cols="48" ><?php echo $address; ?></textarea> </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td  class="profile_setting"> <input class="register_form_btn"  type="submit"  name="submit_general" value="Update"> </td>
                    <!-- <td  class="profile_setting"> <button class="register_form_btn" type="button" name="edit_general">Update</button> </td> -->
                  </tr>
                </table>
              </form>
            </details>
          </fieldset>
        <!-- </div>
        <div class="edit-username" > -->
          <fieldset>
            <details id="username" onclick="username()">
              <summary class="profile">Change Username</summary>
              <form class="profile" action="edit-profile.php" method="post">
                <table class="tabel-profile" id="change_1">
                  <tr>
                      <td class="profile">New Username: </td>
                      <td><input class="profile_txt_f" type="text" name="new_username" value= <?php echo $username ; ?> ></td>
                  </tr>
                  <tr>
                     <td></td>
                     <td><input class="register_form_btn"  type="submit" name="submit_username" value="Update"></td>
                  </tr>
                </table>
              </form>
            </details>
          </fieldset>
        <!-- </div>
        <div class="edit-email"  > -->
          <fieldset>
            <details id="email" onclick="email()">
              <summary class="profile">Change Email</summary>
              <form class="profile" action="edit-profile.php" method="post">
                <table class="tabel-profile"id="change_1" >
                  <tr>
                      <td class="profile">New Email: </td>
                      <td><input class="profile_txt_f" type="text" name="new_email" value= <?php echo $show_email ; ?> ></td>
                  </tr>
                  <tr>
                     <td></td>
                     <td><input class="register_form_btn"  type="submit" name="submit_email" value="Update"></td>
                  </tr>
                </table>
              </form>
            </details>
          </fieldset>
        <!-- </div>
        <div class="edit-password" > -->
          <fieldset>
            <details id="password" onclick="password()">
              <summary class="profile">Change Password</summary>
              <form class="profile" action="edit-profile.php" method="post">
                <table class="tabel-profile" id="change_1">
                  <tr>
                        <td class="profile">Current Password: </td>
                        <td><input class="profile_txt_f" type="password" name="current_password" value="" ></td>
                    </tr>
                    <tr>
                        <td class="profile">New Password: </td>
                        <td><input class="profile_txt_f" type="tepasswordxt" name="new_password" value="" ></td>
                    </tr>
                    <tr>
                        <td class="profile">Confirm Password: </td>
                        <td><input class="profile_txt_f" type="password" name="con_password" value="" ></td>
                    </tr>
                    <tr>
                       <td></td>
                       <td><input class="register_form_btn" id="submit_password" type="submit" name="submit_password" value="Change"></td>
                    </tr>
                </table>
              </form>
            </details>
          </fieldset>
        </div>
      </div>
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

          function profile() {
            document.getElementById("profile").style.display = "block";
          }

          function closeProfile() {
            document.getElementById("profile").style.display = "none";
          }


          // var general = document.getElementById("general");
          // var username = document.getElementById("username");
          // var email = document.getElementById("email");
          // var password = document.getElementById("password");
          //
          // function general(){
          //   if((username.open == true){
          //     username.open = false;
          //   }
          //   if((email.open == true)){
          //     email.open = false;
          //   }
          //   if((password.open == true)){
          //     password.open = false;
          //   }
          // }
          // function username(){
          //   if((general.open == true)){
          //     general.open = false;
          //   }
          //   if((email.open == true)){
          //     email.open = false;
          //   }
          //   if((password.open == true)){
          //     password.open = false;
          //   }
          // }
          // function email(){
          //   if((username.open == true)){
          //     username.open = false;
          //   }
          //   if((general.open == true)){
          //     general.open = false;
          //   }
          //   if((password.open == true)){
          //     password.open = false;
          //   }
          // }
          // function password(){
          //   if((username.open == true)){
          //     username.open = false;
          //   }
          //   if((email.open == true)){
          //     email.open = false;
          //   }
          //   if((general.open == true)){
          //     general.open = false;
          //   }
          // }

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
