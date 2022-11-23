<?php
require_once("../inc/header.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["id"])) {
        $id =  $_GET["id"];

        $selectItems = "SELECT * FROM `users` WHERE id='$id'";
        $q_items = mysqli_query($con, $selectItems);

        while ($result = mysqli_fetch_assoc($q_items)) {
            $data[] = $result;
        }

        if (isset($data)) {
            $selectItems = "DELETE FROM `users` WHERE id='$id'";
            mysqli_query($con, $selectItems);

            $_SESSION["success"] = "congrats :) user delete successfully keep going 👍";
            header("location:../pages/dashboardUsers.php");
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
