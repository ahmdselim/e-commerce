<?php
require_once("../inc/header.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $search = $_GET["search"];


    if (isset($_GET["price"]) || isset($_GET["category"])) {
        $price = $_GET["price"];
        $category = $_GET["category"];
    }

    if (!empty($search) && !empty($price) && !empty($category)) {
        $search_db = "SELECT * FROM `items` WHERE
        `name` LIKE '%$search%' OR
        `price` LIKE '%$price%' OR
        `category` LIKE '%$category%'";
        $q_search = mysqli_query($con, $search_db);
        while ($result = mysqli_fetch_assoc($q_search)) {
            $data[] = $result;
        }
        $_SESSION["search"] = $data;
        header("location:../pages/search.php");
    } else {
        $search_db = "SELECT * FROM `items`WHERE
        `name` LIKE '%$search%' OR
        `price` LIKE '%$search%' OR
        `category` LIKE '%$search%'";
        $q_search = mysqli_query($con, $search_db);
        while ($result = mysqli_fetch_assoc($q_search)) {
            $data[] = $result;
        }
        $_SESSION["search"] = $data;
        header("location:../pages/search.php");
    }
} else {
    echo <<<TYPE
    <div id="notfound"><div class="notfound"><div class="notfound-404"><h1>404</h1></div><h2>Oops! Nothing was found</h2><p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a href="../pages/signupPage.php">Return to homepage</a></p></div></div>
    TYPE;
}
