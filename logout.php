<?php
session_start();

// Usunięcie danych sesji użytkownika
session_unset();
session_destroy();

// Przekierowanie na stronę collection_user.php
header('Location: collection_user.php');
exit;
?>
