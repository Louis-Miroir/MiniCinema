<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" href="css/log.css">
</head>
<body>
    <h2>Inscription</h2>
    <form method="POST" action="../api/register.php">
        <input type="text" name="username" placeholder="Pseudo" required><br>
        <input type="email" name="email" placeholder="Adresse email" required><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
