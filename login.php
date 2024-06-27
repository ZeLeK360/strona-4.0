<?php
session_start();
include 'db_connect.php';

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['user_email'] = $row['email']; // Dodanie emaila do sesji
            header("Location: welcome.php");
            exit();
        } else {
            $error_message = "Błędne hasło.";
        }
    } else {
        $error_message = "Błędna nazwa użytkownika.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="index.html">Strona główna</a></li>
            <li><a href="catalog.php">Katalog</a></li>
            <li><a href="cart.php">Koszyk</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="container">
            <h2 class="catalog-title">Logowanie</h2>
            <?php
            if (!empty($error_message)) {
                echo "<p class='error'>$error_message</p>";
            }
            ?>
            <form action="login.php" method="post" class="form">
                <div class="form__input-container">
                    <input type="text" id="username" name="username" class="form__input" required placeholder=" " />
                    <label for="username" class="form__input-label">Nazwa użytkownika</label>
                </div>
                <div class="form__input-container">
                    <input type="password" id="password" name="password" class="form__input" required placeholder=" " />
                    <label for="password" class="form__input-label">Hasło</label>
                </div>
                <button type="submit" class="form__button">Zaloguj się</button>
            </form>
            <button onclick="window.location.href='register.html'" class="form__button">Nie masz konta? Zarejestruj się</button>
        </div>
    </div>
</body>
</html>
