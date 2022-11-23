<?php
require_once("../inc/header.php");

if (!isset($_COOKIE["login"])) {
    header("location:./login.php");
}

$selectItems = "SELECT * FROM `users`";
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

    <br />
    <br />
    <div class="container ">
        <div class="row p-5">
            <?php if (isset($data)) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">email</th>
                            <th scope="col">password</th>
                            <th scope="col">status</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $product) : ?>
                            <tr>
                                <th scope="row"><?php echo $product["id"]; ?></th>
                                <td><?php echo $product["name"]; ?></td>
                                <td><?php echo $product["email"]; ?></td>
                                <td><?php echo $product["password"]; ?></td>
                                <td><?php echo $product["status"] === "0" ?  "client" : "employee ( admin )" ?></td>
                                <td>
                                    <a href="../handler/deleteUser.php?id=<?php echo $product["id"]; ?>">
                                        <button type="button" class="btn btn-danger">Delete</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach;
                        ?>


                    </tbody>
                </table>
            <?php else : echo "no users";
            endif; ?>
        </div>
    </div>

    <?php require_once("../inc/header.php"); ?>