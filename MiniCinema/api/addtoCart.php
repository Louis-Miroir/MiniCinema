<?php
require_once '../config/db.php';
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_id']) && isset($_POST['movie_id'])) {
        $user_id = $_POST['user_id'];
        $movie_id = $_POST['movie_id'];

        // Vérifie si le film est déjà dans le panier
        $check = $pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND movie_id = ?");
        $check->execute([$user_id, $movie_id]);
        $existing = $check->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            // Si déjà dans le panier, incrémente la quantité
            $stmt = $pdo->prepare("UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND movie_id = ?");
            $stmt->execute([$user_id, $movie_id]);
        } else {
            // Sinon ajoute l'élément
            $stmt = $pdo->prepare("INSERT INTO cart (user_id, movie_id, quantity) VALUES (?, ?, 1)");
            $stmt->execute([$user_id, $movie_id]);
        }

        echo json_encode(["message" => "Film ajouté au panier."]);
    } else {
        echo json_encode(["error" => "Paramètres manquants."]);
    }
} else {
    echo json_encode(["error" => "Méthode non autorisée."]);
}
?>
<?php
