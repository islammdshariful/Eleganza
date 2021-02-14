<?php
  $username = $email = $id = $displaybutton = "0";
  include "include/db_connect.inc.php";

  session_start();
  require_once("products/products.php");
  require_once("form/profile-form.php");

    $productname = $error = $table = $table_error  = $id = $error1 = $error2 = $product_search_name = $product_search_id_for_updel = $success1 = $success = $img = $productprice = $productdetails = $productimage = $productid = $productquantity =  $productimage = $gender = $gender_type = $product_type = $p_type = "";
    $uploadOk = 1;

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['product_add'])){
      if(!empty($_POST['product_gender_type'])){
        $gender = mysqli_real_escape_string($conn, $_POST['product_gender_type']);
      }
      if(!empty($_POST['product_type'])){
        $product_type = mysqli_real_escape_string($conn, $_POST['product_type']);
      }
      if(!empty($_POST['product_id'])){
        $productid = mysqli_real_escape_string($conn, $_POST['product_id']);
      }
      if(!empty($_POST['product_name'])){
        $productname = mysqli_real_escape_string($conn, $_POST['product_name']);
      }
      if(!empty($_POST['product_description'])){
        $productdetails = mysqli_real_escape_string($conn, $_POST['product_description']);
      }
      if(!empty($_POST['product_price'])){
        $productprice = mysqli_real_escape_string($conn, $_POST['product_price']);
      }
      if(!empty($_POST['product_quantity'])){
        $productquantity = mysqli_real_escape_string($conn, $_POST['product_quantity']);
      }
      if(!empty($_FILES['image'])){
        $productimage = $_FILES['image'];
      }

      $target_dir = "./image/$gender/$product_type/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);

      $filename = $_FILES["image"]["name"];
      $dst = "./image/$gender/$product_type/".$filename;
      $img = "image/$gender/$product_type/".$filename;

      $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));

      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          $error = "File is not an image.";
          $uploadOk = 0;
      }


      if (file_exists($target_file)) {
          $error = "Sorry, file already exists.";
          $uploadOk = 0;
      }

      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
          $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
      }

      if($uploadOk == 0) {
          $error1 = "Sorry, your file was not uploaded.";
      } else {
          if (move_uploaded_file($_FILES["image"]["tmp_name"],$dst)) {
              $sql = "INSERT INTO product (product_gender_type, product_type, product_id, product_name, product_description, product_quantity, product_price, image)
                      VALUES ('$gender','$product_type', '$productid', '$productname', '$productdetails', '$productquantity', '$productprice', '$img');";
              mysqli_query($conn, $sql);
              $success = "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
              echo"<script>alert('product has been uploaded')</script>";
              echo"<script>window.location = 'manage-product.php'</script>";
          } else {
              $error = "Sorry, there was an error uploading your file.";
          }
      }
    }

    // search for update and delete product
    if(isset($_POST['search_product_id'])){
      if(!empty($_POST['product_id_for_updel'])){
        $product_search_id_for_updel = mysqli_real_escape_string($conn, $_POST['product_id_for_updel']);
      }

      $sql = "SELECT * FROM product WHERE product_id = '$product_search_id_for_updel'; ";
      $result = mysqli_query($conn, $sql);

      while($row = mysqli_fetch_assoc($result)){
                $productname = $row['product_name'];
                $productprice = $row['product_price'];
                $productdetails = $row['product_description'];
                $productimage = $row['image'];
                $productid = $row['product_id'];
                $productquantity = $row['product_quantity'];
                $productid = $row['product_id'];

        }
        if(!$productid == $product_search_id_for_updel){
          $error2 = "No items found.";
        }
    }
    if(isset($_POST['product_update'])){
      if(!empty($_POST['product_id_for_updel'])){
        $product_search_id_for_updel = mysqli_real_escape_string($conn, $_POST['product_id_for_updel']);
      }
      if(!empty($_POST['product_quantity_up'])){
        $productquantity = mysqli_real_escape_string($conn, $_POST['product_quantity_up']);
      }
      if(!empty($_POST['product_name_up'])){
        $productname = mysqli_real_escape_string($conn, $_POST['product_name_up']);
      }
      if(!empty($_POST['product_description_up'])){
        $productdetails = mysqli_real_escape_string($conn, $_POST['product_description_up']);
      }
      if(!empty($_POST['product_price_up'])){
        $productprice = mysqli_real_escape_string($conn, $_POST['product_price_up']);
      }

      $sql = "UPDATE product SET product_name = '$productname', product_description = '$productdetails', product_quantity = '$productquantity',
      product_price = '$productprice'  WHERE product_id = '$product_search_id_for_updel' ;";

      if(mysqli_query($conn, $sql)){
        $success1 = 'Update successful.';
      }else {
        $error = 'Update unsuccessful.';
      }
      echo"<script>alert('product has been updated')</script>";
      echo"<script>window.location = 'manage-product.php'</script>";
    }
    // product_delete
    if(isset($_POST['product_delete'])){
      if(!empty($_POST['product_id_for_updel'])){
        $product_search_id_for_updel = mysqli_real_escape_string($conn, $_POST['product_id_for_updel']);
      }
      $sql = "DELETE FROM product WHERE product_id = '$product_search_id_for_updel' ;";
      if(mysqli_query($conn, $sql)){
        $success1 = 'Delete successful.';
        // print_r($id);
      }else {
        $error = 'Delete unsuccessful.';
      }
      echo"<script>alert('product has been deleted')</script>";
      echo"<script>window.location = 'manage-product.php'</script>";
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage products</title>
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
      </div>
      <?php
        if(isset($_SESSION['admin'])){
          profile_admin_Details();
        }else {
          profileDetails();
        }
        openProfile();
      ?>
      <?php $error = mysqli_error($conn); ?>
      <br>
      <div class="manage-product">
        <div class="product-container">
          <div class="add-product">
            <h1 class="font1">Add Product</h1>
            <form class="" action="manage-product.php" method="post" enctype="multipart/form-data">
              <label class="font1">Gender: </label>
              <input type="radio" name="product_gender_type" value="men"><label class="font2">Men</label>
              <input type="radio" name="product_gender_type" value="women"><label class="font2">Women</label>
              <br>
              <label class="font1">Men</label>
              <div class="line1"></div>
              <input type="radio" name="product_type" value="shirt"><label class="font2">Shirt</label>
              <input type="radio" name="product_type" value="pant"><label class="font2">Pant</label>
              <input type="radio" name="product_type" value="suit"><label class="font2">Suit</label>
              <input type="radio" name="product_type" value="t-shirt"><label class="font2">T-Shirt</label>
              <br>
              <label class="font1">Women</label>
              <div class="line1"></div>
              <input type="radio" name="product_type" value="kamiz"><label class="font2">Kamiz</label>
              <input type="radio" name="product_type" value="sharee"><label class="font2">Sharee</label>
              <input type="radio" name="product_type" value="lehenga"><label class="font2">Lehenga</label>
              <input type="radio" name="product_type" value="jewelry"><label class="font2">Jewelry</label>
              <br>
              <table>
                <tr>
                  <td><label class="font1">Product ID:</label></td>
                  <td><input type="text" name="product_id" value="" required></td>
                </tr>
                <tr>
                  <td><label class="font1">Product Name:</label></td>
                  <td><input type="text" name="product_name" value="" required></td>
                </tr>
                <tr>
                  <td><label class="font1">Product Description:</label></td>
                  <td><textarea name="product_description" rows="8" cols="32" required></textarea></td>
                </tr>
                <tr>
                  <td><label class="font1">Product Price:</label></td>
                  <td><input type="text" name="product_price" value="" required></td>
                </tr>
                <tr>
                  <td><label class="font1">Product Quantity:</label></td>
                  <td>  <input type="text" name="product_quantity" value="" required></td>
                </tr>
                <tr>
                  <td><label class="font1">Product Image:</label></td>
                  <td> <input type="file" name="image" value=""> </td>
                </tr>
                <tr>
                  <td colspan="2"><input class="register_form_btn"type="submit" name="product_add" value="Upload"> </td>
                </tr>
              </table>
            </form>
            <span style="color:red;"><?php echo $error; ?></span>
            <span style="color:red;"><?php echo $error1; ?></span>
            <span style="color:green;"><?php echo $success; ?></span>
            <br>
          </div>

          <!-- update and delete product -->

          <div class="update-product">
            <h1 class="font1">Edit Product</h1>
            <form class="" action="manage-product.php" method="post">
              <div align="right">
                <label class="font2">Product ID: </label>
                <input type="text" name="product_id_for_updel" value="<?php echo $product_search_id_for_updel; ?>">
                <input class="btn1" type="submit" name="search_product_id" value="Search" required>
              </div>
              <table>
                <tr>
                  <td><label class="font2">Product Image:</label></td>
                  <td><img src="<?php echo $productimage; ?>" width="210" height="140"></td>
                </tr>
                <tr>
                  <td><label class="font2">Product Name:</label></td>
                  <td><input type="text" name="product_name_up" value="<?php echo $productname; ?>" ></td>
                </tr>
                <tr>
                  <td><label class="font2">Product Description:</label></td>
                  <td><textarea name="product_description_up" rows="8" cols="32" ><?php echo $productdetails; ?></textarea></td>
                </tr>
                <tr>
                  <td><label class="font2">Product Price:</label></td>
                  <td><input type="text" name="product_price_up" value="<?php echo $productprice; ?>" ></td>
                </tr>
                <tr>
                  <td><label class="font2">Product Quantity:</label></td>
                  <td>  <input type="text" name="product_quantity_up" value="<?php echo $productquantity; ?>" ></td>
                </tr>
                <tr>
                  <td colspan="2" align="right"><input class="update_btn" type="submit" name="product_update" value="Update">
                  <input class="delete_btn" type="submit" name="product_delete" value="Delete">
                  </td>
                </tr>
              </table>
              <span style="color:green;"><?php echo $success1; ?></span>
              <span style="color:red;"><?php echo $error; ?></span>
              <span style="color:red;"><?php echo $error2; ?></span>
            </form>
          </div>
          <div class="search-product">
            <h1 class="font1">Search Product</h1>
            <form class="" action="manage-product.php" method="post">
              <label class="font2">Enter product name: </label>
              <input type="text" name="product_search_name" value="<?php echo $product_search_id_for_updel; ?>">
              <input class="btn1" type="submit" name="search_product_name" value="Search" required>
              <div class="table_header_section">
                <table class="table_header">
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Description</th>
                  </tr>
                  <?php
                  if(isset($_POST['search_product_name'])){
                    if(!empty($_POST['product_search_name'])){
                      $product_search_name = mysqli_real_escape_string($conn, $_POST['product_search_name']);
                    }
                    $sql =  "SELECT product_id, product_name, product_description, product_quantity, product_price FROM product WHERE product_type = '$product_search_name'; ";
                    $result = mysqli_query($conn, $sql);
                    if($result-> num_rows > 0){
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>".$row['product_id']." "."</td><td>".$row['product_name']."</td><td>".$row['product_quantity']."</td><td>".$row['product_price']."</td><td>"
                        .$row['product_description']."</td><td>";
                      }
                    }else {
                       echo " 0 result ";
                    }
                  }
                  ?>
               </table>
            </form>
          </div>
         </div>
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
