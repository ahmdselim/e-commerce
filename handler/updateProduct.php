<?php
require_once("../inc/header.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["id"])) {
        $id =  $_POST["id"];
        $name = $_POST["name"];
        $desc = $_POST["desc"];
        $price = $_POST["price"];
        $category = $_POST["category"];
        $image = $_FILES["image"];
        $image_name = $_FILES["image"]["name"];
        $image_tmp_name = $_FILES["image"]["tmp_name"];
        $image_error = $_FILES["image"]["error"];
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



        if (empty($category)) {
            $error[] = "category of product is required";
        } else if (strlen($category) > 100) {
            $error[] = "category of product must be less than 100 char";
        } else if (strlen($category) < 3) {
            $error[] = "category of product must be greater than 3 char";
        }
        if (!empty($error)) {
            $_SESSION["errors"] = $error;
            header("location:../pages/editProduct.php?id=$id");
        } else {
            unset($_SESSION["errors"]);

            $selectItems = "SELECT * FROM `items` WHERE id='$id'";
            $q_items = mysqli_query($con, $selectItems);

            while ($result = mysqli_fetch_assoc($q_items)) {
                $data[] = $result;
            }

            if (isset($data)) {
                if ($image_error !== 0) {
                    $selectItems = "UPDATE `items` SET `name`='$name',`description`='$desc',`price`='$price',`category`='$category' WHERE `id`='$id'";

                    mysqli_query($con, $selectItems);
                    $_SESSION["success"] = "congrats :) your product update successfully keep going 👍";
                    header("location:../pages/editProduct.php?id=$id");
                } else {
                    $newName = uniqid("", true) . "." . $image_extension;
                    $selectItems = "UPDATE `items` SET `name`='$name',`image`='$newName',`description`='$desc',`price`='$price',`category`='$category' WHERE id='$id'";

                    mysqli_query($con, $selectItems);
                    $distention =  "../uploads/products/" . $newName;
                    move_uploaded_file($image_tmp_name, $distention);
                    $image =  $data[0]['image'];
                    unlink("../uploads/products/$image");
                    $_SESSION["success"] = "congrats :) your product update successfully keep going 👍";
                    header("location:../pages/editProduct.php?id=$id");
                }
            } else {
                echo <<<TYPE
    <div id="notfound"><div class="notfound"><div class="notfound-404"><h1>404</h1></div><h2>Oops! Nothing was found</h2><p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a href="../pages/signupPage.php">Return to homepage</a></p></div></div>
    TYPE;
            }
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
