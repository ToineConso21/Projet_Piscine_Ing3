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
</script>


</head>
<body>

<div class="jumbotron">
  <div class="container-fluid">
    <div class="container text-center">
      <h1>EBAY ECE</h1>
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
          <li><a href="#">Vendre</a></li>
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
  <h1>Bienvenue sur ECE_Bay!</h1>
      <p>
       Nous avons fait le maximum pour vous faciliter la prise en main de ce site et rendre votre expérience plus plaisante !
      </p>
      </div>

  <div class="description2">
      <p>
        Vous avez en bas de cette page les items ajouté récemment par nos vendeurs. Allez jeter un coup d'oeil et passez un agreable moment sur notre site !  
      </p>
    </div>
</header>



<div class="container features" >
    <div class="row">
      <div class="col-sm-3">
            <div class="container">
              <a href="fjords.jpg"><img src="https://placehold.it/150x80?text=IMAGE" class="img-thumbnail" " alt="Image" width="274" height="166" ></a>
            </div>
        </div>
      <div class="col-sm-3">
              <div class="panel panel-danger">
                <div class="panel-heading">NOM OBJET</div>
                <div class="panel-body"> DESCRIPTION ET BOUTON YYEYEYEYEYYEYEEYEYEEEYEY</div>
                <div class="panel-footer">PRIX ET VENDEUR</div>
              </div>
            </div>
      <div class="col-sm-3">
            <div class="container">
              <a href="fjords.jpg"><img src="https://placehold.it/150x80?text=IMAGE" class="img-thumbnail" " alt="Image" width="274" height="166" ></a>
            </div>
        </div>
      <div class="col-sm-3">
              <div class="panel panel-danger">
                <div class="panel-heading">NOM OBJET</div>
                <div class="panel-body"> DESCRIPTION ET BOUTON YYEYEYEYEYYEYEEYEYEEEYEY</div>
                <div class="panel-footer">PRIX ET VENDEUR</div>
              </div>
            </div>
          </div>
        </div>
<br>
<div class="container">
    <div class="row">
      <div class="col-sm-3">
            <div class="container">
              <a href="fjords.jpg"><img src="https://placehold.it/150x80?text=IMAGE" class="img-thumbnail" " alt="Image" width="274" height="166" ></a>
            </div>
        </div>
      <div class="col-sm-3">
              <div class="panel panel-danger">
                <div class="panel-heading">NOM OBJET</div>
                <div class="panel-body"> DESCRIPTION ET BOUTON YYEYEYEYEYYEYEEYEYEEEYEY</div>
                <div class="panel-footer">PRIX ET VENDEUR</div>
              </div>
            </div>
      <div class="col-sm-3">
            <div class="container">
              <a href="fjords.jpg"><img src="https://placehold.it/150x80?text=IMAGE" class="img-thumbnail" " alt="Image" width="274" height="166" ></a>
            </div>
        </div>
      <div class="col-sm-3">
              <div class="panel panel-danger">
                <div class="panel-heading">NOM OBJET</div>
                <div class="panel-body"> DESCRIPTION ET BOUTON YYEYEYEYEYYEYEEYEYEEEYEY</div>
                <div class="panel-footer">PRIX ET VENDEUR</div>
              </div>
            </div>
          </div>
        </div>
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
