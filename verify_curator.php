<?php
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sprawdź, czy przesłano poprawny identyfikator kuratora
    if (isset($_POST['curatorId'])) {
        $curatorId = $_POST['curatorId'];

        // Zaktualizuj status kuratora na 'verified'
        $query = "UPDATE curator SET status = 'verified' WHERE id = $curatorId";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Zwrotka sukcesu
            echo 'Kurator został zaakceptowany.';
        } else {
            // Zwrotka błędu
            echo 'Wystąpił błąd podczas akceptowania kuratora.';
        }
    } else {
        // Zwrotka błędu - brak przesłanego identyfikatora kuratora
        echo 'Nieprawidłowe żądanie.';
    }
} else {
    // Zwrotka błędu - niepoprawna metoda żądania
    echo 'Nieprawidłowe żądanie.';
}
?>
