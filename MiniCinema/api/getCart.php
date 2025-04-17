<?php
require_once '../config/db.php';
header("Content-Type: application/json");

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $stmt = $pdo->prepare("SELECT cart.*, movies.title, movies.price FROM cart JOIN movies ON cart.movie_id = movies.id WHERE cart.user_id = ?");
    $stmt->execute([$user_id]);

    $cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($cart);
} else {
    echo json_encode(["error" => "Paramètre user_id manquant."]);
}
echo json_encode([
    'cart' => $cart,
    'total' => $total
]);

?>
<?php
