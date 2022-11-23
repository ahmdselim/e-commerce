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

if ($usersData[0]["status"] === "1") :

?>

    <br />
    <br />
    <div class="container">
        <div class="row p-5">
            <div class="col-8 mx-auto">


                <form method="POST" action="../handler/addProduct.php" enctype="multipart/form-data">
                    <?php
                    if (isset($_SESSION["error"])) {
                        foreach ($_SESSION["error"] as $user) {
                            echo  <<<TYPE
                     <div class="alert alert-primary" role="alert"> $user</div>
                     TYPE;
                        }
                        unset($_SESSION["error"]);
                    }
                    ?>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name of product</label>
                        <input type="text" class="form-control" name="name" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Description of product</label>
                        <input type="text" class="form-control" name="desc" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Price of product</label>
                        <input type="number" class="form-control" name="price">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Image of product</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Category of product</label>
                        <select class="form-select" aria-label="Default select example" name="category">
                            <?php foreach ($data as $dataCat) : ?>
                                <option value="">choose category </option>
                                <option value=" <?php echo $dataCat["cat_name"]; ?>"><?php echo $dataCat["cat_name"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">add product</button>

                </form>
            </div>
        </div>
    </div>


<?php
else : header("location:./shop.php");
endif;
require_once("../inc/footer.php");
?>