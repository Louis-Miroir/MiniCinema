<?php
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['email']) && isset($data['password'])) {
        // Normalement ici tu mets la requête SQL pour ajouter l'utilisateur
        echo json_encode(["message" => "Utilisateur inscrit avec succès."]);
    } else {
        echo json_encode(["error" => "Paramètres manquants."]);
    }
} else {
    echo json_encode(["error" => "Méthode non autorisée."]);
}
?>
