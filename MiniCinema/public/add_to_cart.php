<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['movie_id'])) {
    $user_id = $_SESSION['user_id'];
    $movie_id = (int)$_POST['movie_id'];

    // Appel de l'API addtoCart.php via file_get_contents
    $data = http_build_query([
        'user_id' => $user_id,
        'movie_id' => $movie_id
    ]);

    $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => 'Content-Type: application/x-www-form-urlencoded',
            'content' => $data
        ]
    ];

    $context  = stream_context_create($options);
    file_get_contents("http://localhost/MiniCinema/api/addtoCart.php", false, $context);

    // Retour à l'accueil après ajout
    header("Location: index.php");
    exit;
}
?>
<?php
