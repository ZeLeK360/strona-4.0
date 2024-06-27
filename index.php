<?php
// Wyświetlanie błędów PHP (w celach debugowania)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Połączenie z bazą danych
include 'db_connect.php';

// Zapytanie SQL do pobrania danych z tabeli
$sql = "SELECT id, username, password FROM users";
$result = $conn->query($sql);

if ($result === FALSE) {
    // Wyświetl błąd zapytania SQL
    die("Query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Username</th><th>Password</th></tr>";
    // Wyświetlanie danych w wierszach tabeli
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["username"]. "</td><td>" . $row["password"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close(); // Zamknięcie połączenia z bazą danych
?>
