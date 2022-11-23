<?php
require_once("../inc/header.php");

if (!isset($_COOKIE["login"])) {
    header("location:./login.php");
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $selectItems = "SELECT * FROM `categories` WHERE id='$id'";
    $q_items = mysqli_query($con, $selectItems);

    while ($result = mysqli_fetch_assoc($q_items)) {
        $data[] = $result;
    }

    if (isset($data)) {

        if (isset($_SESSION["success"])) { ?>
            <div class="alert alert-primary" role="alert">
            <?php echo $_SESSION["success"];
            unset($_SESSION["success"]);
        }



            ?>
            </div>

            <br />
            <br />
            <div class="container p-3">
                <div class="row">
                    <?php foreach ($data as $cat) : ?>
                        <form method="POST" action="../handler/updateCategory.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name of Category</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $cat["cat_name"]; ?>" aria-describedby="emailHelp">
                            </div>
                            <input type="hidden" class="form-control" name="id" value="<?php echo $cat["id"]; ?>">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">image of Category</label>
                                <input type="file" class="form-control" name="image">
                            </div>
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