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
    <title>Imprint</title>
    <link rel="icon" type="image/png" href="../../backend/image/logo-clothing-gs.png">
</head>

<body>
<!-- Basic Imprint  -->

    <?php include "../nav/navbar.php";  ?>
    <div id="ImprintDiv1" class="container border border-dark rounded text-center mt-5 pt-5 mb-5 ">

        <div id="headerDivImprint" class="container mb-5">
            <h1 id="header1Imprint" class="fw-bold">IMPRINT</h1>
        </div>

        <hr>

        <img src="..\res\img\logo-clothing-gsrichtig.png" alt="" class="pt-3">

        <div>

            <ul class="list-unstyled">
                <li id="imprintName" class="fs-4 fw-bold pt-4">Webshop Clothing-Gs</li>
                <li class="fw-bold pt-5">ADDRESS: </li>
                <li id="imprintAdress" class="pt-2  ">Höchstädtplatz 6 <br> 1200 Wien, Österreich</li>
                <li class="fw-bold pt-5">CONTACT:</li>
                <li id="imprintContactWebshop" class="pt-2">Webshop phone number: +43 676 123123123 </li>
                <li id="imprintContactEmail" class="pt-2"> Webshop E-Mail: clothing-gs@webshop.com </li>
                <li class="fw-bold pt-5"> UID-NUMBER:</li>
                <li id="imprintUidNumber" class="pt-2">123123123</li>
                <li class="fw-bold pt-5">CHAMBER MEMBERSHIP:</li>
                <li id="imprintChamberMembership" class="pt-2">Regional court Vienna </li>
                <li class="fw-bold pt-5">Employees:</li>
                <li class="pt-2">Florian Huber, Akib Kahn, Nils Petsch</li>



            </ul>

        </div>

        <div id="aboutUs">
            <div class="fs-5 fw-bold pt-5">ABOUT US</div>
            <div id="ImprintAboutUs" class="pt-2"> Our <strong>MISSION</strong> is to let your own style run wild. <br>
                Besides creative designs and comfortable clothing, we want everyone to find their own style with us!
            </div>
            <div id="ImprintAboutUsInfo" class="pt-4 pb-5"> <strong>Clothing-Gs</strong> was founded in 2022 by the
                managing director Florian Huber, Akib Kahn und Nils Petsch. <br> based in Vienna (Austria) </div>
        </div>

    </div>

</body>

<footer>
    <?php include "../nav/footer.php" ?>
</footer>

</html>