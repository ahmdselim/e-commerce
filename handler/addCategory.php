<?php
require_once("../inc/header.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $image = $_FILES["image"];
    $image_name = $_FILES["image"]["name"];
    $image_tmp_name = $_FILES["image"]["tmp_name"];
    $image_error = $_FILES["image"]["error"];
    $image_size = $_FILES["image"]["size"];
    $image_type = $_FILES["image"]["type"];
    $extensions = ["png", "jpg", "jpeg"];
    $email = $_SESSION["u_email"];
    $errors = [];


    if (!empty($image_name)) {
        $image_extension = pathinfo($image_name)["extension"];
    }

    if (empty($name)) {
        $errors[] = "name of category is required";
    } else if (strlen($name) < 3) {
        $errors[] = "name of category must be greater than 3 char";
    } elseif (strlen($name) > 100) {
        $errors[] = "name of category must be less than 100 char";
    }

    if (empty($image)) {
        $errors[] = "image of category is required";
    } else if ($image_error !== 0) {
        $errors[] = "image not uploaded please try again";
    } else if (!in_array($image_extension, $extensions)) {
        $error[] = "extension of your image not allowed";
    } else if ($image_size >= 3000000) {
        $errors[] = "product image must be less than 3 MegaBytes";
    }

    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        header("location:../pages/addCategory.php");
    } else {
        unset($_SESSION["errors"]);
        $create_category = "CREATE TABLE IF NOT EXISTS `categories` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            cat_name VARCHAR(100) NOT NULL,
            image VARCHAR(100) NOT NULL
        )";
        mysqli_query($con, $create_category);

        $newName = uniqid("", true) . "." . $image_extension;
        $distention =  "../uploads/categories/" . $newName;

        move_uploaded_file($image_tmp_name, $distention);
        $insert_category = "INSERT INTO `categories` (`cat_name`,`image`) VALUES ('$name','$newName')";
        mysqli_query($con, $insert_category);

        $_SESSION["success"] = "category uploaded successfully";
        header("location:../pages/addCategory.php");
    }
} else {
    echo <<<TYPE
    <div id="notfound"><div class="notfound"><div class="notfound-404"><h1>404</h1></div><h2>Oops! Nothing was found</h2><p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a href="../pages/signupPage.php">Return to homepage</a></p></div></div>
    TYPE;
}
