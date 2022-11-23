<?php
require_once("../inc/header.php");

if (!isset($_COOKIE["login"])) {
    header("location:./login.php");
}



if (isset($_SESSION["success"])) { ?>
    <div class="alert alert-primary" role="alert">
    <?php echo $_SESSION["success"];
    unset($_SESSION["success"]);
}

$selectItems = "SELECT * FROM `categories`";
$q_items = mysqli_query($con, $selectItems);

while ($result = mysqli_fetch_assoc($q_items)) {
    $dataCat[] = $result;
}
    ?>
    </div>



    <div class="shell">
        <div class="container">
            <br />
            <form action="../handler/search.php" method="GET">
                <div class="row p-5">
                    <div class="col-md-4">
                        <input type="text" placeholder="search by name" name="search" style="width: 100%;" />
                    </div>
                    <div class="col-md-4">
                        <input type="number" placeholder="search by price" name="price" style="width: 100%;" />
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" aria-label="Default select example" name="category" style="width: 100%;">
                            <option selected>search by category</option>
                            <?php foreach ($dataCat as $cat) : ?>
                                <option value="<?php echo $cat["cat_name"]; ?>"><?php echo $cat["cat_name"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-12" style="margin-top:20px">
                        <button class=" btn btn-primary" style="width: 100%;">Search</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <?php if (isset($_SESSION["search"])) :
                ?>
                    <?php foreach ($_SESSION["search"] as $search) : ?>


                        <div class="col-md-3">
                            <div class="wsk-cp-product">
                                <div class="wsk-cp-img">
                                    <a href="./product.php?id=<?php echo $search["id"]; ?>">
                                        <img src="../uploads/products/<?php echo $search["image"]; ?>" alt="Product" class="img-responsive" />
                                    </a>
                                </div>
                                <div class="wsk-cp-text">
                                    <div class="category">
                                        <span><?php echo $search["category"]; ?></span>
                                    </div>
                                    <div class="title-product">
                                        <a href="./product.php?id=<?php echo $search["id"]; ?>">
                                            <h3><?php echo $search["name"]; ?></h3>
                                        </a>
                                    </div>
                                    <div class="description-prod">
                                        <p><?php echo $search["description"]; ?></p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="wcf-left"><span class="price"><?php echo $search["price"]; ?> EGP </span></div>
                                        <div class="wcf-right"><a href="#" class="buy-btn"><i class="zmdi zmdi-shopping-basket"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif;
                unset($_SESSION["search"]); ?>
            </div>
        </div>

        <?php require_once("../inc/header.php"); ?>