<?php
// Połączenie z bazą danych
require_once 'connect_pdo.php';

// Jeśli przesłano formularz z danymi rejestracyjnymi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobranie danych z formularza
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $location = $_POST['location'];

    // Wprowadzenie danych do bazy danych
    try {
        $sql = "INSERT INTO curator (login, password, email, id_location, status) VALUES (:login, :password, :email, :id_location, :status)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':login' => $username,
            ':password' => $password,
            ':email' => $email,
            ':status' => 'niezatwierdzony',
            ':id_location' => $location
        ]);
    } catch (PDOException $e) {
        echo 'Wystąpił błąd: ' . $e->getMessage();
    }
}

