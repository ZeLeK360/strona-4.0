<?php
session_start();
include 'db_connect.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog produktów</title>
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
            <h1>Katalog produktów</h1>
            <div class="product-grid">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='product'>";
                        echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
                        echo "<h2>" . $row['name'] . "</h2>";
                        echo "<p>" . $row['price'] . " PLN</p>";
                        echo "<button onclick=\"addToCart(" . $row['id'] . ")\">Dodaj do koszyka</button>";
                        echo "</div>";
                    }
                } else {
                    echo "Brak produktów w katalogu.";
                }
                ?>
            </div>
        </div>
    </div>
    <script>
        function addToCart(productId) {
            window.location.href = 'add_to_cart.php?id=' + productId;
        }
    </script>
</body>
</html>
