<?php
require_once("../inc/header.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $status = $_POST["status"];
    $name = htmlentities(htmlspecialchars($_POST["name"]));
    $errors = [];
    $hashPassword = sha1($password);


    $selectUsers = "SELECT * FROM `users` WHERE email = '$email'";
    $q_selectUsers = mysqli_query($con, $selectUsers);



    // if (!mysqli_query($con, "SELECT * FROM `users` WHERE email = '$email'")) {
    //     echo ("Error description: " . mysqli_error($con));
    // }

    while ($result = mysqli_fetch_assoc($q_selectUsers)) {
        $data[] = $result;
    }


    if (empty($email)) {
        $errors[] = "email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = " email is not valid ";
    } else if (!empty($data)) {
        $errors[] = "this email in our database please enter another email";
    }

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

    if ($status !== "0" && $status !== "1") {
        $errors[] = "status is required";
    }

    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;

        header("location:../pages/signup.php");
    } else {
        unset($_SESSION["errors"]);
        $createUsers = "CREATE TABLE IF NOT EXISTS `users`(
            id INT PRIMARY KEY AUTO_INCREMENT,
            email VARCHAR(100) UNIQUE NOT NULL,
            name VARCHAR(30) NOT NULL,
            password VARCHAR(60) NOT NULL,
            status INT(2) NOT NULL
        )";
        mysqli_query($con, $createUsers);

        $insertUsers = "INSERT INTO `users` (email,name,password,status) VALUES ('$email','$name','$hashPassword','$status')";
        mysqli_query($con, $insertUsers);
        $_SESSION["success"] = "Congrats 🎉 you'r with us now enjoy :)";
        header("location:../pages/shop.php");
    }
} else {
    echo <<<TYPE
    <div id="notfound"><div class="notfound"><div class="notfound-404"><h1>404</h1></div><h2>Oops! Nothing was found</h2><p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a href="../pages/signupPage.php">Return to homepage</a></p></div></div>
    TYPE;
}
