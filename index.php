<?php
include('include/bdd.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

class User{
    //propriétés
    public $name;
    public $surname;
    public $email;
    public $password;
    }

if(!empty($_POST['nom']) && !empty ($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['mdp'])) {
    $user = new User();
    $user->name = $_POST['nom'];
    $user->surname = $_POST['prenom'];
    $user->email = $_POST['email'];
    $user->password = $_POST['mdp'];

    $sql = 'INSERT INTO `user` (`nom`, `prenom`, `mail`, `mdp`)
    VALUES (:nom, :prenom, :email, :mdp)';
    $query = $db->prepare($sql);
    $query->bindValue(":nom", $user->name, PDO::PARAM_STR);
    $query->bindValue(":prenom", $user->surname, PDO::PARAM_STR);
    $query->bindValue(":email", $user->email, PDO::PARAM_STR);
    $hash = password_hash($user->password, PASSWORD_DEFAULT);
    $query->bindValue(":mdp", $hash, PDO::PARAM_STR);
    $query->execute();
    
    try {
        // Votre code d'insertion ici
        echo 'Inscription réussie!';
    } catch (PDOException $e) {
        echo 'Erreur lors de l\'inscription: ' . $e->getMessage();
    }
header('Location:connexion.php');


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
    
    <form action="" method="post">
            <input type="text" name="nom" placeholder="Nom">
            <input type="text" name="prenom" placeholder=Prenom>
            <input type="email" name="email" placeholder="Mail">
            <input type="password" name="mdp" placeholder="Mot de passe">
    <button type="submit"> Envoyez votre inscription</button>
    
    </form>
    
</body>
</html>