<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Akib Khan">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Products</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
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
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script> -->

    <script src="./js/index.js" defer></script>
</body>

</html>