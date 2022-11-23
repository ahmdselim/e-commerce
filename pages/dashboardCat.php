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
                            <th scope="col">image</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $product) : ?>
                            <tr>
                                <th scope="row"><?php echo $product["id"]; ?></th>
                                <td><?php echo $product["cat_name"]; ?></td>
                                <td><img src="../uploads/categories/<?php echo $product["image"]; ?>" style="width: 50px; height: 50px;object-fit:cover;border:1px solid #CCC;border-radius:25px;padding:3px; vertical-align:bottom" /></td>
                                <td>
                                    <a href="./editCategory.php?id=<?php echo $product["id"]; ?>">
                                        <button type="button" class="btn btn-primary">Edit</button>
                                    </a>
                                    <a href="../handler/deleteCategory.php?id=<?php echo $product["id"]; ?>">
                                        <button type="button" class="btn btn-danger">Delete</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach;
                        ?>


                    </tbody>
                </table>
            <?php else : echo "no category";
            endif; ?>
        </div>
    </div>

    <?php require_once("../inc/header.php"); ?>