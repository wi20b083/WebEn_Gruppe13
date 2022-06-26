<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <link rel='stylesheet' href='../../frontend/res/css/style.css' />
    <link rel="icon" type="image/png" href="../../backend/image/logo-clothing-gs.png">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
</head>
<body>   
<?php
include "../nav/navbar.php"
?>






<!-- Ad Product Form -->
<form method="post" enctype="multipart/form-data" action="../../backend/logic/uploadProductImage.php" id="ticketform">

     <div class="container border border-1 border-dark rounded mb-3 mt-3">

         <div class="mb-3">
            <label for="img" class="form-label">Productpicture</label>
            <!-- set the accepted file types -->
             <input accept="image/jpeg" class="form-control" type="file" id="pimg" name="pimg">
         </div>
            <!-- ProdcutName -->
         <div class="mb-3">
            <label for="pname" class="form-label">Productname</label>
             <input class="form-control" type="text" id="pname" name="pname">
         </div>
            <!-- Price -->
         <div class="mb-3">
             <label for="pprice" class="form-label">Price</label>
             <input class="form-control" type="number" id="pprice" name="pprice" min = "0" step ="0.01">
         </div>
          
            <!-- Code -->
         <div class="mb-3">
             <label for="pcode" class="form-label">Code</label>
             <input class="form-control" type="number" id="pcode" name="pcode">
         </div>

            <!-- Category -->
         <div class="mb-3">
             <label for="pcategory" class="form-label">Category</label>
            <div class="mb-3">
                <select id="pcategory" name="pcategory">
                    <option value="Shirt">Shirt</option>
                    <option value="Pullover">Pullover</option>
                    <option value="Hose">Hose</option>
                </select>
            </div>
         </div>


        <div class="mb-3">
              <span class="text-danger"> </span>
         </div>

         <!-- Submit Button  -->
         <div class="mb-3">
             <input class="btn btn-primary" id = "buttonAdd" type="submit" value="Add">
         </div>
    </div>

    <p id= "test"></p>
</form>











<?php
include "../nav/footer.php"
?>
<!-- JS Files -->
<script src="../js/addProduct.js"></script>

</body>
</html>