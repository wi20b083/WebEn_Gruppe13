<?php

$page = 'userList';
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Administration</title>
    <link rel="stylesheet" href="resources/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="bg-dark">
    <div class="container-fluid p-4 text-white">
        <header>
            <nav>
                <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                    <a class="navbar-brand" href="index.php">&nbsp;&nbsp;Clothing G's</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="viewOrder.php"><i class="fas fa-money-check-alt mr-2"></i>Orders</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </nav>
            <div class="row">
                <div class="col-10 ">
                    <h1 class="display-5 pb-4">User List</h1>
                </div>
                <div class="col-2">
                    <button class="btn btn-outline-light" type="button"><a class="text-white text-decoration-none" href="http://localhost/phpmyadmin/">Go to database</a></button>
                </div>
            </div>

        </header>
        <main>
            <?php

            require_once('dbcontroller.php');

            $sql = "SELECT * FROM users";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($id, $fname, $lname, $address, $zip, $city, $email, $uname, $pwd, $status);
            ?>
        


            <?php

            while ($stmt->fetch()) {
                    ?>
                    <div class="border rounded row me-5 ms-5 mt-2 mb-2 pt-2 pb-2 ps-3 pe-3">
                        <div class="col">
                            <?php
                                    echo 'Username:  ' . $uname . '<br>';
                                    echo 'First Name:  ' . $fname . '<br>';
                                    echo 'Last Name:  ' . $lname . '<br>';
                                    echo 'Email:  ' . $email . '<br>';
                                    echo 'Status:  ' . $address . '<br>';
                                    ?>
                                     <?php echo "<td><a href='viewOrder.php?id=" . $id . " class='btn btn-secondary'>View Order! </a></td>"; ?>
                                     <br>
                            <br>
                        </div>
                        
                        <!--Abfrage ob user status activated oder not-activated, je nachdem soll eine andere art von button angezeigt werden, wenn activated dann roter button mit deactivate und sonst grüner button mit activate-->
                        <form method="GET">
    

                            <?php if ($status == 'activated') { ?>
                                <button type="submit" class="btn btn-danger"><a href="deactivateUser.php?id=<?php echo $id ?>" class="text-white text-decoration-none">Deactivate Account</a></button>
                            <?php
                                    } else { ?>
                                <button type="submit" class="btn btn-success"><a href="activateUser.php?id=<?php echo $id ?>" class="text-white text-decoration-none">Activate Account</a></button>
                            <?php
                                    } ?>
                        

                        </form>
                    </div><br>
            <?php
                
            }
            $stmt->close();
            $conn->close();


            ?>

        </main>
    </div>
</body>

</html>