<?php
// Wyświetlanie błędów PHP (w celach debugowania)
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobierz dane z formularza
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Sprawdź, czy użytkownik już istnieje
    $sql = "SELECT id FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "Użytkownik o podanej nazwie już istnieje.";
    } elseif ($result) {
        // Hashuj hasło
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Wstaw użytkownika do bazy danych
        $sql = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "Rejestracja zakończona sukcesem.";
            header("Location: login.html");
        } else {
            echo "Błąd: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Błąd zapytania: " . $conn->error;
    }

    $conn->close();
}
?>
