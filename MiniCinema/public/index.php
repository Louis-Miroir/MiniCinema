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

// Gestion de la recherche
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($search !== '') {
    $stmt = $pdo->prepare("
        SELECT * FROM movies 
        WHERE title LIKE ? OR director LIKE ? 
        ORDER BY id DESC
    ");
    $stmt->execute(["%$search%", "%$search%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM movies ORDER BY id DESC LIMIT 8");
}
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
<h1><a href="index.php" class="site-title">🎬 Bienvenue sur MovieStore</a></h1>
<nav>
    <div class="dropdown">
        <p>🎞️ Catégories</p>
        <div class="dropdown-content">
            <a href="categorie_action.php">Action</a>
            <a href="categorie_drame.php">Drame</a>
        </div>
    </div>
    <a href="mon_panier.php">🛒 Mon Panier</a>
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
    <form method="GET" action="index.php" class="search-form">
        <input type="text" name="search" placeholder="Rechercher un film ou un réalisateur..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">🔍</button>
    </form>

    <section class="presentation">
        <h2><?= $search ? "Résultats pour « $search »" : "Découvrez les derniers films ajoutés" ?></h2>

        <div class="movie-list">
            <?php if (empty($movies)): ?>
                <p>Aucun résultat trouvé.</p>
            <?php else: ?>
                <?php foreach ($movies as $movie): ?>
                    <div class="movie-card">
                        <img src="../images/<?= htmlspecialchars($movie['image']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
                        <h3><?= htmlspecialchars($movie['title']) ?></h3>
                        <p>🎬 Réalisé par : <?= htmlspecialchars($movie['director']) ?></p>
                        <p><?= number_format($movie['price'], 2) ?> €</p>
                        <a href="movie.php?id=<?= $movie['id'] ?>">Détails</a>
                        <form action="add_to_cart.php" method="post">
                            <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
                            <button type="submit">Ajouter au panier</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</main>

</body>
</html>
