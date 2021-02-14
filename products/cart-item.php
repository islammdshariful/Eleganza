<?php


  function carElement($productname,$productprice,$productimage,$productid){
    $element = "
      <div class=\"cart-card\">
        <form  action=\"cart.php?action=remove&id=$productid\" method=\"post\">
          <img src=$productimage align=\"left\" alt=\"Red Paisleys\" width=\"200px\" height=\"200px\">
          <h1>$productname</h1><br>
          <p class=\"price\">$productprice BDT</p>
          <br>
          <p><button type=\"submit\" name=\"remove\">Remove <i class=\"fas fa-trash-alt\"></i></button></p>
        </form>
      </div>
    ";
    echo $element;
  }

  function paymentlist($productname,$productprice){
    $element = "
      <p class=\"pay\">Product name: $productname</p>
      <p class=\"pay\">Product price: $productprice </p>
      <br>
    ";
    echo $element;
  }

  function cusorder($orderid,$orderdate,$productname,$productprice,$productimage,$productid,$productstatus){
    $dstatus = "";
    $pstatus = "";
    if($productstatus == "purchased"){
      $pstatus = "Purchased";
    }
    if($productstatus == "delivered"){
      $dstatus = "Delivered";
    }

    $element = "
      <div class=\"dashboard-card\">
          <img src=$productimage align=\"left\" alt=\"Red Paisleys\" width=\"200px\" height=\"200px\">
          <h3>#$orderid</h3><br>
          <h1>$productname</h1><br>
          <p class=\"price\"> Price: $productprice BDT</p>
          <br>
          <p class=\"price\">Date: $orderdate</p>
          <span style=\"color:green;\"><h4>$dstatus</h4></span>
          <span style=\"color:orange;\"><h4>$pstatus</h4></span>
      </div>
    ";
    echo $element;
  }

  function orders($orderid,$orderdate,$customername,$productname,$customeraddress,$productprice,$productimage,$productid,$productstatus,$customerid,$customerphonenumber){

    $element = "
      <div class=\"order-card\">
      <form  action=\"order.php?action=remove&id=$orderid\" method=\"post\">
          <img src=$productimage align=\"left\" alt=\"Red Paisleys\" width=\"200px\" height=\"320px\">
          <h3>#$orderid</h3><br>
          <p class=\"price\">Date: $orderdate</p>
          <p class=\"price\">Product ID: $productid</p>
          <p class=\"price\">Product name: $productname</p>
          <p class=\"price\"> Product Price: $productprice BDT</p>
          <p class=\"price\">Customer ID: $customerid</p>
          <p class=\"price\">Customer name: $customername</p>
          <p class=\"price\">Phone number: $customerphonenumber</p>
          <p class=\"price\">Customer address: $customeraddress</p>
          <p><button type=\"submit\" name=\"remove\">Delivery <i class=\"fas fa-truck-loading\"></i></button></p>
          </form>

      </div>
    ";
    echo $element;
  }
  // function checkout(){
  //   $element = "
  //     <div class=\"checkout-card\" id=\"chekout\" >
  //         <p align=\"center\">You need to login first</p> <br><br><br>
  //         <div align=\"center\"><a href=\"login.php\" class=\"log_reg-1\"><p>Click here to login</p></a></div>
  //         <div class=\"line1\"></div>
  //         <table>
  //           <tr>
  //             <td><label class=\"registration\">Name:</label></td>
  //             <td><input class=\"register_form\" type=\"text\" name=\"public_name\" required> </td>
  //           </tr>
  //           <tr>
  //             <td><label class=\"registration\">Phone:</label></td>
  //             <td><input class=\"register_form\" type=\"text\" name=\"public_phone\" required > </td>
  //           </tr>
  //           <tr>
  //             <td><label class=\"registration\">Address:</label></td>
  //             <td><textarea name=\"public_address\" rows=\"8\" cols=\"35\" required></textarea> </td>
  //           </tr>
  //           <tr>
  //             <td colspan=\"2\"> <input class=\"register_form_btn\" type=\"submit\" name=\"checkout\" value=\"checkout\"> </td>
  //           </tr>
  //         </table>
  //
  //     </div>
  //   ";
  //   echo $element;
  // }


  // <h4>Quantity: <input type=\"number\" name=\"quantity\" min = 1 max = 50 value=\"1\"> </p>
?>
