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
  <title>Document</title>
  <link rel="icon" type="image/png" href="../../backend/image/logo-clothing-gs.png">
</head>
<body>
<?php include "../nav/footer.php";  ?>
  <!-- direction to Index php  -->
<script> window.location= ("../index.php");</script>
</body>

</html>