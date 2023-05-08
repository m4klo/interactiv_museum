<?php
session_start();
// Połączenie z bazą danych
require_once 'connect.php';

// Pobranie danych z formularza
$username = $_POST['username'];
$password = $_POST['password'];

// Znalezienie użytkownika o podanej nazwie
$sql = "SELECT * FROM curator WHERE login='$username'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if ($user) {
    // Sprawdzenie, czy hasło jest poprawne
    if (password_verify($password, $user['password'])) {
        // Hasło jest poprawne - zaloguj użytkownika
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['login'];
        $_SESSION['location_id'] = $user['id_location'];
        echo 'success';
        exit;
    } else {
        // Hasło jest niepoprawne
        echo 'error';
    }
} else {
    // Użytkownik o podanej nazwie nie został znaleziony
    echo 'error';
}  
?>
