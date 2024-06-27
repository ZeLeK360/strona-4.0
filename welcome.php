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
    <title>Witamy</title>
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
            <h1>Witamy, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p>To jest strona powitalna.</p>
            <button onclick="window.location.href='edit_profile.html'" class="form__button">Edytuj profil</button>
            <button onclick="window.location.href='logout.php'" class="form__button">Wyloguj się</button>
        </div>
    </div>
</body>
</html>
