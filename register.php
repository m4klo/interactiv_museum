<?php
// Połączenie z bazą danych
require_once 'connect_pdo.php';

// Jeśli przesłano formularz z danymi rejestracyjnymi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobranie danych z formularza
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $location = $_POST['location'];

    // Wprowadzenie danych do bazy danych
    try {
        $sql = "INSERT INTO curator (name, surname, login, password, email, id_location, status) VALUES (:name, :surname, :login, :password, :email, :id_location, :status)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':surname' => $surname,
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

