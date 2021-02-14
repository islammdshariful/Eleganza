<?php
error_reporting(0);
$username = $email = $id = $displaybutton = "0";
$p1 = "";
include "include/db_connect.inc.php";
$total = 0;

session_start();
require_once("products/products.php");
require_once("products/cart-item.php");
require_once("form/profile-form.php");


$cid = $_SESSION["uid"];
$productname = $productprice = $sql4 = $sql5 = $date = $productdetails = $sql3 = $sql2 = $sql1 = $last_id = $productimage = $productid = $name = $pquan = $phone = $address = "";
$oid = "1";
$count = count($_SESSION['cart']);


if(isset($_POST['remove'])){
  if($_GET['action'] == 'remove'){
    foreach ($_SESSION['cart'] as $key => $value) {
      if($value['item_id'] == $_GET['id']){
        unset($_SESSION['cart'][$key]);

      }
    }
  }
}
 if($_SERVER["REQUEST_METHOD"] == "POST"){
   if(isset($_POST['cashondelivery'])){

     if(isset($_POST['checkout'])){
       if ($count == '0') {
         echo"<script>alert('No item is selected')</script>";
         echo"<script>window.location = 'cart.php'</script>";
       }
       elseif(isset($_SESSION['uid'])){
         $sql1 = "SELECT * FROM users  WHERE uid = '$cid';";
         $result1 = mysqli_query($conn, $sql1);
         while($row = mysqli_fetch_assoc($result1)){
             $name = $row['name'];
             $phone = $row['phone'];
             $address = $row['address'];
          }

         $product_id = array_column($_SESSION['cart'], 'item_id');
         $sql = "SELECT * FROM product;";
         $result = mysqli_query($conn, $sql);
         while($row = mysqli_fetch_assoc($result)){
           foreach ($product_id as $id){
             if($row['product_id'] == $id){
               $productname = $row['product_name'];
               $productprice = $row['product_price'];
               $productdetails = $row['product_description'];
               $productimage = $row['image'];
               $productid = $row['product_id'];
               $productquantity = $row['product_quantity'];

               $date = date('Y-m-d H:i:s');

               $sql2 = "INSERT INTO porder (order_id , order_date , customer_id , customer_name, customer_phone, customer_address, product_id, product_name, product_quantity, product_price, product_image, status)
                       VALUES ('$oid', '$date', '$cid', '$name', '$phone', '$address', '$productid', '$productname', '1', '$productprice', '$productimage', 'purchased');";

               $sql4 = "INSERT INTO temorder (order_id , order_date , customer_id , customer_name, customer_phone, customer_address, product_id, product_name, product_quantity, product_price, product_image, status)
               VALUES ('$oid', '$date', '$cid', '$name', '$phone', '$address', '$productid', '$productname', '1', '$productprice', '$productimage', 'purchased');";

               mysqli_query($conn, $sql2);

               mysqli_query($conn, $sql4);

               $last_id = mysqli_insert_id($conn);
               if($last_id){
                 $oid = "order0".$last_id;
                 $sql3 = "UPDATE porder SET order_id = '$oid' where id = '$last_id';";
                 mysqli_query($conn, $sql3);
                 $sql5 = "UPDATE temorder SET order_id = '$oid' where id = '$last_id';";
                 mysqli_query($conn, $sql5);
               }

               unset($_SESSION['cart']);
               unset($_SESSION['src']);
                unset($_SESSION['name']);
               echo"<script>alert('Product has been purchased')</script>";
               echo"<script>window.location = 'dashboard.php'</script>";
             }
           }
         }
       }
       else{
         echo"<script>alert('You need to login first to buy product')</script>";
         echo"<script>window.location = 'login.php'</script>";

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
      margin-top: 47px;
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
       margin-top: -130px;

      border-radius: 10px;
      border:2px solid #720a4a;
      position:absolute; right:0px; top:120px;
      z-index:1;
    }
    #mycart1 .cart_items
    {
      border-bottom:1px #720a4a;
      padding:20px;
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
    <title>Cart</title>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link href="css/fontawesome/css/all.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script type="text/javascript">
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

          <a href="cart.php" class="hover_effects" ><img  src="image/shopping-cart.png" alt=""></a>

          <?php
           if(isset($_SESSION['uid'])){
           ?>
           <img src="image/user.png" id="log_btn" onclick="profile()" alt="">
           <?php
         }else{
           ?>
          <img src="image/user.png" id="log_btn" onclick="openForm()" alt="">
         <?php
          }
           ?>
        </div>
        </div>
        <?php
          if(isset($_SESSION['admin'])){
            profile_admin_Details();
          }else {
            profileDetails();
          }
          openProfile();

        ?>



      <br><br>
      <div class="cart">
      <div class="cart-product-items">
              <h2 id="prod">MY  CART </h2>
              <br><br><br>
        <?php


        if(isset($_SESSION['cart'])){
          $product_id = array_column($_SESSION['cart'], 'item_id');
          $sql = "SELECT * FROM product;";
          $result = mysqli_query($conn, $sql);

          while($row = mysqli_fetch_assoc($result)){
            foreach ($product_id as $id){
              if($row['product_id'] == $id){
               carElement($row['product_name'],$row['product_price'],$row['image'],$row['product_id']);

               $total = $total + (int)$row['product_price'];
              }
            }
          }
        }else {
          echo"<script>alert('Cart is empty')</script>";
          echo"<script>window.location = 'home.php'</script>";
        }
        ?>
      </div>
      <div class="checkout-box">
        <div class="payment">

          <p id="cart_button1" onclick="show_cart();">
           <input type="button" id="total_items" value="">
           </p>

           <div id="mycart1"> </div>
           <div class="cap_status"></div>

          <form class="" action="cart.php" method="post">
            <h2 align="center">Price Details</h2>
            <div class="line1"></div>
            <?php
            if(isset($_SESSION['cart'])){
              $count = count($_SESSION['cart']);
              echo "<h3 align=\"center\">Price ($count items)</h3>";
            }else {
              echo "<h3>Price($count items)</h3>";
            }
            ?>
            <br>
            <div class="line2"></div>
            <?php
            if(isset($_SESSION['cart'])){
              $product_id = array_column($_SESSION['cart'], 'item_id');
              $sql = "SELECT * FROM product;";
              $result = mysqli_query($conn, $sql);

              while($row = mysqli_fetch_assoc($result)){
                foreach ($product_id as $id){
                  if($row['product_id'] == $id){
                    paymentlist($row['product_name'],$row['product_price']);
                  }
                }
              }
            }
            ?>

            <br>
            <br><div class="line1"></div><br>
            <div class="cartpay">
              <table>
                <tr>
                  <td colspan="2"><h3>Amount payable:  <?php echo "$total BDT";?> </h3></td>
                </tr>
                <tr>
                  <td><label class="register_for" style="color:green;">Cash on Delivery:</label></td>
                  <td><input type="radio" name="cashondelivery" value="cash" required></td>
                </tr>
                <tr>
                  <td><label class="register_for" style="color: #de0ba7 ;">Bkash:</label><span style="color:red;">(Coming Soon)</span></td>
                  <td><input type="radio" name="bkash" value="bkash" disabled></td>
                </tr>
                <tr>
                  <td colspan="2"><input class="register_form_btn" type="submit" name="checkout"  value="checkout"></td>
                </tr>
              </table>
            </div>
          </form>
        </div>
      </div>
      </div>
    </div>
        <footer class="footer">
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
        </footer>
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
