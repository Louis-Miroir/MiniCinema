<?php

$host = '127.0.0.1';
$dbname = 'MiniCinema';
$username = 'root';
$password = ''; // pas de mot de passe par défaut sur WAMP
$port = 3306;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>