<?php
include('include/bdd.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!empty($_POST['email']) && !empty($_POST['mdp'])) {
    $sql = "SELECT * FROM `user` WHERE `mail` = :email";
    $query = $db->prepare($sql);
    $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
    $query->execute();
    $requete = $query->fetch();
    // var_dump($requete);
    $verify=password_verify($_POST["mdp"], $requete["mdp"]);

    if($requete['mail'] === $_POST['email'] && $verify === true) {

        echo("Connexion réussie");
        header('Location: accueil.php');
        session_start();
        $_SESSION["id"] = $requete["id"];
        $_SESSION["nom"] = $requete["nom"];
        $_SESSION['prenom'] = $requete['prenom'];
        $_SESSION['email'] = $requete['email'];
        
    } else {

        echo("Connexion échouée");
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<nav>
    <?php
        include('navbar.php');
?>
    </nav>
    
    <div class="m 2 bg-primary">
    <form action=""method="post">
        <input type="text" name="email" placeholder="email">
        <input type="password" name="mdp" placeholder="mdp">
        <button type="submit">Connexion</button></div>
    </form>
</body>
</html>