<?php

  include "include/db_connect.inc.php";
  session_start();
  require_once("products/cart-item.php");
  require_once("form/profile-form.php");
  $username = $email = $id = $displaybutton = "0";
  $orderid = $orderdate = $sql3 = $oid = $sql1 = $sql = $searchorderid = $orderid = $productprice = $result = $customername = $customerid = $productname = $productdetails = $customeraddress = $productstatus = $productimage = $productid = "";

  // $displaybutton = $_SESSION['display'];
  // $disp = '1';

  // $displaybutton = $_SESSION['display'];
  // $disp = '1';
  // session_start();
  // require_once("form/profile-form.php");
  // $username = $_SESSION["username"];
  // $email = $_SESSION["email"];
  $id = $_SESSION["uid"];

  if(isset($_POST['remove'])){
    if($_GET['action'] == 'remove'){
          $sql3 = "SELECT order_id FROM  porder;";
          $result = mysqli_query($conn, $sql3);
          while($row = mysqli_fetch_assoc($result)){
            if($row['order_id'] == $_GET['id']){
              $oid = $_GET['id'];
              $sql = "UPDATE porder SET status = 'delivered' WHERE  order_id = '$oid' ;";
              $sql1 = "DELETE FROM temorder WHERE order_id = '$oid' ;";
              mysqli_query($conn, $sql);
              mysqli_query($conn, $sql1);
              echo"<script>alert('Delivered')</script>";
              echo"<script>window.location = 'order.php'</script>";
            }
          }
        }
      }

      // foreach ($_SESSION['cart'] as $key => $value) {
      //   if($value['product_id'] == $_GET['id']){
      //     unset($_SESSION['cart'][$key]);
      //   }
      // }



  // if($_SERVER["REQUEST_METHOD"] == "POST"){
  //   if(!empty($_POST['searchorderid'])){
  //     $searchorderid = mysqli_real_escape_string($conn, $_POST['searchorderid']);
  //   }
  //
  //   $orderid = "order".$searchorderid;
  //   $sql = "UPDATE porder SET status = 'Delivered' WHERE  order_id = '$orderid' ;";
  //   $sql1 = "DELETE FROM temorder WHERE order_id = '$orderid' ;";
  //   mysqli_query($conn, $sql);
  //   mysqli_query($conn, $sql1);
  //   echo"<script>alert('Product delivered')</script>";
  //   echo"<script>window.location = 'order.php'</script>";
  //
  // }



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Your order</title>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
     <link href="css/fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

    <script>
      $(document).ready(function(){
        $('.bxslider').bxSlider({
          mode: 'fade',
          captions: true,
          slideWidth: 10000,
          auto: true
        });
      });
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
          <!-- <a href="login.php" class="hover_effects" onclick="openForm()"><img src="image/user.png" alt=""></a> -->
          <!-- <img src="image/user.png" id="log_btn" onclick="openForm()" alt="">
          <img src="image/user.png" id="log_btn" onclick="profile()" alt=""> -->
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

      <div class="order">
        <br><br>
        <h2 id="order-header" align="center">product Orders </h2>
        <br><br>

        <!-- <div class="search_order"align="center">
          <form class="" action="order.php" method="post">
            <input type="text" name="searchorderid" value="">
            <input type="submit" class="searchbutton" name="delivery" value="Delivery">
          </form>
        </div> -->

        <?php
        $sql = "SELECT * FROM temorder";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
                  $orderid = $row['order_id'];
                  $orderdate = $row['order_date'];
                  $productname = $row['product_name'];
                  $customername = $row['customer_name'];
                  $productprice = $row['product_price'];
                  $customeraddress = $row['customer_address'];
                  $productimage = $row['product_image'];
                  $productid = $row['product_id'];
                  $productstatus = $row['status'];
                  $customerid = $row['customer_id'];
                  $customerphonenumber = $row['customer_phone'];
                  // $sql = "UPDATE porder SET status = 'Delivered' WHERE customer_id = '$customerid' AND order_id = '$orderid' ;";
                  orders($orderid,$orderdate,$customername,$productname,$customeraddress,$productprice,$productimage,$productid,$productstatus,$customerid,$customerphonenumber);
                  // $sql = "UPDATE porder SET status = 'Delivered' WHERE customer_id = '$customerid' ;";
                  // $result = mysqli_query($conn, $sql);
          }

        ?>

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
