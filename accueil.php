<?php
include('include/bdd.php');
include('navbar.php');
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


$sql = "SELECT * FROM `article`";
$query = $db->prepare($sql);
$query->execute();
$articles = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($articles as $article) {
    echo'<div class="text">';
    echo($article['nom']) . '<br>';
    echo($article['description']) . '<br>';
    echo($article['prix']) . '<br>';    
    echo'</div>';
    echo'<div class="image">';
    echo '<img src="' . $article['image'] . '" alt="Image from database" style="max-width: 200px; max-height: 200px;">';
    echo '<form action="" method="post">';
    echo '<input type="hidden" name="article_id" value="' . $article['id'] . '">';
    echo '<button type="submit" name="addFav">Ajouter à votre liste</button>';
    echo '</form>';
}
if (isset($_POST['addFav'])) {
    $articleId=$_POST['article_id'];
    $req="INSERT INTO `fav` (id_article) VALUES (:id_article)";
    $query=$db->prepare($req);
    $query->bindValue(':id_article', $articleId, PDO::PARAM_INT);
    $query->execute();

    if ($query->rowCount() > 0) {
        echo 'Article ajouté aux favoris avec succès';
    } else {
        echo 'Erreur lors de l\'ajout de l\'article aux favoris';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    <nav>

    </nav>
</body>
</html>