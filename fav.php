<?php
session_start();
include('include/bdd.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);


$sql = "SELECT a.*
        FROM fav f
        INNER JOIN article a ON f.id_article = a.id";
$query = $db->prepare($sql);
$query->execute();
$affi = $query->fetchAll(PDO::FETCH_ASSOC);

// Afficher les détails des articles favoris

foreach ($affi as $article) {
    echo '<div class="text">';
    echo $article['nom'] . '<br>';
    echo $article['description'] . '<br>';
    echo $article['prix'] . '<br>';
    echo '</div>';
    echo '<img src="' . $article['image'] . '" alt="Image from database">';
    echo '<form action="" method="post">';
    echo '<input type="hidden" name="article_id" value="' . $article['id'] . '">';
    echo '<button type="submit" name="suppFav">Supprimer de la liste</button>';
    echo '</form>';
}
if (isset($_POST['suppFav'])) {
    $articleId=$_POST['article_id'];
    $req = "DELETE FROM `fav` WHERE id_article = :id_article";
    $query=$db->prepare($req);
    $query->bindValue(':id_article', $articleId, PDO::PARAM_INT);
    $query->execute();

    if ($query->rowCount() > 0) {
        echo 'Article supprimé avec succès';
    }    
}


?>

