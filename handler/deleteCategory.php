<?php
require_once("../inc/header.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["id"])) {
        $id =  $_GET["id"];

        $selectItems = "SELECT * FROM `categories` WHERE id='$id'";
        $q_items = mysqli_query($con, $selectItems);

        while ($result = mysqli_fetch_assoc($q_items)) {
            $data[] = $result;
        }

        if (isset($data)) {
            $selectItems = "DELETE FROM `categories` WHERE id='$id'";
            mysqli_query($con, $selectItems);
            $image =  $data[0]['image'];
            unlink("../uploads/categories/$image");

            $_SESSION["success"] = "congrats :) your category delete successfully keep going 👍";
            header("location:../pages/dashboardCat.php");
        } else {
            echo <<<TYPE
    <div id="notfound"><div class="notfound"><div class="notfound-404"><h1>404</h1></div><h2>Oops! Nothing was found</h2><p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a href="../pages/signupPage.php">Return to homepage</a></p></div></div>
    TYPE;
        }
    } else {
        echo <<<TYPE
    <div id="notfound"><div class="notfound"><div class="notfound-404"><h1>404</h1></div><h2>Oops! Nothing was found</h2><p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a href="../pages/signupPage.php">Return to homepage</a></p></div></div>
    TYPE;
    }
} else {
    echo <<<TYPE
    <div id="notfound"><div class="notfound"><div class="notfound-404"><h1>404</h1></div><h2>Oops! Nothing was found</h2><p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a href="../pages/signupPage.php">Return to homepage</a></p></div></div>
    TYPE;
}
