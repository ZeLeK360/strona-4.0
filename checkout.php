<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();

if (!empty($cart)) {
    $ids = implode(',', $cart);
    $sql = "SELECT * FROM products WHERE id IN ($ids)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Zapisz zamówienie do bazy danych
    $username = $_SESSION['username'];
    $total = 0;
    foreach ($products as $product) {
        $total += $product['price'];
    }
    $sql = "INSERT INTO orders (username, total) VALUES ('$username', '$total')";
    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id;
        foreach ($products as $product) {
            $product_id = $product['id'];
            $price = $product['price'];
            $sql = "INSERT INTO order_items (order_id, product_id, price) VALUES ('$order_id', '$product_id', '$price')";
            $conn->query($sql);
        }
        // Wyslij potwierdzenie email
        $to = $_SESSION['user_email'];  // Assuming user's email is stored in session
        $subject = "Potwierdzenie zamówienia nr $order_id";
        $message = "Dziękujemy za złożenie zamówienia. Łączna kwota: $total PLN.";
        $headers = "From: sklep@twojadomena.pl";
        mail($to, $subject, $message, $headers);
    }

    // Wyczyść koszyk
    unset($_SESSION['cart']);
    header("Location: order_success.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizacja zamówienia</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="index.html">Strona główna</a></li>
            <li><a href="catalog.php">Katalog</a></li>
            <li><a href="cart.php">Koszyk</a></li>
            <li><a href="logout.php">Wyloguj się</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="container">
            <h1>Realizacja zamówienia</h1>
            <form action="checkout.php" method="post" class="form">
                <h2>Podsumowanie zamówienia</h2>
                <?php
                if (!empty($products)) {
                    $total = 0;
                    foreach ($products as $product) {
                        echo "<div class='cart-item'>";
                        echo "<img src='" . $product['image'] . "' alt='" . $product['name'] . "' class='cart-item-image'>";
                        echo "<h2>" . $product['name'] . "</h2>";
                        echo "<p class='price'>" . $product['price'] . " PLN</p>";
                        echo "</div>";
                        $total += $product['price'];
                    }
                    echo "<h2>Łączna kwota: " . $total . " PLN</h2>";
                    echo "<button type='submit' class='form__button'>Potwierdź zamówienie</button>";
                } else {
                    echo "<p>Twój koszyk jest pusty.</p>";
                }
                ?>
            </form>
        </div>
    </div>
</body>
</html>
