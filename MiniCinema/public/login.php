<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" href="css/log.css">
</head>
<body>
<?php if (isset($_GET['success'])): ?>
    <div class="message" style="color: green;">Votre compte a été créé avec succès ! Vous pouvez vous connecter.</p>
<?php endif; ?>
<?php if (isset($_GET['error'])): ?>
    <div class="message" style="color:red;">❌ Email ou mot de passe incorrect.</p>
<?php endif; ?>
    <h2>Connexion</h2>
   
    <form method="POST" action="../api/login.php">
        <input type="email" name="email" placeholder="Adresse email" required><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
