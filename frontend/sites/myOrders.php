<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyOrders</title>
    <link rel='stylesheet' href='../res/css/style.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="icon" type="image/png" href="../../backend/image/logo-clothing-gs.png">

</head>

<body>
    <?php
include "../nav/navbar.php"
?>
  
  <h1 class="text-center mt-2">My Orders</h1>
    <div id="myOrders" class="container mt-4 mb-4">
     <!-- Div where order will get appended -->
        <div class="list-group" id="orderList">
        </div>
    </div>

    <?php
include "../nav/footer.php"
?>


    <script src="https://unpkg.com/jspdf-invoice-template@1.4.3/dist/index.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <!-- JS Files -->
    <script src="../js/myOrders.js"></script>
</body>


</html>