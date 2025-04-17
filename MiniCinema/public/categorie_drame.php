<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=minicinema;charset=utf8', 'root', '');

// Récupérer les films de catégorie "Drame"
$stmt = $pdo->prepare("SELECT * FROM movies WHERE category = 'Drame' ORDER BY id DESC");
$stmt->execute();
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Films dramatiques</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1><a href="index.php" class="site-title">🎬 MovieStore</a></h1>
</header>

<main class="presentation">
    <h2>🎭 Films dramatiques</h2>
    <div class="movie-list">
        <?php foreach ($movies as $movie): ?>
            <div class="movie-card">
                <img src="../images/<?= htmlspecialchars($movie['image']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
                <h3><?= htmlspecialchars($movie['title']) ?></h3>
                <p>🎬 <?= htmlspecialchars($movie['director']) ?></p>
                <p><?= number_format($movie['price'], 2) ?> €</p>
                <a href="movie.php?id=<?= $movie['id'] ?>">Détails</a>
            </div>
        <?php endforeach; ?>
    </div>
</main>

</body>
</html>
