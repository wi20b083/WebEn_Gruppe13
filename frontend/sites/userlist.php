<!DOCTYPE html>
<html lang="en">
<!-- Admin Userlist Seite -->
<head>
    <meta charset="UTF-8">
    <title>User Administration</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href='../res/css/style.css' />
    <link rel="icon" type="image/png" href="../../backend/image/logo-clothing-gs.png">

</head>

<body id="body">
    <!-- Nav bar -->
    <?php
    include "../nav/navbar.php"
    ?>
    <div class="container-fluid p-4">
        <!--   Modal which triggers when button view order is clicked -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalHeader">No orders placed yet.</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="modalClose"></button>
                    </div>
                    <div class="modal-body" id="modalBody">
                        <div class="list-group" id="orderList">
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>


    <!-- Div where list will be generated  -->
    <div class="container" id="main">
        </div>
    </div>

    <?php include "../nav/footer.php";  ?>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <!-- JS Files -->
    <script src="../js/userList.js"></script>
</body>

</html>