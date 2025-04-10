<?php
try {
    $dsn = "mysql:host=localhost;dbname=powderpoints;charset=utf8";
    $pdo = new PDO($dsn, 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Fehler beim Verbindungsaufbau zur Datenbank: " . $e->getMessage());
}
?>
