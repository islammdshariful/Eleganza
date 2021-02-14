<!DOCTYPE html>
<html>
<head>
  <div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h2>Edit Product</h2>
            <p>UPDATE PRODUCT INFORMATION</p>
        </div>
    </div>

    <div class="row">


        
        <div class="col-md-8 col-xl-9">
            <form id="contact-form" name="contact-form" action="#" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id" id="id" value="<?php echo $product['id'] ?>">

                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name" class="">Product Name</label>
                            <input type="text" id="name" name="name" value="<?php echo $product['name'] ?>" class="form-control">
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="description" class="">Product Description</label>
                            <textarea type="text" id="description" name="description" class="form-control"><?php echo $product['description'] ?></textarea>
                        </div>
                    </div>





                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="price">Product Price</label>
                            <input type="text" id="price" name="price" value="<?php echo $product['price'] ?>" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="quantity">Product Quantity</label>
                            <input type="number" id="quantity" name="quantity" value="<?php echo $product['quantity'] ?>" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="product_type">Product Type</label>
                            <select class="form-control" name="product_type" id="product_type">
                                <option value="1">Kamiz</option>
                                <option value="2">Sharee</option>
                                <option value="3">Jewlery</option>
                                <option value="4">Lehenga</option>
                            </select>
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="gender_type">Gender Type</label>
                            <select class="form-control" name="gender_type" id="gender_type">
                                <option value="0">Male</option>
                                <option value="1">Female</option>
                            </select>
                        </div>
                    </div>






                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="image">Upload Image</label>
                            <input type="file" id="image" name="image" onchange="readURL(this);">
                            <p class="help-block">upload image here</p>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <img class="img-responsive" id="product_image" name="product_image"  src="../image/<?php echo $product['image']?>" alt="">
                    </div>


                </div>
              



                <div class="center-on-small-only">
                    <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
                </div>

            </form>
            <div class="status"></div>
        </div>
    
    </div>
</div>
</body>
</html>


