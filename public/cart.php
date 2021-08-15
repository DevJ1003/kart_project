<?php require_once("../resources/config.php");


if (isset($_GET['add'])) {

    $_SESSION['product_1' . $_GET['add']] += 1;

    redirect("index.php");
}
