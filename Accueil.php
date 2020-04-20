<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ebay ECE</title>
  <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="util.css">

 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
 $('.header').height($(window).height());
 });
 

$(document).ready(function(){
      $("#show1").click(function(){
      $("#image1").show();
    });
 });

 $(document).ready(function(){
       $("#show2").click(function(){
        $("#image2").show();
    });
 });
$(document).ready(function(){
       $("#show3").click(function(){
        $("#image3").show();
    });
 });
$(document).ready(function(){
       $("#show4").click(function(){
        $("#image4").show();
    });
 });

</script>


</head>
<body>

<div class="jumbotron">
  <div class="container-fluid">
    <div class="container text-center">
      <a href="http://localhost/Projet_Piscine_Ing3/Accueil.php"><img src="http://localhost/Projet_Piscine_Ing3/imgs/Logo.jpg" class="img-thumbnail" style="width:261px; height:100px; "></a>
    </div>
  </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="Accueil.php">Accueil</a></li>
  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Catégories<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="Categorie/FerrailleTresors.php">Féraille ou Trésor</a></li>
          <li><a href="Categorie/musee.php">Bon pour le musée</a></li>
          <li><a href="Categorie/VIP.php">Acessoire VIP</a></li>
        </ul>
      </li>
        <?php if((isset($_SESSION['user_type']) && $_SESSION['user_type']=="Vendeur" )|| (isset($_SESSION['user_type']) && $_SESSION['user_type']=="Admin" )) {
          ?>
          <li><a href="http://localhost/Projet_Piscine_Ing3/mesObjets.php">Vendre</a></li>
          <?php
        } 
        ?>
        
        <?php if ((isset($_SESSION['user_type']) && $_SESSION['user_type']=="Vendeur" )) {
          ?>
          <li><a href="http://localhost/Projet_Piscine_Ing3/comptes/compteVendeur.php">Mon Compte</a></li>
        
          <?php
        }
        ?>

        <?php if ((isset($_SESSION['user_type']) && $_SESSION['user_type']=="Acheteur" )) {
          ?>
          <li><a href="http://localhost/Projet_Piscine_Ing3/comptes/compteAcheteur.php">Mon Compte</a></li>
          <?php
        } 
        ?>
        
        <?php if ((isset($_SESSION['user_nom']) && $_SESSION['user_nom']== 'BillyBob' )) {
          ?>
          <li><a href="http://localhost/Projet_Piscine_Ing3/utilisateur.php">Utilisateur</a></li>
        
          <?php
        }
        ?>

      </ul>
      <ul class="nav navbar-nav navbar-right">

        <?php if(!isset($_SESSION['user_type'])) {
          ?>
            <li><a href="comptesCrea/signUp_Acheteur.php"><span class="glyphicon glyphicon-user"></span> Créer un compte</a></li>
            <li><a href="Connexion.php">Connexion</a></li>
          <?php
        } 
        ?>

        <?php if (isset($_SESSION['user_id'])) {
          ?>
          <li><a href="comptes/monPanier.php" title="panier"><img src="imgs/supermarket.png" style="size: relative;"></a></li>
        <?php
          }
        ?>


        <?php if (isset($_SESSION['user_id'])) {
          ?>
          <li><a href="sessMgmt/logout.php" title="Logout"><img src="imgs/logout.png" style="size: relative;"></a></li>
        <?php
          }
        ?>
        </ul>
    </div>
  </div>
</nav>

<header class="page-header header container-fluid">
<div class="overlay"></div>
  <div class="description">
    <?php if(!isset($_SESSION['user_type'] )){
    ?>
  <h1>Bienvenue sur WestBay!</h1>
      <p>
       Ici tous les Cow-Boys et toutes les Cow-Girl trouvent ce dont ils ont besoin en se créant un compte Acheteur!<br>
       Si vous avez un outils dont vous ne vous servez plus à la ferme ou que vous avez besoin d'argent pour un nouveau fusil, créez un compte vendeur en moins de 5 minutes! 
      </p>
      </div>

  <div class="description2">
      <p>
         N'hésitez plus et rejoignez WestBay!<br>
         Numéro 1 dans tout le Far-West.
      </p>
    </div>
  <?php 
}   else{
  ?>
  <div class="description">
   <h1>Vous êtes Connectés!</h1>
 </div>
<?php
}?>
</header>


