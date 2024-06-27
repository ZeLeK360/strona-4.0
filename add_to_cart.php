<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$productId = $_GET['id'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (!in_array($productId, $_SESSION['cart'])) {
    $_SESSION['cart'][] = $productId;
}

header("Location: cart.php");
exit();
?>
