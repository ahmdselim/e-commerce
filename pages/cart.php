<?php
require_once("../inc/header.php");

if (!isset($_COOKIE["login"])) {
    header("location:./login.php");
}

if ($usersData[0]["status"] === "1") :

    $email = $_SESSION["u_email"];

    $select_carts = "SELECT * FROM `cart` WHERE user_email='$email'";
    $q_cart = mysqli_query($con, $select_carts);


    $select_items = "SELECT * FROM `items`";
    $q_item = mysqli_query($con, $select_items);


    while ($result = mysqli_fetch_assoc($q_cart)) {
        $dataCart[] = $result;
    }

    while ($result = mysqli_fetch_assoc($q_item)) {
        $items_data[] = $result;
    }

    $allPrice = [];
    $all_cart_id = [];


    if (isset($_SESSION["success"])) { ?>
        <div class="alert alert-primary" role="alert">
        <?php echo $_SESSION["success"];
        unset($_SESSION["success"]);
    }


        ?>
        </div>
        <div class="shell">
            <div class="container">
                <div class="row p-5">

                    <?php if (!empty($dataCart)) :  foreach ($dataCart as $product) : ?>

                            <?php foreach ($items_data as $itemProduct) : ?>
                                <?php if ($itemProduct["id"] === $product["product_id"]) : ?>

                                    <?php
                                    global $allPrice, $all_cart_id;
                                    $allPrice[] = $itemProduct["price"] * $product["quantity"];
                                    $all_cart_id[] =  $product["id"] ?>

                                    <div class="col-md-3">
                                        <div class="wsk-cp-product">
                                            <div class="wsk-cp-img">
                                                <img src="../uploads/products/<?php echo $itemProduct["image"]; ?>" alt="Product" class="img-responsive" />
                                            </div>
                                            <div class="wsk-cp-text">
                                                <div class="category">
                                                    <span><?php echo $itemProduct["category"]; ?></span>
                                                </div>
                                                <div class="title-product">
                                                    <h3><?php echo $itemProduct["name"]; ?></h3>
                                                </div>
                                                <div class="description-prod">
                                                    <p>quantity : <?php echo $product["quantity"]; ?></p>
                                                </div>
                                                <div class="description-prod">
                                                    <p>product price : <?php echo $itemProduct["price"]; ?></p>
                                                </div>
                                                <div class="description-prod">
                                                    <p><?php echo $itemProduct["description"]; ?></p>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="wcf-left"> <span class="price">order price : <?php echo $itemProduct["price"] * $product["quantity"]; ?> EGP</span></div>
                                                    <div class="wcf-right"><a href="#" class="buy-btn"><i class="zmdi zmdi-shopping-basket"></i></a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    <?php
                                endif;
                            endforeach;
                        endforeach;
                    else : echo "cart is empty";
                        die();
                    endif;
                    ?>
                    <h2>Account : <?php
                                    echo  array_sum($allPrice);
                                    ?> </h2>
                    <form action="../handler/checkout.php" method="POST">
                        <input type="hidden" name="allPrice" value="<?php echo array_sum($allPrice); ?>" />
                        <input type="hidden" name="all_cart_id" value="<?php echo implode(",", $all_cart_id); ?>" />
                        <button type="submit" class="btn btn-primary">Check Out</button>
                    </form>

                </div>
            </div>
        </div>
    <?php
else : header("location:./shop.php");
endif;

require_once("../inc/header.php"); ?>