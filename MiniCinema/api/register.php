<?php
require_once '../config/db.php';
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['email']) && isset($data['password'])) {
        $email = $data['email'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->execute([$email, $password]);

        echo json_encode(["message" => "Utilisateur enregistré avec succèssssss."]);
    } else {
        echo json_encode(["error" => "Paramètres manquants."]);
    }
} else {
    echo json_encode(["error" => "Méthode non autorisée."]);
}
?>
