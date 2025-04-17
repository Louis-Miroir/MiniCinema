<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$api_url = "http://localhost/MiniCinema/api/getCart.php?user_id=" . $user_id;

$response = file_get_contents($api_url);
$data = json_decode($response, true);
$cart = isset($data['cart']) ? $data['cart'] : [];
$total = isset($data['total']) ? $data['total'] : 0;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Mon Panier</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Mon Panier</h2>

<?php if (empty($cart)) : ?>
    <p>Votre panier est vide.</p>
<?php else : ?>
    <table border="1" style="margin: auto;">
        <tr>
            <th>Film</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Action</th>
        </tr>
        <?php foreach ($cart as $item) : ?>
        <tr>
            <td><?= htmlspecialchars($item['title']) ?></td>
            <td><?= $item['quantity'] ?></td>
            <td><?= number_format($item['price'], 2) ?> €</td>
            <td>
                <form method="POST" action="../api/removeFromCart.php">
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                    <input type="hidden" name="movie_id" value="<?= $item['movie_id'] ?>">
                    <button type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Total : <?= number_format($total, 2) ?> €</h3>

    <form method="POST" action="../api/clearCart.php">
        <input type="hidden" name="user_id" value="<?= $user_id ?>">
        <button type="submit">Vider le panier</button>
    </form>
<?php endif; ?>

<br><a href="index.php">← Retour à l'accueil</a>
</body>
</html>