<h1><center>Les Derniers ajouts du site</center></h1>
<div class="container features" >
    <div class="row">
      <div class="col-sm-3">
            <div class="container">
              <a href="fjords.jpg"><img src="imgs/Sac.jpg" class="img-thumbnail"  alt="Image" width="174" height="166" ></a>
            </div>
        </div>
      <div class="col-sm-3">
              <div class="panel panel-danger">
                <div class="panel-heading"> Sac en Cuir</div>
                <div class="panel-body"> Un très beau sac de belle qualitée, </div>
                <div class="panel-footer">Billy the Kid</div>
              </div>
            </div>
      <div class="col-sm-3">
            <div class="container">
              <a href="fjords.jpg"><img src="imgs/besace.jpg" class="img-thumbnail"  alt="Image" width="174" height="166" ></a>
            </div>
        </div>
      <div class="col-sm-3">
              <div class="panel panel-danger">
                <div class="panel-heading">Besace </div>
                <div class="panel-body"> Besace très solide en cuir de beuf faites par  </div>
                <div class="panel-footer">Un Truand</div>
              </div>
            </div>
          </div>
        </div>
<br>
<div class="container">
    <div class="row">
      <div class="col-sm-3">
            <div class="container">
              <a href="fjords.jpg"><img src="imgs/montre.jpg" class="img-thumbnail" alt="Image" width="174" height="166" ></a>
            </div>
        </div>
      <div class="col-sm-3">
              <div class="panel panel-danger">
                <div class="panel-heading">montre</div>
                <div class="panel-body"> magnifique montre</div>
                <div class="panel-footer"> Un Bon</div>
              </div>
            </div>
      <div class="col-sm-3">
            <div class="container">
              <a href="fjords.jpg"><img src="imgs/meuble.jpg" class="img-thumbnail" alt="Image" width="174" height="166" ></a>
            </div>
        </div>
      <div class="col-sm-3">
              <div class="panel panel-danger">
                <div class="panel-heading">Meuble</div>
                <div class="panel-body">Un meuble qui a survecu à de nombreuses escarmouhe entre bandit</div>
                <div class="panel-footer">Une brutte </div>
              </div>
            </div>
          </div>
        </div>
<br>
<br>
<br>
<hr class="new4">
<br>
<br>
 <?php if(isset($_SESSION['user_type'])== "Acheteur"){
    ?>
    <div id='titreJeu'>
    <h1>GRAND JEUX DU MOIS</h1><br>
    <p>Les règles sont simples : Trouver le truand qui s'est caché dans cette page!</p><br>
    <p>Cliquez sur les boutons :  "CHERCHER"</p>
  </div>
  <br>
  <br>

  <div class="container">
    <div class="row">
      <div class="col-sm-3 ">
       <center> <button type ="submit" id="show1" class="btn btn-danger">CHERCHER</button></center><br>
        <div id="image1" class="image">
        <img src = "imgs/saloon.jpg" width="174" height="166">
      </div>
    </div>

      <div class="col-sm-3 ">
      <center>  <button type ="submit" id="show2" class="btn btn-danger">CHERCHER</button></center><br>
        <div id="image2" class="image">
        <img src = "imgs/eglise.jpg" width="174" height="166">
      </div>
    </div>
    <div class="col-sm-3 " >
       <center> <button type ="submit" id="show3" class="btn btn-danger">CHERCHER</button></center><br>
        <div id="image3" class="image">
        <img src = "imgs/cactus.jpg" width="174" height="166">
      </div>
    </div>
    <div class="col-sm-3 " >
       <center> <button type ="submit" id="show4" class="btn btn-danger">CHERCHER</button></center><br>
        <div id="image4" class="image">

        <img src = "imgs/bandit.jpg" width="174" height="166">
        <p>Bravo vous l'avez trouvé!</p><br>
        <p>Vous gagnez une prime de 50 euros : </p><br>
        <form action ="Accueil.php" method="post">
        <button type="submit" name="gagnant" value="1" class="btn btn-warning">Recupérer</button>
      </form>
      </div>
    </div>
   
    
    </div>
  </div>
  

    
<?php

}

?>



<br>
<footer class="page-footer">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-12">
        <h6 class="text-uppercase font-weight-bold">Information additionnelle</h6>
        <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque interdum quam odio, quis placerat ante luctus eu.
        Sed aliquet dolor id sapien rutrum, id vulputate quam iaculis.
        </p>
        <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque interdum quam odio, quis placerat ante luctus eu.
        Sed aliquet dolor id sapien rutrum, id vulputate quam iaculis.
        </p>
        </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <h6 class="text-uppercase font-weight-bold">Contact</h6>
        <p>
        37, quai de Grenelle, 75015 Paris, France <br>
        ece_bay@edu.ece.fr <br>
        +33 01 76 81 10 98 <br>
        +33 01 09 56 74 72
        </p>
      </div>
    </div>
  <div class="footer-copyright text-center">&copy; 2019 Copyright | Droit d'auteur: ece_bay@edu.ece.fr</div>
</footer>


</body>
</html>