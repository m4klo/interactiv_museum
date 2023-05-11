<?php
require_once 'connect.php';

// Pobierz przekazane dane z żądania POST
$title = mysqli_real_escape_string($conn, $_POST['title']);
$author = mysqli_real_escape_string($conn, $_POST['author']);
$id = mysqli_real_escape_string($conn, $_POST['id']);

// Wykonaj logikę aktualizacji danych w bazie danych
// ...

// Przykładowy kod aktualizacji w bazie danych
// Tutaj musisz dostosować go do swojej implementacji
$query = "UPDATE painting SET title = '$title' WHERE id = '$id'";
// Wykonaj zapytanie do bazy danych
// ...

// Zwróć odpowiedź w formacie JSON
$result = mysqli_query($conn, $query);
if ($result) {
    // Zapytanie wykonane poprawnie
    $response = array('status' => 'success');
    echo json_encode($response);
} else {
    // Błąd podczas wykonywania zapytania
    $response = array('status' => 'error', 'message' => mysqli_error($conn));
    echo json_encode($response);
}

?>