<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>


<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="stylesheet" href="../res/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../../backend/image/logo-clothing-gs.png">
</head>


<!-- Registration Form -->
<body>
    <?php include "../nav/navbar.php";  ?>
    <div class="container mb-3">
        <main>
            <form id="signup">
                <h1>SignUp Form</h1>
                <br>
<!-- First name + Error  -->
                <div class="mb-3">
                    <label for="fname" class="form-label">Firstname </label>
                    <div class="row">
                        <small class="text-danger mb-1" id="fnameErr"></small class="text-danger mb-1">
                    </div>
                    <input required class="form-control" type="text" id="fname" name="fname" placeholder="John">
                </div>
<!-- Last name + Error  -->
                <div class="mb-3">
                    <label for="lname" class="form-label">Lastname </label>
                    <div class="row">
                        <small class="text-danger mb-1" id="lnameErr"></small class="text-danger mb-1">
                    </div>
                    <input required class="form-control" type="text" id="lname" name="lname" placeholder="Doe">
                </div>
<!-- Username + Error -->
                <div class="mb-3">
                    <label for="uname" class="form-label">Username </label>
                    <div class="row">
                        <small class="text-danger mb-1" id="unameErr"></small class="text-danger mb-1">
                    </div>
                    <input required class="form-control" type="text" id="uname" name="uname" placeholder="johndoe">
                </div>
<!-- Password + Error  -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="row">
                        <small class="text-danger mb-1" id="passwordErr"></small class="text-danger mb-1">
                    </div>
                    <input required type="password" class="form-control" id="password" name="password">
                    <div id="passwordHelp" class="form-text">Password must has at least 8 characters that include at
                        least 1 lowercase character, 1 uppercase characters, 1 number, and 1 special character in
                        (!@#$%^&*)</div>
                </div>
<!-- Password Confirm + Error  -->
                <div class="mb-3">
                    <label for="confpassword" class="form-label">Confirm Password</label>
                    <div class="row">
                        <small class="text-danger mb-1" id="confpasswordErr"></small class="text-danger mb-1">
                    </div>
                    <input required type="password" class="form-control" id="confpassword" name="confpassword">
                </div>
<!-- Email + Error -->
                <div class="mb-3">
                    <label for="email" class="form-label">E-Mail </label>
                    <div class="row">
                        <small class="text-danger mb-1" id="emailErr"></small class="text-danger mb-1">
                    </div>
                    <input required class="form-control" type="email" id="email" name="email"
                        placeholder="john.doe@example.com">
                </div>
<!-- Street -->
                <div class="mb-3">
                    <div class="row">
                        <div class="col-8">
                            <label for="street" class="form-label">Street</label>
                        </div>
                        <div class="col-4">
                            <label for="streetnr" class="form-label">Street Number</label>
                        </div>
                    </div>
<!-- Streetnumber -->
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <small class="text-danger mb-1" id="streetErr"></small class="text-danger mb-1">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <small class="text-danger mb-1" id="streetnrErr"></small class="text-danger mb-1">
                            </div>
                        </div>
                    </div>
<!-- Errors -->
                    <div class="row">
                        <div class="col-8">
                            <input required id="street" name="street" type="text" class="form-control">
                        </div>
                        <div class="col-4">
                            <input required id="streetnr" name="streetnr" type="text" class="form-control">
                        </div>
                    </div>
                </div>
<!-- City -->
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <div class="row">
                        <small class="text-danger mb-1" id="cityErr"></small class="text-danger mb-1">
                    </div>
                    <input required class="form-control" id="city" name="city" type="text">
                </div>
<!-- ZIP -->
                <div class="mb-3">
                    <label for="zip" class="form-label">Zip Code </label>
                    <div class="row">
                        <small class="text-danger mb-1" id="zipErr"></small class="text-danger mb-1">
                    </div>
                    <input required class="form-control" id="zip" name="zip" type="text">
                </div>

<!-- Button Submit -->
                <div class="mb-3">
                    <button type="submit" name="submit" class="btn btn-secondary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>

                <div class="mb-3">
                    <p>Already a member? <a href="login.php">Sign in</a></p>
                </div>
            </form>
        </main>
    </div>

    <?php include "../nav/footer.php";  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9/sha256.js"></script>
    <script src="../js/signUpValidation.js"></script>
</body>

</html>