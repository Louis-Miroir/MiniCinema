<?php
require_once '../config/db.php';
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];

        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->execute([$user_id]);

        echo json_encode(["message" => "Panier vidé."]);
    } else {
        echo json_encode(["error" => "Paramètre user_id manquant."]);
    }
} else {
    echo json_encode(["error" => "Méthode non autorisée."]);
}
?>
<?php
