<?php
require_once("../inc/header.php");
if (!isset($_COOKIE["login"])) {
    header("location:./login.php");
}
?>

<br><br>
<div class="container">
    <div class="row p-5">
        <div class="col-8 mx-auto">
            <?php
            if (isset($_SESSION["errors"])) {
                foreach ($_SESSION["errors"] as $user) {
                    echo  <<<TYPE
                     <div class="alert alert-primary" role="alert"> $user</div>
                     TYPE;
                }
                unset($_SESSION["errors"]);
            }
            ?>

            <?php
            if (isset($_SESSION["success"])) { ?>
                <div class="alert alert-primary" role="alert">
                <?php echo $_SESSION["success"];
                unset($_SESSION["success"]);
            } ?>
                </div>

                <form method="POST" action="../handler/addCategory.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name of Category</label>
                        <input type="text" class="form-control" name="name" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">image of Category</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
        </div>
    </div>
</div>

<?php require_once("../inc/footer.php"); ?>