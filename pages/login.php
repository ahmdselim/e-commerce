<?php
require_once("../inc/header.php");
if (isset($_COOKIE["login"])) {
    header("location:./shop.php");
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

            <form method="POST" action="../handler/login.php">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php require_once("../inc/footer.php"); ?>