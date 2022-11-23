<?php
require_once("../inc/header.php");

if (!isset($_COOKIE["login"])) {
    header("location:./login.php");
}

$selectItems = "SELECT * FROM `items`";
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
                            <th scope="col">description</th>
                            <th scope="col">price</th>
                            <th scope="col">user_email</th>
                            <th scope="col">category</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $product) : ?>
                            <tr>
                                <th scope="row"><?php echo $product["id"]; ?></th>
                                <td><?php echo $product["name"]; ?></td>
                                <td><img src="../uploads/products/<?php echo $product["image"]; ?>" style="width: 50px; height: 50px;object-fit:cover;border:1px solid #CCC;border-radius:25px;padding:3px; vertical-align:bottom" /></td>
                                <td><?php echo $product["description"]; ?></td>
                                <td><?php echo $product["price"]; ?> EGP</td>
                                <td><?php echo $product["user_email"]; ?></td>
                                <td><?php echo $product["category"]; ?></td>

                                <td>
                                    <a href="./editProduct.php?id=<?php echo $product['id'] ?>">
                                        <button type="button" class="btn btn-primary">Edit</button>
                                    </a>
                                    <a href="../handler/deleteProduct.php?id=<?php echo $product["id"]; ?>">
                                        <button type="button" class="btn btn-danger">Delete</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach;
                        ?>


                    </tbody>
                </table>
            <?php else : echo "no products";
            endif; ?>
        </div>
    </div>

    <?php require_once("../inc/header.php"); ?>