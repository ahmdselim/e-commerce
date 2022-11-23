<?php
require_once("../inc/header.php");

if (!isset($_COOKIE["login"])) {
    header("location:./login.php");
}

$selectItems = "SELECT * FROM `items`";
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
                                    <a href="./product.php?id=<?php echo $product["id"]; ?>">
                                        <img src="../uploads/products/<?php echo $product["image"]; ?>" alt="Product" class="img-responsive" /></a>
                                </div>
                                <div class="wsk-cp-text">
                                    <div class="category">
                                        <a href="./product.php?id=<?php echo $product["id"]; ?>"> <span><?php echo $product["name"]; ?></span></a>
                                    </div>
                                    <div class="title-product">
                                        <h3>My face not my heart</h3>
                                    </div>
                                    <div class="description-prod">
                                        <p><?php echo $product["description"]; ?></p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="wcf-left"><span class="price"><?php echo $product["price"]; ?> EGP</span></div>
                                        <div class="wcf-right"><a href="#" class="buy-btn"><i class="zmdi zmdi-shopping-basket"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>

    <?php else : echo "no products";
    endif; ?>
    <?php require_once("../inc/header.php"); ?>