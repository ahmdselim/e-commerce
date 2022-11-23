<?php
require_once("../inc/header.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $u_email = $_SESSION["u_email"];
    $password = $_POST["password"];
    $name = htmlentities(htmlspecialchars($_POST["name"]));
    $errors = [];
    $hashPassword = sha1($password);

    if (empty($name)) {
        $errors[] = "name is required";
    } else if (strlen($name) < 3) {
        $errors[] = "name must greater than 6 char";
    } else if (strlen($name) > 25) {
        $errors[] = "name must less than 25 char";
    }

    if (empty($password)) {
        $errors[] = "password is required";
    } else if (strlen($password) < 6) {
        $errors[] = "password must greater than 6 char";
    } else if (strlen($password) > 20) {
        $errors[] = "password must less than 20 char";
    }



    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;

        header("location:../pages/editProfile.php");
    } else {
        unset($_SESSION["errors"]);


        $insertUsers = "UPDATE `users` SET `name`='$name',`password`='$hashPassword' WHERE email='$u_email'";
        mysqli_query($con, $insertUsers);
        $_SESSION["success"] = "Congrats 🎉 users updated :)";
        header("location:../pages/editProfile.php");
    }
} else {
    echo <<<TYPE
    <div id="notfound"><div class="notfound"><div class="notfound-404"><h1>404</h1></div><h2>Oops! Nothing was found</h2><p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a href="../pages/signupPage.php">Return to homepage</a></p></div></div>
    TYPE;
}
