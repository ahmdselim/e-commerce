<?php
session_start();

$dbUser = "root";
$dbPassword = "";
$dbHost = "localhost";
$dbName = "e-commerce";

$con = mysqli_connect($dbHost, $dbUser, $dbPassword,  $dbName);
$createDB = "CREATE DATABASE IF NOT EXISTS `e-commerce` CHARACTER SET utf8";
$q_createDB = mysqli_query($con, $createDB);

if (isset($_SESSION["u_email"])) {
    $email = $_SESSION["u_email"];
    $selectUsers = "SELECT * FROM `users` WHERE `email` = '$email'";
    $qSelect = mysqli_query($con, $selectUsers);
    while ($result = mysqli_fetch_assoc($qSelect)) {
        $usersData[] = $result;
    }
}



?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
    <link type="text/css" rel="stylesheet" href="../css/products.css" />
    <link type="text/css" rel="stylesheet" href="../css/product.css" />
    <link href="https://fonts.googleapis.com/css?family=Kanit:200" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bentham|Playfair+Display|Raleway:400,500|Suranna|Trocchi" rel="stylesheet">



</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="shop.php?id=123">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="shop.php">Shop</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="categories.php">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="editProfile.php">Edit Profile</a>
                    </li>

                    <?php if (isset($_COOKIE["login"])) : ?>

                        <!-- just admin access to this pages -->
                        <?php if ($usersData[0]["status"] === "1") :  ?>
                            <li class="nav-item">
                                <a class="nav-link" href="cart.php">Cart</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="addProduct.php">Add Product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="signup.php">Add Client</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="addCategory.php">add Category</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="dashboardCat.php">category dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="dashboardUsers.php">users dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="dashboardProducts.php">products dashboard</a>
                            </li>


                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">logout</a></li>

                    <?php endif; ?>

                    <?php if (!isset($_COOKIE["login"])) : ?>

                        <li class="nav-item">
                            <a class="nav-link" href="login.php">login</a>
                        </li>


                    <?php endif; ?>




                </ul>
                <form class="d-flex" action="../handler/search.php" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>