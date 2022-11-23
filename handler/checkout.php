<?php
require_once("../inc/header.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_SESSION["u_email"];
    $allPrice = $_POST["allPrice"];
    $all_cart_id = $_POST["all_cart_id"];


    $create_checkOut = "CREATE TABLE IF NOT EXISTS `checkout` (
        id INT PRIMARY KEY AUTO_INCREMENT,
        product VARCHAR(200) NOT NULL,
        order_price INT NOT NULL,
        user_email VARCHAR(100) NOT NULL,
        FOREIGN KEY (user_email) REFERENCES users(email)
       )";
    mysqli_query($con, $create_checkOut);

    $insert_checkout = "INSERT INTO `checkout` (`product`,`order_price`,`user_email`) VALUES('$all_cart_id','$allPrice','$email')";
    mysqli_query($con, $insert_checkout);

    $explode_cart_id = explode(",", $all_cart_id);

    foreach ($explode_cart_id as $id) {
        $delete_cart_order = "DELETE FROM `cart` WHERE id='$id'";
        mysqli_query($con, $delete_cart_order);
    }

    $_SESSION["success"] = "congrats your orders will reach you after one day";
    header("location:../pages/cart.php");
} else {
    echo <<<TYPE
    <div id="notfound"><div class="notfound"><div class="notfound-404"><h1>404</h1></div><h2>Oops! Nothing was found</h2><p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a href="../pages/signupPage.php">Return to homepage</a></p></div></div>
    TYPE;
}
