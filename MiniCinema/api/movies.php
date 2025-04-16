<?php
require_once '../config/db.php';
header("Content-Type: application/json");

try {
    if (isset($_GET['category'])) {
        // Si catégorie précisée en paramètre GET
        $category = $_GET['category'];
        $stmt = $pdo->prepare("SELECT * FROM movies WHERE category = ?");
        $stmt->execute([$category]);
    } else {
        // Sinon, récupère tous les films
        $stmt = $pdo->query("SELECT * FROM movies");
    }

    $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($movies);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
<?php
