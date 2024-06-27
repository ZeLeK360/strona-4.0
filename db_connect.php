<?php
// Wyświetlanie błędów PHP (w celach debugowania)
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost"; // lub odpowiednia nazwa hosta
$username = "zelek360_zelek360";
$password = "qwerty321654987";
$dbname = "zelek360_mydatabase";

// Tworzenie połączenia
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzanie połączenia
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "Connected successfully"; // Wyłączamy ten komunikat
}
?>