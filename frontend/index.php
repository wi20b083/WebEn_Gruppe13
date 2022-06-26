<!DOCTYPE html>
<html lang="en">

<!-- Index Seite -->

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Akib Khan">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Index</title>
    <!-- Icon -->
    <link rel="icon" type="image/png" href="../backend/image/logo-clothing-gs.png">
</head>

<body>
    <?php include "./nav/navbar.php";  ?>
    <div class="container-fluid m-2">

        <h1 class="text-center">Products</h1>

        <!--suche mit produkte hidden setzen die nicht den suchterm enthalten-->

        <!--Filter-->
        <div class="row">
            <div class="col">
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <button type="button" class="btn btn-outline-info" id="btnAll">All</button>
                    <button type="button" class="btn btn-outline-info" id="btnShirt">Shirts</button>
                    <button type="button" class="btn btn-outline-info" id="btnSweater">Sweaters</button>
                    <button type="button" class="btn btn-outline-info" id="btnPants">Pants</button>
                </div>
            </div>
            <div class="col">
                <div class="input-group d-grid d-flex justify-content-end flex-nowrap">
                    <div id="search-autocomplete" class="form-outline">
                        <input type="search" id="txtSearch" class="form-control txtSearch" list="datalistOptions"
                            placeholder="Search" />
                        <datalist id="datalistOptions"></datalist>
                    </div>
                    <button type="button" class="btn btn-outline-info btnSearch" id="btnSearch">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
    <!-- Displaying Products -->
    <div class="container-fluid m-2 align-items-center">
        <div id="message"></div>
        <div class="row row-cols-xs-1 row-cols-sm-3 row-cols-md-4 row-cols-lg-5" id="row0"></div>
    </div>
    
    <?php include "./nav/footer.php";  ?>
<!-- JS Files -->
    <script src="./js/index.js" defer></script>
</body>

</html>