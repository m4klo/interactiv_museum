<?php
session_start();
// Połączenie z bazą danych
require_once 'connect.php';

// Pobranie danych z formularza
$username = $_POST['username'];
$password = $_POST['password'];
$isAdmin = filter_var($_POST['isAdmin'], FILTER_VALIDATE_BOOLEAN);


if ($isAdmin === true) {
    $sql = "SELECT * FROM administrator WHERE login='$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        // Sprawdzenie, czy hasło jest poprawne
        if (password_verify($password, $user['password'])) {
            // Hasło jest poprawne - zaloguj użytkownika
            $_SESSION['location_id'] = 'administrator';
            $response = array('status' => 'success_admin', 'redirect' => 'collection_administrator.php');
        } else {
            // Hasło jest niepoprawne
            $response = array('status' => 'error');
        }
    } else {
        // Użytkownik o podanej nazwie nie został znaleziony
        $response = array('status' => 'error');
    }  
}
else {
    // Znalezienie użytkownika o podanej nazwie
    $sql = "SELECT * FROM curator WHERE login='$username' AND status='verified'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Sprawdzenie, czy hasło jest poprawne
        if (password_verify($password, $user['password'])) {
            // Hasło jest poprawne - zaloguj użytkownika
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['login'];
            $_SESSION['location_id'] = $user['id_location'];
            $response = array('status' => 'success', 'redirect' => 'collection_curator.php');
        } else {
            // Hasło jest niepoprawne
            $response = array('status' => 'error');
        }
    } else {
        // Użytkownik o podanej nazwie nie został znaleziony
        $response = array('status' => 'error');
    }  
}

// Zwróć odpowiedź jako JSON
header('Content-Type: application/json');
echo json_encode($response);
exit;

?>
