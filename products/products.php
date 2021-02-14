<?php
  // function productlehenga($productname, $productprice, $productdetails, $productimage,$productid){
  //   $elements = "
  //   <div class=\"card\" id='$productid'>
  //   <form  action=\"Lehenga.php\" method=\"post\">
  //     <img src=\"$productimage\" alt=\"Red Paisleys\" style=\"width:100%\">
  //     <h1>$productname</h1>
  //     <p class=\"price\">$productprice BDT</p>
  //     <p>$productdetails</p>
  //     <p><button type=\"submit\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button></p>
  //     <input type=\"hidden\" name=\"product_id\" value= '$productid' >
  //   </form>
  // </div>
  //   " ;
  //   echo $elements;
  // };
  function productlehenga($productname, $productprice, $productdetails, $productimage,$productid){
    $elements = "
    <div class=\"card\" id='$productid'>
      <img src=\"$productimage\" alt=\"Red Paisleys\" style=\"width:100%\">
      <h1>$productname</h1>
      <p class=\"price\">$productprice BDT</p>
      <p>$productdetails</p>
      <p><button  onclick=\"cart('$productid')\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button></p>
      <input type=\"hidden\" id=\"name\" value=\"$productname\">
      <input type=\"hidden\" id=\"price\" value=\"$productprice\">
      <input type=\"hidden\" name=\"product_id\" value= '$productid' >
  </div>
    " ;
    echo $elements;
    // <input class=\"product-button\" type=\"button\" value=\"Add to Cart\" onclick=\"cart('$productid')\">
  };

  // function productjewelry($productname, $productprice, $productdetails, $productimage,$productid){
  //   $elements = "
  //   <div class=\"card\">
  //   <form  action=\"Jewelry.php\" method=\"post\">
  //     <img src=\"$productimage\" alt=\"Red Paisleys\" style=\"width:100%\">
  //     <h1>$productname</h1>
  //     <p class=\"price\">$productprice BDT</p>
  //     <p>$productdetails</p>
  //     <p><button type=\"submit\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button></p>
  //     <input type=\"hidden\" name=\"product_id\" value= '$productid' >
  //   </form>
  // </div>
  //   " ;
  //   echo $elements;
  // };
  function productjewelry($productname, $productprice, $productdetails, $productimage,$productid){
    $elements = "
    <div class=\"card\" id='$productid'>
      <img src=\"$productimage\" alt=\"Red Paisleys\" style=\"width:100%\">
      <h1>$productname</h1>
      <p class=\"price\">$productprice BDT</p>
      <p>$productdetails</p>
      <p><button  onclick=\"cart('$productid')\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button></p>
      <input type=\"hidden\" id=\"name\" value=\"$productname\">
      <input type=\"hidden\" id=\"price\" value=\"$productprice\">
      <input type=\"hidden\" name=\"product_id\" value= '$productid' >
  </div>
    " ;
    echo $elements;
    // <input class=\"product-button\" type=\"button\" value=\"Add to Cart\" onclick=\"cart('$productid')\">
  };

  // function productkamiz($productname, $productprice, $productdetails, $productimage,$productid){
  //   $elements = "
  //   <div class=\"card\">
  //   <form  action=\"Kamiz.php\" method=\"post\">
  //     <img src=\"$productimage\" alt=\"Red Paisleys\" style=\"width:100%\">
  //     <h1>$productname</h1>
  //     <p class=\"price\">$productprice BDT</p>
  //     <p>$productdetails</p>
  //     <p><button type=\"submit\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button></p>
  //     <input type=\"hidden\" name=\"product_id\" value= '$productid' >
  //   </form>
  // </div>
  //   " ;
  //   echo $elements;
  // };
  function productkamiz($productname, $productprice, $productdetails, $productimage,$productid){
    $elements = "
    <div class=\"card\" id='$productid'>
      <img src=\"$productimage\" alt=\"Red Paisleys\" style=\"width:100%\">
      <h1>$productname</h1>
      <p class=\"price\">$productprice BDT</p>
      <p>$productdetails</p>
      <p><button  onclick=\"cart('$productid')\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button></p>
      <input type=\"hidden\" id=\"name\" value=\"$productname\">
      <input type=\"hidden\" id=\"price\" value=\"$productprice\">
      <input type=\"hidden\" name=\"product_id\" value= '$productid' >
  </div>
    " ;
    echo $elements;
    // <input class=\"product-button\" type=\"button\" value=\"Add to Cart\" onclick=\"cart('$productid')\">
  };

  // function productsharee($productname, $productprice, $productdetails, $productimage,$productid){
  //   $elements = "
  //   <div class=\"card\">
  //   <form  action=\"Sharee.php\" method=\"post\">
  //     <img src=\"$productimage\" alt=\"Red Paisleys\" style=\"width:100%\">
  //     <h1>$productname</h1>
  //     <p class=\"price\">$productprice BDT</p>
  //     <p>$productdetails</p>
  //     <p><button type=\"submit\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button></p>
  //     <input type=\"hidden\" name=\"product_id\" value= '$productid' >
  //   </form>
  // </div>
  //   " ;
  //   echo $elements;
  // };
  function productsharee($productname, $productprice, $productdetails, $productimage,$productid){
    $elements = "
    <div class=\"card\" id='$productid'>
      <img src=\"$productimage\" alt=\"Red Paisleys\" style=\"width:100%\">
      <h1>$productname</h1>
      <p class=\"price\">$productprice BDT</p>
      <p>$productdetails</p>
      <p><button  onclick=\"cart('$productid')\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button></p>
      <input type=\"hidden\" id=\"name\" value=\"$productname\">
      <input type=\"hidden\" id=\"price\" value=\"$productprice\">
      <input type=\"hidden\" name=\"product_id\" value= '$productid' >
  </div>
    " ;
    echo $elements;
    // <input class=\"product-button\" type=\"button\" value=\"Add to Cart\" onclick=\"cart('$productid')\">
  };

  // function productpant($productname, $productprice, $productdetails, $productimage,$productid){
  //   $elements = "
  //   <div class=\"card\">
  //   <form  action=\"Pant.php\" method=\"post\">
  //     <img src=\"$productimage\" alt=\"Red Paisleys\" style=\"width:100%\">
  //     <h1>$productname</h1>
  //     <p class=\"price\">$productprice BDT</p>
  //     <p>$productdetails</p>
  //     <p><button type=\"submit\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button></p>
  //     <input type=\"hidden\" name=\"product_id\" value= '$productid' >
  //   </form>
  // </div>
  //   " ;
  //   echo $elements;
  // };
  function productpant($productname, $productprice, $productdetails, $productimage,$productid){
    $elements = "
    <div class=\"card\" id='$productid'>
      <img src=\"$productimage\" alt=\"Red Paisleys\" style=\"width:100%\">
      <h1>$productname</h1>
      <p class=\"price\">$productprice BDT</p>
      <p>$productdetails</p>
      <p><button  onclick=\"cart('$productid')\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button></p>
      <input type=\"hidden\" id=\"name\" value=\"$productname\">
      <input type=\"hidden\" id=\"price\" value=\"$productprice\">
      <input type=\"hidden\" name=\"product_id\" value= '$productid' >
  </div>
    " ;
    echo $elements;
    // <input class=\"product-button\" type=\"button\" value=\"Add to Cart\" onclick=\"cart('$productid')\">
  };

  // function productshirt($productname, $productprice, $productdetails, $productimage,$productid){
  //   $elements = "
  //   <div class=\"card\">
  //   <form  action=\"Shirt.php\" method=\"post\">
  //     <img src=\"$productimage\" alt=\"Red Paisleys\" style=\"width:100%\">
  //     <h1>$productname</h1>
  //     <p class=\"price\">$productprice BDT</p>
  //     <p>$productdetails</p>
  //     <p><button type=\"submit\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button></p>
  //     <input type=\"hidden\" name=\"product_id\" value= '$productid' >
  //   </form>
  // </div>
  //   " ;
  //   echo $elements;
  // };
  function productshirt($productname, $productprice, $productdetails, $productimage,$productid){
    $elements = "
    <div class=\"card\" id='$productid'>
      <img src=\"$productimage\" alt=\"Red Paisleys\" style=\"width:100%\">
      <h1>$productname</h1>
      <p class=\"price\">$productprice BDT</p>
      <p>$productdetails</p>
      <p><button  onclick=\"cart('$productid')\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button></p>
      <input type=\"hidden\" id=\"name\" value=\"$productname\">
      <input type=\"hidden\" id=\"price\" value=\"$productprice\">
      <input type=\"hidden\" name=\"product_id\" value= '$productid' >
  </div>
    " ;
    echo $elements;
    // <input class=\"product-button\" type=\"button\" value=\"Add to Cart\" onclick=\"cart('$productid')\">
  };

  // function productsuit($productname, $productprice, $productdetails, $productimage,$productid){
  //   $elements = "
  //   <div class=\"card\">
  //   <form  action=\"Suit.php\" method=\"post\">
  //     <img src=\"$productimage\" alt=\"Red Paisleys\" style=\"width:100%\">
  //     <h1>$productname</h1>
  //     <p class=\"price\">$productprice BDT</p>
  //     <p>$productdetails</p>
  //     <p><button type=\"submit\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button></p>
  //     <input type=\"hidden\" name=\"product_id\" value= '$productid' >
  //   </form>
  // </div>
  //   " ;
  //   echo $elements;
  // };
  function productsuit($productname, $productprice, $productdetails, $productimage,$productid){
    $elements = "
    <div class=\"card\" id='$productid'>
      <img src=\"$productimage\" alt=\"Red Paisleys\" style=\"width:100%\">
      <h1>$productname</h1>
      <p class=\"price\">$productprice BDT</p>
      <p>$productdetails</p>
      <p><button  onclick=\"cart('$productid')\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button></p>
      <input type=\"hidden\" id=\"name\" value=\"$productname\">
      <input type=\"hidden\" id=\"price\" value=\"$productprice\">
      <input type=\"hidden\" name=\"product_id\" value= '$productid' >
  </div>
    " ;
    echo $elements;
    // <input class=\"product-button\" type=\"button\" value=\"Add to Cart\" onclick=\"cart('$productid')\">
  };

  // function producttshirt($productname, $productprice, $productdetails, $productimage,$productid){
  //   $elements = "
  //   <div class=\"card\">
  //   <form  action=\"T-Shirt.php\" method=\"post\">
  //     <img src=\"$productimage\" alt=\"Red Paisleys\" style=\"width:100%\">
  //     <h1>$productname</h1>
  //     <p class=\"price\">$productprice BDT</p>
  //     <p>$productdetails</p>
  //     <p><button type=\"submit\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button></p>
  //     <input type=\"hidden\" name=\"product_id\" value= '$productid' >
  //   </form>
  // </div>
  //   " ;
  //   echo $elements;
  // };
  function producttshirt($productname, $productprice, $productdetails, $productimage,$productid){
    $elements = "
    <div class=\"card\" id='$productid'>
      <img src=\"$productimage\" alt=\"Red Paisleys\" style=\"width:100%\">
      <h1>$productname</h1>
      <p class=\"price\">$productprice BDT</p>
      <p>$productdetails</p>
      <p><button  onclick=\"cart('$productid')\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button></p>
      <input type=\"hidden\" id=\"name\" value=\"$productname\">
      <input type=\"hidden\" id=\"price\" value=\"$productprice\">
      <input type=\"hidden\" name=\"product_id\" value= '$productid' >
  </div>
    " ;
    echo $elements;
    // <input class=\"product-button\" type=\"button\" value=\"Add to Cart\" onclick=\"cart('$productid')\">
  };
?>
