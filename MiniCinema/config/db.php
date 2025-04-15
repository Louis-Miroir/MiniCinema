<?php

$host = 'biis7bmbazpfdykocedw-mysql.services.clever-cloud.com';
$dbname = 'biis7bmbazpfdykocedw';
$username = 'ufermxwrotlx55js5';
$password = 'FF36CsJCF9YboiPa6i6E';
$port = 3306;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>