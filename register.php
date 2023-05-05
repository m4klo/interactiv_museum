<?php
// Połączenie z bazą danych
require_once 'connect.php';

// Jeśli przesłano formularz z danymi rejestracyjnymi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobranie danych z formularza
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $location = $_POST['location'];

    // Wprowadzenie danych do bazy danych
    $sql = "INSERT INTO curator (id, login, password, email, id_location, status) VALUES (NULL, :login, :password, :email, :id_location, :status)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':login' => $username,
        ':password' => $password,
        ':email' => $email,
        ':status' => 'niezatwierdzony',
        ':id_location' => $location
    ]);
    var_dump($stmt->errorInfo());
       
}
