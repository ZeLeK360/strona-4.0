<?php
session_start();
include 'db_connect.php';

// Function to get product details
function getProductDetails($productId, $conn) {
    $sql = "SELECT * FROM products WHERE id = $productId";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koszyk</title>
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
            <h1>Twój Koszyk</h1>
            <?php if (count($cartItems) > 0): ?>
                <div class="cart-grid">
                    <?php
                    foreach ($cartItems as $itemId) {
                        $product = getProductDetails($itemId, $conn);
                        echo "<div class='cart-item'>";
                        echo "<img src='" . $product['image'] . "' alt='" . $product['name'] . "'>";
                        echo "<h2>" . $product['name'] . "</h2>";
                        echo "<p>" . $product['price'] . " PLN</p>";
                        echo "<button onclick=\"removeFromCart(" . $product['id'] . ")\">Usuń z koszyka</button>";
                        echo "</div>";
                    }
                    ?>
                </div>
            <?php else: ?>
                <p>Twój koszyk jest pusty.</p>
            <?php endif; ?>
        </div>
    </div>
    <script>
        function removeFromCart(productId) {
            window.location.href = 'remove_from_cart.php?id=' + productId;
        }
    </script>
</body>
</html>
