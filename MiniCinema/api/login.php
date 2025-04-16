<?php
require_once '../config/db.php';
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['email']) && isset($data['password'])) {
        $email = $data['email'];
        $password = $data['password'];

        // Récupération de l'utilisateur
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            echo json_encode(["message" => "Connexion réussie !", "user_id" => $user['id']]);
        } else {
            echo json_encode(["error" => "Identifiants incorrects."]);
        }
    } else {
        echo json_encode(["error" => "Paramètres manquants."]);
    }
} else {
    echo json_encode(["error" => "Méthode non autorisée."]);
}
?>
<?php
