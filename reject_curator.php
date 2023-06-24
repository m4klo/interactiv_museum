<?php
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sprawdź, czy przesłano poprawny identyfikator kuratora
    if (isset($_POST['curatorId'])) {
        $curatorId = $_POST['curatorId'];

        // Usuń kuratora z bazy danych
        $query = "DELETE FROM curator WHERE id = $curatorId";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo 'Kurator został odrzucony.';
        } else {
            echo 'Wystąpił błąd podczas odrzucania kuratora.';
        }
    } else {
        echo 'Nieprawidłowe żądanie.';
    }
} else {
    echo 'Nieprawidłowe żądanie.';
}
?>
