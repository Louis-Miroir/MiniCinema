<?php
session_start();
// Connexion à la base de données
$host = 'localhost';
$db = 'minicinema';
$user = 'root';
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupération des films les plus récents
$stmt = $pdo->query("SELECT * FROM movies ORDER BY id DESC LIMIT 6");
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - MovieStore</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php if (isset($_GET['logout'])): ?>
    <p style="color: green;">👋 Vous êtes bien déconnecté !</p>
<?php endif; ?>

<header>
    <h1>🎬 Bienvenue sur MovieStore</h1>
    <nav>
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="register.php">Créer un compte</a> |
            <a href="login.php">Connexion</a>
        <?php else: ?>
            <a href="profile.php">
            Bonjour<?= !empty($_SESSION['username']) ? ', ' . htmlspecialchars($_SESSION['username']) : '' ?> !
            </a>
            <a href="logout.php">Déconnexion</a>
        <?php endif; ?>
    </nav>
</header>

<main>
    <section class="presentation">
        <h2>Découvrez les derniers films ajoutés</h2>
        <div class="movie-list">
            <?php foreach ($movies as $movie): ?>
                <div class="movie-card">
                    <img src="../images/<?= htmlspecialchars($movie['image']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
                    <h3><?= htmlspecialchars($movie['title']) ?></h3>
                    <p><?= number_format($movie['price'], 2) ?> €</p>
                    <a href="movie.php?id=<?= $movie['id'] ?>">Détails</a>
                    <form action="add_to_cart.php" method="post">
                        <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
                        <button type="submit">Ajouter au panier</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
</body>
</html>
