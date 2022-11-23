<?php
require_once("../inc/header.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["id"])) {
        $id =  $_POST["id"];
        $name = $_POST["name"];
        $image = $_FILES["image"];
        $image_name = $_FILES["image"]["name"];
        $image_tmp_name = $_FILES["image"]["tmp_name"];
        $image_error = $_FILES["image"]["error"];
        $image_size = $_FILES["image"]["size"];
        $image_type = $_FILES["image"]["type"];
        $extensions = ["png", "jpg", "jpeg"];
        if (!empty($image_name)) {
            $image_extension = pathinfo($image_name)["extension"];
        }


        $selectItems = "SELECT * FROM `categories` WHERE id='$id'";
        $q_items = mysqli_query($con, $selectItems);

        while ($result = mysqli_fetch_assoc($q_items)) {
            $data[] = $result;
        }

        if (isset($data)) {

            $newName = uniqid("", true) . "." . $image_extension;
            $image =  $data[0]['image'];

            if ($image_error !== 0) {
                $selectItems = "UPDATE `categories` SET `cat_name`='$name' WHERE id='$id'";
                mysqli_query($con, $selectItems);
                $_SESSION["success"] = "congrats :) your category updated successfully keep going 👍";
                header("location:../pages/editCategory.php?id=$id");
            } else {
                $selectItems = "UPDATE `categories` SET `cat_name`='$name',`image`='$newName' WHERE id='$id'";

                mysqli_query($con, $selectItems);
                $distention =  "../uploads/categories/" . $newName;
                move_uploaded_file($image_tmp_name, $distention);
                unlink("../uploads/categories/$image");
                $_SESSION["success"] = "congrats :) your category updated successfully keep going 👍";
                header("location:../pages/editCategory.php?id=$id");
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
} else {
    echo <<<TYPE
    <div id="notfound"><div class="notfound"><div class="notfound-404"><h1>404</h1></div><h2>Oops! Nothing was found</h2><p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a href="../pages/signupPage.php">Return to homepage</a></p></div></div>
    TYPE;
}
