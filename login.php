<?php
// Połączenie z bazą danych
require_once 'connect_pdo.php';

// Pobranie danych z formularza
$username = $_POST['username'];
$password = $_POST['password'];

// Znalezienie użytkownika o podanej nazwie
$sql = "SELECT * FROM curator WHERE login=:username";
$stmt = $pdo->prepare($sql);
$stmt->execute([':username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

echo 'Password: ' . $password . '<br>';
echo 'Hashed password from database: ' . $user['password'] . '<br>';

var_dump($password);
var_dump($user['password']);


if ($user) {
    // Sprawdzenie, czy hasło jest poprawne
    if (password_verify($password, $user['password'])) {
      // Hasło jest poprawne - zaloguj użytkownika
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['login'];
      $_SESSION['location_id'] = $user['id_location'];
      header('Location: generate_gallery.php');
      error_log('Niepoprawne hasło dla użytkownika ' . $username);
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
