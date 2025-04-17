<?php
require_once '../config/db.php';
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_id']) && isset($_POST['movie_id'])) {
        $user_id = $_POST['user_id'];
        $movie_id = $_POST['movie_id'];

        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ? AND movie_id = ?");
        $stmt->execute([$user_id, $movie_id]);

        echo json_encode(["message" => "Film supprimé du panier."]);
    } else {
        echo json_encode(["error" => "Paramètres manquants."]);
    }
} else {
    echo json_encode(["error" => "Méthode non autorisée."]);
}
?>
<?php
