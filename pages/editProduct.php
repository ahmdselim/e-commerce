<?php
require_once("../inc/header.php");

if (!isset($_COOKIE["login"])) {
    header("location:./login.php");
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $selectItems = "SELECT * FROM `items` WHERE id='$id'";
    $q_items = mysqli_query($con, $selectItems);

    while ($result = mysqli_fetch_assoc($q_items)) {
        $data[] = $result;
    }

    $selectItems = "SELECT * FROM `categories`";
    $q_items = mysqli_query($con, $selectItems);
    while ($result = mysqli_fetch_assoc($q_items)) {
        $dataCat[] = $result;
    }


    if (isset($data)) {

        if (isset($_SESSION["errors"])) {
            foreach ($_SESSION["errors"] as $user) {
                echo  <<<TYPE
                     <div class="alert alert-primary" role="alert"> $user</div>
                     TYPE;
            }
            unset($_SESSION["errors"]);
        }

        if (isset($_SESSION["success"])) { ?>
            <div class="alert alert-primary" role="alert">
            <?php echo $_SESSION["success"];
            unset($_SESSION["success"]);
        }



            ?>
            </div>
            </div>

            <br />
            <br />
            <div class="container p-3">
                <div class="row">
                    <?php foreach ($data as $cat) : ?>
                        <form method="POST" action="../handler/updateProduct.php" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name of product</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $cat["name"]; ?>" aria-describedby="emailHelp">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Description of product</label>
                                <input type="text" class="form-control" name="desc" value="<?php echo $cat["description"]; ?>" aria-describedby="emailHelp">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Price of product</label>
                                <input type="number" class="form-control" name="price" value="<?php echo $cat["price"]; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Image of product</label>
                                <input type="file" class="form-control" name="image">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Category of product</label>
                                <select class="form-select" aria-label="Default select example" name="category">
                                    <option value="<?php echo $cat["category"]; ?>"><?php echo $cat["category"]; ?></option>
                                    <option value="">---------</option>
                                    <?php foreach ($dataCat as $dataCat_s) : ?>
                                        <option value="<?php echo $dataCat_s["cat_name"]; ?>"><?php echo $dataCat_s["cat_name"]; ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <input type="hidden" class="form-control" name="id" value="<?php echo $cat["id"]; ?>">
                            <button type="submit" class="btn btn-primary">update</button>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>


    <?php } else {
        echo <<<TYPE
    <div id="notfound"><div class="notfound"><div class="notfound-404"><h1>404</h1></div><h2>Oops! Nothing was found</h2><p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a href="../pages/signupPage.php">Return to homepage</a></p></div></div>
    TYPE;
    }
} else {
    echo <<<TYPE
    <div id="notfound"><div class="notfound"><div class="notfound-404"><h1>404</h1></div><h2>Oops! Nothing was found</h2><p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a href="../pages/signupPage.php">Return to homepage</a></p></div></div>
    TYPE;
} ?>

    <?php require_once("../inc/header.php"); ?>