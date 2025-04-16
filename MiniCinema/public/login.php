<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" href="css/log.css">
</head>
<body>
    <h2>Connexion</h2>
    <?php if (isset($_GET['error'])): ?>
    <p style="color:red;">❌ Email ou mot de passe incorrect.</p>
<?php endif; ?>
    <form method="POST" action="../api/login.php">
        <input type="email" name="email" placeholder="Adresse email" required><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
