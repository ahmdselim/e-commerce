<?php

if (!isset($_COOKIE["login"])) {
    header("location:./login.php");
}

if (!isset($_GET["id"])) {
    header("location:./shop.php");
}

require_once("../inc/header.php");
$id = $_GET["id"];
$select_single_items = "SELECT * FROM `items` WHERE id='$id'";
$q_single_items = mysqli_query($con, $select_single_items);

while ($result = mysqli_fetch_assoc($q_single_items)) {
    $data[] = $result;
}

if (isset($_SESSION["errors"])) {
    foreach ($_SESSION["errors"] as $user) {
        echo  <<<TYPE
                     <div class="alert alert-primary" role="alert"> $user</div>
                     TYPE;
    }
    unset($_SESSION["errors"]);
} else if (isset($_SESSION["success"])) { ?>
    <div class="alert alert-primary" role="alert">
        <?php echo $_SESSION["success"];
        unset($_SESSION["success"]); ?>
    </div>


<?php  } ?> <?php foreach ($data as $product) : ?> <div class="wrapper">
        <div class="product-img">
            <img src="../uploads/products/<?php echo $product["image"]; ?>" height="420" width="327">
        </div>
        <div class="product-info p-5">
            <form method="POST" action="../handler/addToCart.php">
                <div class="product-text">
                    <h1><?php echo $product["name"]; ?></h1>
                    <span><?php echo $product["category"]; ?></span>
                    <p><?php echo $product["description"]; ?> </p>
                    <input type="number" name="quantity" value="1" />
                    <input type="hidden" name="id" value="<?php echo $product["id"]; ?>" />
                </div>
                <div class="product-price-btn">
                    <p><span><?php echo $product["price"]; ?> </span>EGP</p><br /><br /><br />
                </div>
            </form>
        </div>
    </div>

<?php endforeach; ?>

<?php require_once("../inc/footer.php"); ?>