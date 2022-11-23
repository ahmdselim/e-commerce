<?php
require_once("../inc/header.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $quantity = $_POST["quantity"];
    $id = $_POST["id"];
    $email = $_SESSION["u_email"];
    $errors = [];

    if (empty($quantity)) {
        $errors[] = "quantity is required";
    } else if ($quantity <= 0) {
        $errors[] = "quantity must be greater than 0 to add to cart try again ya wla";
    } else if (strlen($quantity) > 100) {
        $errors[] = "quantity must be less than 100";
    }

    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        header("location:../pages/product.php?id=$id");
    } else {
        unset($_SESSION["errors"]);
        $_SESSION["success"] = "your product added to cart :) enjoy ya wla";
        $create_cart = "CREATE TABLE IF NOT EXISTS `cart` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            quantity VARCHAR(100) NOT NULL,
            product_id INT NOT NULL,
            user_email VARCHAR(100) NOT NULL,
            FOREIGN KEY (product_id) REFERENCES items(id),
            FOREIGN KEY (user_email) REFERENCES users(email)
        )";
        mysqli_query($con, $create_cart);

        $add_to_cart = "INSERT INTO `cart` (`quantity`,`product_id`,`user_email`) VALUES('$quantity','$id','$email')";
        mysqli_query($con, $add_to_cart);

        header("location:../pages/product.php?id=$id");
    }
} else {
    echo <<<TYPE
    <div id="notfound"><div class="notfound"><div class="notfound-404"><h1>404</h1></div><h2>Oops! Nothing was found</h2><p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a href="../pages/signupPage.php">Return to homepage</a></p></div></div>
    TYPE;
}
