<?php
// Set database credentials
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'painting_catalog';

// Set DSN
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

// Create a PDO instance
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Check connection
if ($pdo) {
    echo "Connected successfully to the database.";
} else {
    die("Connection failed.");
}
?>