<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9/sha256.js"></script>
</head>

<body>
<?php include "../nav/navbar.php";  ?>
    <div class="container mb-3">
        <main>
            <form id="login">
                <h1>Login</h1>
                <br>
                <div class="row mb-3">
                    <label for="uname" class="form-label">Username </label>
                    <input required class="form-control" type="text" id="uname" name="uname" placeholder="Username">
                </div>
                <div class="row mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input required type="password" class="form-control" id="password" name="password">
                </div>
                <div class="row mb-1">
                    <small class="text-danger" id="loginErr"></small>
                </div>
                <div class="mb-3">
                    <button type="submit" name="submit" class="btn btn-secondary">Submit</button>
                </div>

                <div class="mb-3">
                    <p>Not a member? <a href="signup.php">Sign up</a></p>
                </div>
            </form>
        </main>
    </div>
    <script src="../js/login.js"></script>
</body>

</html>