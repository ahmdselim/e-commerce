<?php
require_once("../inc/header.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_SESSION["u_email"];
    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $price = $_POST["price"];
    $image = $_FILES["image"];
    $category = $_POST["category"];
    $image_error = $_FILES["image"]["error"];
    $image_name = $_FILES["image"]["name"];
    $image_tmp_name = $_FILES["image"]["tmp_name"];
    $image_size = $_FILES["image"]["size"];
    $image_type = $_FILES["image"]["type"];
    $extensions = ["png", "jpg", "jpeg"];
    $error = [];

    if (!empty($image_name)) {
        $image_extension = pathinfo($image_name)["extension"];
    }

    if (empty($name)) {
        $error[] = " name  of product is required";
    } else if (strlen($name) > 40) {
        $error[] = "name of product must be less than 40 char";
    } else if (strlen($name) < 3) {
        $error[] = "name of product must be greater than 3 char";
    }

    if (empty($desc)) {
        $error[] = " description  of product is required";
    } else if (strlen($desc) > 200) {
        $error[] = "description of product must be less than 200 char";
    } else if (strlen($desc) < 3) {
        $error[] = "description of product must be greater than 3 char";
    }

    if (empty($price)) {
        $error[] = " price  of product is required";
    }

    if (empty($image)) {
        $error[] = " image  of product is required";
    } else if ($image_error != 0) {
        $error[] = "image not upload";
    } else if (!in_array($image_extension, $extensions)) {
        $error[] = "extension of your image not allowed";
    } elseif ($image_size >= 3000000) {
        $errors[] = "product image must be less than 3 MegaBytes";
    }

    if (empty($category)) {
        $error[] = "category of product is required";
    } else if (strlen($category) > 100) {
        $error[] = "category of product must be less than 100 char";
    } else if (strlen($category) < 3) {
        $error[] = "category of product must be greater than 3 char";
    }

    if (!empty($error)) {
        $_SESSION["error"] = $error;
        header("location:../pages/addProduct.php");
    } else {
        unset($_SESSION["error"]);
        $tableDB = "CREATE TABLE IF NOT EXISTS `items` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(30) NOT NULL,
            image VARCHAR(200) NOT NULL,
            description VARCHAR(200) NOT NULL,
            price INT NOT NULL,
            user_email VARCHAR(100) NOT NULL,
            category VARCHAR(100) NOT NULL,
            FOREIGN KEY (user_email) REFERENCES users(email)
            -- FOREIGN KEY (category) REFERENCES categories(cat_name)
        )";
        mysqli_query($con, $tableDB);

        $newName = uniqid("", true) . "." . $image_extension;
        $distention =  "../uploads/products/" . $newName;

        move_uploaded_file($image_tmp_name, $distention);
        $insertDB = "INSERT INTO `items` (`name`,`image`,`description`,`price`,`user_email`,`category`)  VALUES('$name' , '$newName' , '$desc','$price','$email','$category') ";
        mysqli_query($con, $insertDB);


        $_SESSION["success"] = "product uploaded successfully";
        header("location:../pages/shop.php");
    }
} else {
    echo <<<TYPE
    <div id="notfound"><div class="notfound"><div class="notfound-404"><h1>404</h1></div><h2>Oops! Nothing was found</h2><p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a href="../pages/signupPage.php">Return to homepage</a></p></div></div>
    TYPE;
}
