<div class="container-fluid">


            



<?php

           include('include/bdd.php');
                

           if (!isset($_SESSION['id'])) {

                          
           echo '<a id="nav" href="index.php">Inscrivez vous</a>
           <a id="nav" href="connexion.php">Connectez vous</a>
           <a id="nav" href="fav.php">Ma liste</a>
           <a id="nav" href="accueil.php">Accueil</a>';
           
           } else if (isset($_SESSION['id']))  {

               echo '<a id="nav">Bienvenue ' . $_SESSION['prenom'] . 
               '<a id="nav" href="deco.php">Déconnexion</a>';
               
           } else {

               echo '<a id="nav">Bienvenue ' . $_SESSION['prenom'] . 
               '<a id="nav" href="deco.php">Déconnexion</a>';

           } 
           
           ?>
</div>
           