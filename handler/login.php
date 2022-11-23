<?php
require_once("../inc/header.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $errors = [];
    $hashPassword = sha1($password);

    $selectUsers = "SELECT * FROM `users` WHERE email = '$email' && password = '$hashPassword'";
    $q_selectUsers = mysqli_query($con, $selectUsers);
    while ($result = mysqli_fetch_assoc($q_selectUsers)) {
        $data[] = $result;
    }



    if (empty($email)) {
        $errors[] = "email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = " email is not valid ";
    } else if (empty($data)) {
        $errors[] = "email or password not true";
    }

    if (empty($password)) {
        $errors[] = "password is required";
    }

    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;

        header("location:../pages/login.php");
    } else {
        unset($_SESSION["errors"]);

        $_SESSION["u_email"] = $email;
        $_SESSION["success"] = "Welcome back ❤ enjoy :)";
        setcookie("login", "login", time() + 3600, "/");
        header("location:../pages/shop.php");
    }
} else {
    echo <<<TYPE
    <div id="notfound"><div class="notfound"><div class="notfound-404"><h1>404</h1></div><h2>Oops! Nothing was found</h2><p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a href="../pages/signupPage.php">Return to homepage</a></p></div></div>
    TYPE;
}
