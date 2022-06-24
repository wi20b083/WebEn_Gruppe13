<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='../res/css/style.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php include "../nav/navbar.php";  ?>
<div class ="m-2">

    <form id="formEditProduct"name="form" method="post" action="../../backend/logic/updateImage.php" enctype="multipart/form-data" >

    <div class="container border border-1 border-dark rounded mb-3 mt-3">
      <div class="mb-3">
        <label for="pimgEdit" class="form-label">New Image</label>
        <input accept="image/jpeg" class="form-control" type="file" id="pimgEdit" name="pimgEdit">
      </div>
      <div class="mb-3">
        <label for="pid" class="form-label">Product-ID</label>
        <input id = "pid"  class ="form-control" type="text" class="pid " value=""  name="pid" readonly>
      </div>

      <div class="mb-3">
        <label for="pname" class="form-label m-2">Productname</label>
        <input id = "pname" class ="form-control" type="text" class="pname" value="" name="pname">
      </div>

      <div class="mb-3">
        <label for="pprice" class="form-label m-2">Productprice</label>
        <input id = "pprice" class ="form-control" type="number" class="pprice" value="" name="pprice" step="0.01" min="0">
      </div>
      <!-- <div class="mb-3">
        <label for="pqty" class="form-label">Product Quantity</label>
        <input id = "pqty" class ="form-control" type="number" class="pqty" value="" name="pqty" min="0">
      </div> -->
      <div class="mb-3">
        <label for="pcode" class="form-label">Productcode</label>
        <input id = "pcode" class ="form-control" type="number" class="pcode" value="" name="pcode" min="0" readonly>
      </div>
      <div class="mb-3">
        <label for="pcategory" class="form-label">Category</label>
        <select id="pcategory" type="" name="pcategory" >
          <option value="Shirt">Shirt</option>
          <option value="Pullover">Pullover</option>
          <option value="Hose">Hose</option>
        </select>
      </div>
        
      <div class="mb-3">
        <label for="img" class="form-label"></label>
        <input id = "imgSrc" class ="form-control" type="hidden" class="imgSrc"  name="imgSrc">
      </div>

      <div class="mb-3">
        <input class="btn btn-primary" id ="buttonSave" name="submit" type="submit" value="Save">
      </div>
      <img  alt="productPicture" id ="imgProd" name="imgProd">
      </div>
      
    </form>

    
    

</div>
<table id ="productTable" class="container m-4"   style="width:80%; border:1px solid black">
  <tr>
    <th>Product_id</th>
    <th>Product_name</th>
    <th>Product_price</th>
    <!-- <th>Product_qty</th> -->
    <th>product_code</th>
    <th>product_category</th>
    <th>Edit Product</th>
  </tr>


</table>








<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  
<script src="../js/editProduct.js"></script>

<?php include "../nav/footer.php";  ?>
</body>
</html>