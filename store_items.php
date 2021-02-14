<?php
  error_reporting(0);
  $username = $email = $id = $pid = $displaybutton = "";
  include "include/db_connect.inc.php";
  session_start();
  require_once("products/products.php");
  require_once("form/profile-form.php");

  $productname = $productprice = $productdetails = $productimage = $productid = "";

  $count1 = "0";





  if(isset($_POST['total_cart_items']))
  {
    if(isset($_SESSION['name'])){
      $count1 =  count($_SESSION['name']);
      echo $count1;
    }else{
      echo $count1;
  }
	exit();
  }

  if(isset($_POST['item_src']))
  {
    $_SESSION['name'][]=$_POST['item_name'];
    $pid= $_POST['item_id'];
    $_SESSION['id'][] = $pid;
    $_SESSION['price'][]=$_POST['item_price'];
    $_SESSION['src'][]=$_POST['item_src'];

    echo count($_SESSION['name']);

    if(isset($_SESSION['cart'])){
      $items_id = array_column($_SESSION['cart'], $_POST['item_id']);

      if(in_array($_POST['item_id'], $items_id)){
        // echo"<script>window.location = 'Lehenga.php'</script>";
        // echo"<script>alert('product is already added')</script>";
        // echo"<script>window.location = 'Lehenga.php'</script>";
      }else {
        $count = count($_SESSION['cart']);
        $items = array(
        'item_id' => $_POST['item_id']
      );
      $_SESSION['cart'][$count] = $items;

      }
    }else {
      $items = array(
      'item_id' => $_POST['item_id']
    );

    $_SESSION['cart'][0] = $items;

    }
    exit();
  }

  if(isset($_POST['showcart']))
  {
    if(isset($_SESSION['src'])){
      for($i=0;$i<count($_SESSION['src']);$i++)
      {
        echo "<div class='cart_items'>";
        echo "<img src='".$_SESSION['src'][$i]."'>";
        echo "<p>".$_SESSION['name'][$i]."</p>";
        echo "<p>".$_SESSION['price'][$i]." BDT"."</p>";
        echo "</div>";
      }
      exit();
    }else {
      echo "<div class='cart_items'>";
      echo "<p>"."No item added"."</p>";
      echo "</div>";
    }


  }

?>
