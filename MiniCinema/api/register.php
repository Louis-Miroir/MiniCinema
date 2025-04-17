<?php
require_once '../config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);

        // Redirection vers login après inscription
        header('Location: ../public/login.php?success=1');
        exit;
    } else {
        // Redirection si des champs sont manquants
        header('Location: ../register.php?error=missing_fields');
        exit;
    }
} else {
    // Redirection si mauvaise méthode
    header('Location: ../register.php?error=invalid_method');
    exit;
}
