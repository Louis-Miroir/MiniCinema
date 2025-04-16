<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête pour retrouver l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Stocker les infos en session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];


        // Redirection vers la homepage
        header('Location: ../public/index.php');
        exit;
    } else {
        // Échec de connexion, redirection vers login avec message
        header('Location: ../login.php?error=1');
        exit;
    }
}
?>


