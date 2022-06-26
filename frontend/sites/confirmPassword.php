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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9/sha256.js"></script>
    <link rel="icon" type="image/png" href="../../backend/image/logo-clothing-gs.png">
</head>
<body>
<?php
include "../nav/navbar.php"
?>    

<!--  check Password -->
    <div class="container mb-3">
        <main>
            <div id="check Password">
                <h1 class =" pt-3">Confirm Password</h1>
                <br>
                <div class="row mb-3">
                    
                    <label for="password" class="form-label">Enter Password</label>
                    <div class="row mb-1">
                        <small class="text-danger" id="checkPasswordError"></small>
                    </div>
                    <input required type="password" class="form-control" id="password" name="password">
                </div>
                <!-- Button confirm -->
                <div class="mb-3">
                    <button id="confirmPassword" class="">Confirm</button>
                </div>

            </div >
        </main>

    </div>


    <?php include "../nav/footer.php";  ?>
<!-- Js File -->
<script src="../js/checkPassword.js"></script>

</body>

<footer>

 
</footer>
</html>