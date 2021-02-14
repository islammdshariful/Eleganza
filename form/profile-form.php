<?php
  function profileDetails(){
    $elements = "
    <div class=\"form-popup\" id=\"profile\">
     <div class=\"form-container\">
       <a href=\"profile.php\" class=\"popup_form\"><pre><img src=\"image/profile-man-user.png\" > Profile</a></pre><br>
       <a href=\"dashboard.php\" class=\"popup_form\"><pre><img src=\"image/list.png\" > Dashboard</a></pre><br>
       <a href=\"logout.php\" class=\"popup_form\"><pre><img src=\"image/sign-out-option.png\" > Log Out</a></pre><br>
       <a href=\"#\" onclick=\"closeProfile()\"><img src=\"image/cancel.png\" ></a>
    </div>
    </div>
    " ;
    echo $elements;
  };

  function profile_admin_Details(){
    $elements = "
    <div class=\"form-popup\" id=\"profile\">
     <div class=\"form-container\">
       <a href=\"order.php\" class=\"popup_form\"><pre><img src=\"image/task-list.png\" > Order</a></pre><br>
       <a href=\"manage-product.php\" class=\"popup_form\"><pre><img src=\"image/supplier.png\" > Manage Product</a></pre><br>
       <a href=\"profile.php\" class=\"popup_form\"><pre><img src=\"image/profile-man-user.png\" > Profile</a></pre><br>
       <a href=\"logout.php\" class=\"popup_form\"><pre><img src=\"image/sign-out-option.png\" > Log Out</a></pre><br>
       <a href=\"#\" onclick=\"closeProfile()\"><img src=\"image/cancel.png\" ></a><br>
    </div>
    </div>
    " ;
    echo $elements;
  };

  function openProfile(){
    $elements = "
    <div class=\"form-popup\" id=\"myForm\">
    <div class=\"form-container\">
       <a href=\"login.php\" class=\"popup_form\"><label> Login</label></a>
       <a href=\"registration.php\" class=\"popup_form\"><label > Registration</label></a>
       <a href=\"#\" onclick=\"closeForm()\"><img src=\"image/cancel.png\"  ></a>
    </div>
    </div>
    " ;
    echo $elements;
  };

  function openMens(){
    $elements = "
    <div class=\"form-popup-men\" id=\"men\">
    <div class=\"form-container-men\">
       <a href=\"Pant.php\" class=\"popup_form\"><label> Pant</label></a><br><br>
       <a href=\"Shirt.php\" class=\"popup_form\"><label > Shirt</label></a><br><br>
       <a href=\"Suit.php\" class=\"popup_form\"><label > Suit</label></a><br><br>
       <a href=\"T-Shirt.php\" class=\"popup_form\"><label > T-Shirt</label></a><br><br>
       <a href=\"#\" onclick=\"closeMen()\"><img src=\"image/cancel.png\"  ></a>
    </div>
    </div>
    " ;
    echo $elements;
  }
  function openWomens(){
    $elements = "
    <div class=\"form-popup-women\" id=\"women\">
    <div class=\"form-container-women\">
       <a href=\"Kamiz.php\" class=\"popup_form\"><label> Kamiz</label></a><br><br>
       <a href=\"Lehenga.php\" class=\"popup_form\"><label > Lehenga</label></a><br><br>
       <a href=\"Sharee.php\" class=\"popup_form\"><label > Sharee</label></a><br><br>
       <a href=\"Jewelry.php\" class=\"popup_form\"><label > Jewelry</label></a><br><br>
      <a href=\"#\" onclick=\"closeWomen()\"><img src=\"image/cancel.png\"  ></a>
    </div>
    </div>
    " ;
    echo $elements;
  }
?>
