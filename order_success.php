<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zamówienie zakończone</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="index.html">Strona główna</a></li>
            <li><a href="edit_profile.html">Edytuj profil</a></li>
            <li><a href="catalog.php">Katalog</a></li>
            <li><a href="cart.php">Koszyk</a></li>
            <li><a href="logout.php">Wyloguj się</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="container">
            <h1>Zamówienie zakończone sukcesem</h1>
            <p>Dziękujemy za złożenie zamówienia. Twoje zamówienie zostało przyjęte do realizacji.</p>
            <button onclick="window.location.href='catalog.php'" class="form__button">Powrót do katalogu</button>
        </div>
    </div>
</body>
</html>
