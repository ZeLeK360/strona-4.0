<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$productId = $_GET['id'];

if (isset($_SESSION['cart'])) {
    $key = array_search($productId, $_SESSION['cart']);
    if ($key !== false) {
        unset($_SESSION['cart'][$key]);
    }
}

header("Location: cart.php");
exit();
?>
