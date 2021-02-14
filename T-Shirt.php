<?php
  $username = $email = $id = $displaybutton = "0";
  include "include/db_connect.inc.php";
  // $displaybutton = $_SESSION['display'];
  // $disp = '1';
  session_start();
  require_once("products/products.php");
  require_once("form/profile-form.php");
  // $username = $_SESSION["username"];
  // $email = $_SESSION["email"];
  // $id = $_SESSION["uid"];

  $productname = $productprice = $productdetails = $productimage = $productid = "";

  if(isset($_POST['add'])){
    // print_r($_POST['product_id']);
    if(isset($_SESSION['cart'])){
      $items_id = array_column($_SESSION['cart'], "product_id");
      // print_r($_SESSION['cart']);
      if(in_array($_POST['product_id'], $items_id)){
        echo"<script>alert('product is already added')</script>";
        echo"<script>window.location = 'T-Shirt.php'</script>";
        // printf('ddd');
      }else {
        $count = count($_SESSION['cart']);
        $items = array(
        'product_id' => $_POST['product_id']
      );
      $_SESSION['cart'][$count] = $items;
      // print_r($_SESSION['cart']);
      }
      // print_r($_SESSION['cart']);
    }else {
      $items = array(
      'product_id' => $_POST['product_id']
    );

    $_SESSION['cart'][0] = $items;
      // print_r($_SESSION['cart']);
    }
  }





?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>T-Shirt</title>
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
            // var ar = new array();
            //
            // ar.push(id);
            //
            // if(ar.includes(id) && flag == 1){
            //   alert('product is already added');
            //   window.location = 'Lehenga.php';
            // }else {
            //
            //     // flag = "1";
            // }



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
    <div  align="center">
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
          <?php
            // if(isset($_SESSION['cart'])){
            //   $count = count($_SESSION['cart']);
            //   echo "<span id=\"cart_number\">$count</span>";
            // }else {
            //   echo "<span id=\"cart_number\">0</span>";
            // }
          ?>
          <!-- echo"<script>alert('product is already added')</script>"; -->


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
        <div class="catagory">
	       <br><br>
         <h2 id="prod">P R O D U C T S</h2>
         <br><br>
         <p id="cart_button" onclick="show_cart();">

            <!-- <img src="5.png"> -->
            <input type="button" id="total_items" value="">
            <!-- <a href="clear-cart.php"><p style="color:red; text-align:center; text-decoration:underline">Clear Session</p></a> -->
          </p>

          <div id="mycart"> </div>
          <div class="cap_status"></div>
          <!-- <a href="clear-cart.php"><p style="color:red; text-align:center; text-decoration:underline">Clear Session</p></a> -->

         <?php
         $sql = "SELECT * FROM product WHERE product_type = 't-shirt'; ";
         $result = mysqli_query($conn, $sql);

         while($row = mysqli_fetch_assoc($result)){
                   $productname = $row['product_name'];
                   $productprice = $row['product_price'];
                   $productdetails = $row['product_description'];
                   $productimage = $row['image'];
                   $productid = $row['product_id'];

                   producttshirt($productname,$productprice,$productdetails,$productimage,$productid);
           }
         ?>
         </div>
        <!-- <div class="catagory">
	       <br><br>
         <h2 id="prod">P R O D U C T S</h2>
         <br><br>
         <div class="card">
           <img src="image/Men/T-Shirt/T-shirt1.jpg" alt="Rabbitees" style="width:100%">
           <h1>Rabbitees</h1>
           <p class="price">400 BDT</p>
           <p>Gamer heartbeat T-Shirt </p>
           <p><button>Add to Cart</button></p>
         </div>

         <div class="card">
           <img src="image/Men/T-Shirt/T-shirt2.jpg" alt="Banana Republic" style="width:100%">
           <h1>Banana Republic</h1>
           <p class="price">600 BDT</p>
           <p>Slim Luxury-Touch Polo.</p>
           <p><button>Add to Cart</button></p>
         </div>

         <div class="card">
           <img src="image/Men/T-Shirt/T-shirt3.jpg" alt="Vietees" style="width:100%">
           <h1>Vietees</h1>
           <p class="price">400 BDT</p>
           <p>Grow a beard T-Shirt.</p>
           <p><button>Add to Cart</button></p>
         </div>

         <div class="card">
           <img src="image/Men/T-Shirt/T-shirt4.jpg" alt="Anabella's" style="width:100%">
           <h1>Anabella's</h1>
           <p class="price">500 BDT</p>
           <p>Men striped print tee</p>
           <p><button>Add to Cart</button></p>
         </div>

         <div class="card">
           <img src="image/Men/T-Shirt/T-shirt5.jpg" alt="Shirts by Sarah" style="width:100%">
           <h1>Shirts by Sarah</h1>
           <p class="price">400 BDT</p>
           <p>Men's barber T-Shirt.</p>
           <p><button>Add to Cart</button></p>
         </div>

         <div class="card">
           <img src="image/Men/T-Shirt/T-shirt6.jpg" alt="JBanana Republic" style="width:100%">
           <h1>Banana Republic</h1>
           <p class="price">600 BDT</p>
           <p>Performance pique stripe polo.</p>
           <p><button>Add to Cart</button></p>
         </div>

         <div class="card">
           <img src="image/Men/T-Shirt/T-shirt7.jpg" alt="Porter" style="width:100%">
           <h1>Porter</h1>
           <p class="price">500 BDT</p>
           <p>Polo ralph lauren Slim-Fit stripped cotton.</p>
           <p><button>Add to Cart</button></p>
         </div>

         <div class="card">
           <img src="image/Men/T-Shirt/T-shirt8.jpg" alt="Abercrombie & Fitch" style="width:100%">
           <h1>Abercrombie & Fitch</h1>
           <p class="price">600 BDT</p>
           <p>Icon stretch polo.</p>
           <p><button>Add to Cart</button></p>
         </div>

        </div> -->
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
