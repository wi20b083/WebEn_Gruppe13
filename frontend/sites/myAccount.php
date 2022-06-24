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
<div class="container  mb-3 mt-3" >

    <h2 class = "text-center"> My Account</h2>
</div>

<div class ="container">
<h3 id ="gretting" class ="mt-2"> </h3>
</div>
    



<form class = "mb-5"id="formMyAccount"name="form" method="post" action="" enctype="multipart/form-data" >

    <div id ="formAccount" class="container border border-1 border-dark rounded mb-3 mt-3">
      <div class="mb-3">
        <label for="uname" class="form-label">Username</label>
        <input class="form-control" type="text" id="uname" name="uname" readonly>
      </div>
      <div class="mb-3">
        <label for="fname" class="form-label">First Name </label>
        <input id = "fname"  class ="form-control" type="text"  value=""  name="fname" readonly>
      </div>

      <div class="mb-3">
        <label for="lname" class="form-label m-2">Last Name</label>
        <input id = "lname" class ="form-control" type="text"  value="" name="lname"readonly>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label m-2">E-Mail</label>
        <input id = "email" class ="form-control" type="text"  value="" name="email" readonly>
      </div>
      <div class="mb-3">
        <label for="address" class="form-label">Adress</label>
        <input id = "address" class ="form-control" type="text"  value="" name="address" readonly>
      </div>
      <div class="mb-3">
        <label for="city" class="form-label">City</label>
        <input id = "city" class ="form-control" type="text"  value="" name="city" readonly>
      </div>
      
      <div class="mb-3">
        <label for="zip" class="form-label">ZIP</label>
        <input id="zip" class ="form-control" type="number"  value="" name="zip" readonly>
      </div>

      <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Edit
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Confirm your Password</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="container mb-3">
            <div id="checkPassword">
                <h1 class =" pt-3">Confirm Password</h1>
                <br>
                <div class="row mb-3">
                    <label for="password" class="form-label">Enter Password</label>
                    <div class="row mb-1">
                        <small class="text-danger" id="checkPasswordError"></small>
                    </div>
                    <input required type="password" class="form-control" id="password" name="password">
                </div>
            </div >
        

    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" id="confirmPassword" class="btn btn-primary">Confirm</button>
            </div>
          </div>
        </div>
      </div>

      </div>
      
    </form>
        <div class="m-3">
        <p id ="link"><a id ="linkedit" href= "../sites/myOrders.php">My Orders </a></p>
      </div>

<?php
include "../nav/footer.php"
?>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src="../js/myAccount.js"></script>
<script src="../js/checkPassword.js"></script>
</body>
</html>