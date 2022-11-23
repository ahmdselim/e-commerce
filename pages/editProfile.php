<?php
require_once("../inc/header.php");
if (!isset($_COOKIE["login"])) {
    header("location:./login.php");
}

if ($usersData[0]["status"] === "1") :

    if (isset($_SESSION["u_email"])) {
        $email = $_SESSION["u_email"];
    }

    $selectItems = "SELECT * FROM `users` WHERE email='$email'";
    $q_items = mysqli_query($con, $selectItems);

    while ($result = mysqli_fetch_assoc($q_items)) {
        $data[] = $result;
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

                <?php if (isset($_SESSION["success"])) : ?>
                    <div class="alert alert-primary" role="alert">
                        <?php
                        echo $_SESSION["success"];
                        unset($_SESSION["success"]) ?>
                    <?php endif; ?>
                    </div>
                    <?php foreach ($data as $user) : ?>
                        <form method="POST" action="../handler/updateUser.php">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $user["name"]; ?>" aria-describedby="emailHelp">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    <?php endforeach; ?>
            </div>
        </div>
    </div>

<?php

else : header("location:./shop.php");
endif;

require_once("../inc/footer.php"); ?>