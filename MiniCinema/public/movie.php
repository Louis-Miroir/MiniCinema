<?php
$pdo = new PDO("mysql:host=localhost;dbname=minicinema;charset=utf8", 'root', '');

if (!isset($_GET['id'])) {
    die("Film non spécifié.");
}

$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
$stmt->execute([$id]);
$movie = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$movie) {
    die("Film introuvable.");
}
?>

    <!DOCTYPE html>
    <html>
    <head>
        <title><?= htmlspecialchars($movie['title']) ?></title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

    <h2><?= htmlspecialchars($movie['title']) ?></h2>
    <img src="../images/<?= htmlspecialchars($movie['image']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
    <p>Réalisateur : <?= htmlspecialchars($movie['director']) ?></p>
    <p>Catégorie : <?= htmlspecialchars($movie['category']) ?></p>
    <p>Description : <?= htmlspecialchars($movie['description']) ?></p>
    <p>Prix : <?= number_format($movie['price'], 2) ?> €</p>

    <form action="add_to_cart.php" method="post">
        <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
        <button type="submit">Ajouter au panier</button>
    </form>

    <a href="index.php">← Retour à l'accueil</a>
    </body>
    </html>
<?php
