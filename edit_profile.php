<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $new_username = $_POST['username'];
    $new_password = $_POST['password'];

    $update_sql = "UPDATE users SET username='$new_username'";

    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $update_sql .= ", password='$hashed_password'";
    }

    $update_sql .= " WHERE username='$username'";

    if ($conn->query($update_sql) === TRUE) {
        $_SESSION['username'] = $new_username;
        echo "Dane zostały zaktualizowane.";
    } else {
        echo "Błąd: " . $conn->error;
    }

    $conn->close();
}
?>
