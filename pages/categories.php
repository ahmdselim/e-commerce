<?php
require_once("../inc/header.php");

if (!isset($_COOKIE["login"])) {
    header("location:./login.php");
}

$selectItems = "SELECT * FROM `categories`";
$q_items = mysqli_query($con, $selectItems);

while ($result = mysqli_fetch_assoc($q_items)) {
    $data[] = $result;
}

if (isset($_SESSION["success"])) { ?>
    <div class="alert alert-primary" role="alert">
    <?php echo $_SESSION["success"];
    unset($_SESSION["success"]);
}

    ?>
    </div>

    <?php if (isset($data)) : ?>

        <div class="shell">
            <div class="container">
                <div class="row p-2">
                    <?php foreach ($data as $product) : ?>
                        <div class="col-md-3">
                            <div class="wsk-cp-product">
                                <div class="wsk-cp-img">
                                    <img src="../uploads/categories/<?php echo $product["image"]; ?>" alt="categories" class="img-responsive" />
                                </div>
                                <div class="wsk-cp-text">
                                    <div class="category">
                                        <span><?php echo $product["cat_name"]; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    <?php else : echo "no category";
    endif; ?>

    <?php require_once("../inc/header.php"); ?>