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

    <link rel="icon" type="image/png" href="../../backend/image/logo-clothing-gs.png">
</head>

<body>
    <?php include "../nav/navbar.php";  ?>
    <h1 class="text-center mt-2">Product Editor</h1>
    <div class="m-2">


        <!-- Form where the product can be added  - pid and username are readonly  -->
        <form id="formEditProduct" name="form" method="post" action="../../backend/logic/updateImage.php"
            enctype="multipart/form-data">

            <div class="container border border-1 border-dark rounded mb-3 mt-3">

                <!-- new Image Upload -->
                <div class="mb-3">
                    <label for="pimgEdit" class="form-label">New Image</label>
                    <input accept="image/jpeg" class="form-control" type="file" id="pimgEdit" name="pimgEdit">
                </div>

                <!-- Pid -->
                <div class="mb-3">
                    <label for="pid" class="form-label">Product-ID</label>
                    <input id="pid" class="form-control" type="text" class="pid " value="" name="pid" readonly>
                </div>
                <!-- Productname -->
                <div class="mb-3">
                    <label for="pname" class="form-label m-2">Productname</label>
                    <input id="pname" class="form-control" type="text" class="pname" value="" name="pname">
                </div>
                <!-- Productprice -->
                <div class="mb-3">
                    <label for="pprice" class="form-label m-2">Productprice</label>
                    <input id="pprice" class="form-control" type="number" class="pprice" value="" name="pprice"
                        step="0.01" min="0">
                </div>
                <!-- Productcode -->
                <div class="mb-3">
                    <label for="pcode" class="form-label">Productcode</label>
                    <input id="pcode" class="form-control" type="number" class="pcode" value="" name="pcode" min="0"
                        readonly>
                </div>

                <!-- Product category -->
                <div class="mb-3">
                    <label for="pcategory" class="form-label">Category</label>
                    <select id="pcategory" type="" name="pcategory">
                        <option value="Shirt">Shirt</option>
                        <option value="Pullover">Pullover</option>
                        <option value="Hose">Hose</option>
                    </select>
                </div>
                <!-- current image  -->
                <!--   Image has still to be sized -->
                <div class="mb-3">
                    <label for="img" class="form-label"></label>
                    <input id="imgSrc" class="form-control" type="hidden" class="imgSrc" name="imgSrc">
                </div>

                <!-- Button Save to save Product changes -->

                <div class="mb-3">
                    <input class="btn btn-primary" id="buttonSave" name="submit" type="submit" value="Save">
                </div>
                <img alt="productPicture" id="imgProd" name="imgProd">
            </div>

        </form>




    </div>
    <!-- Table for all Products -->
    <div class="container-fluid border border-secondary rounded m-4">
        <table class="table w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Code</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="productTable">
            </tbody>
        </table>
    </div>







    <?php include "../nav/footer.php";  ?>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>

    <script src="../js/editProduct.js"></script>


</body>

</html>