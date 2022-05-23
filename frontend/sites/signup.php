<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="stylesheet" href="../res/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mb-3">
        <main>
            <form id="signup">
                <h1>SignUp Form</h1>
                <br>

                <div class="mb-3">
                    <label for="fname" class="form-label">Firstname </label>
                    <div class="row">
                        <small class="text-danger mb-1" id="fnameErr"></small class="text-danger mb-1">
                    </div>
                    <input required class="form-control" type="text" id="fname" name="fname" placeholder="John">
                </div>

                <div class="mb-3">
                    <label for="lname" class="form-label">Lastname </label>
                    <div class="row">
                        <small class="text-danger mb-1" id="lnameErr"></small class="text-danger mb-1">
                    </div>
                    <input required class="form-control" type="text" id="lname" name="lname" placeholder="Doe">
                </div>

                <div class="mb-3">
                    <label for="uname" class="form-label">Username </label>
                    <div class="row">
                        <small class="text-danger mb-1" id="unameErr"></small class="text-danger mb-1">
                    </div>
                    <input required class="form-control" type="text" id="uname" name="uname" placeholder="johndoe">
                </div>

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

                <div class="mb-3">
                    <label for="confpassword" class="form-label">Confirm Password</label>
                    <div class="row">
                        <small class="text-danger mb-1" id="confpasswordErr"></small class="text-danger mb-1">
                    </div>
                    <input required type="password" class="form-control" id="confpassword" name="confpassword">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-Mail </label>
                    <div class="row">
                        <small class="text-danger mb-1" id="emailErr"></small class="text-danger mb-1">
                    </div>
                    <input required class="form-control" type="email" id="email" name="email" placeholder="john.doe@example.com">
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-8">
                            <label for="street" class="form-label">Street</label>
                        </div>
                        <div class="col-4">
                            <label for="streetnr" class="form-label">Street Number</label>
                        </div>
                    </div>

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

                    <div class="row">
                        <div class="col-8">
                            <input required id="street" name="street" type="text" class="form-control">
                        </div>
                        <div class="col-4">
                            <input required id="streetnr" name="streetnr" type="text" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <div class="row">
                        <small class="text-danger mb-1" id="cityErr"></small class="text-danger mb-1">
                    </div>
                    <input required class="form-control" id="city" name="city" type="text">
                </div>

                <div class="mb-3">
                    <label for="zip" class="form-label">Zip Code </label>
                    <div class="row">
                        <small class="text-danger mb-1" id="zipErr"></small class="text-danger mb-1">
                    </div>
                    <input required class="form-control" id="zip" name="zip" type="text">
                </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9/sha256.js"></script>
    <script src="../js/signUpValidation.js"></script>
</body>

</html>