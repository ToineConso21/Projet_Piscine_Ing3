<!DOCTYPE html>
<html>
<head>
  <title>Ebay ECE - Sign in Vendeur</title>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="http://localhost/Projet_Piscine_Ing3/util.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
 </script>

</head>


<body style="align-content: center;">

<div class="jumbotron">
  <div class="container text-center">
      <a href="http://localhost/Projet_Piscine_Ing3/Accueil.php"><img src="http://localhost/Projet_Piscine_Ing3/imgs/Logo.jpg" class="img-thumbnail" style="width:261px; height:100px; "></a>
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
        <li class="active"><a href="http://localhost/Projet_Piscine_Ing3/Accueil.php">Accueil</a></li>
  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Catégories<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Féraille ou Trésor</a></li>
          <li><a href="#">Bon pour le musée</a></li>
          <li><a href="#">Acessoire VIP</a></li>
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
            <li><a href="comptesCrea/SignUp_select.html"><span class="glyphicon glyphicon-user"></span> Créer un compte</a></li>
            <li><a href="http://localhost/Projet_Piscine_Ing3/Connexion.php">Connexion</a></li>
          <?php
        } 
        ?>
        <?php if (isset($_SESSION['user_id'])) {
          ?>
          <li><a href="http://localhost/Projet_Piscine_Ing3/sessMgmt/logout.php" title="Logout"><img src="http://localhost/Projet_Piscine_Ing3/imgs/logout.png" style="size: relative;"></a></li>
        <?php
          }
        ?>
        </ul>
    </div>
  </div>
</nav>

<div class="container-fluid" align="center">

  <label>Si vous voulez créer un compte Acheteur, appuyez ici :</label>

  <button onclick="document.location = 'SignUp_select.html'">Acheteur</button>
  <hr class="new4">

  <h1 style="padding: 20px">Créer mon compte Vendeur</h1>

  <hr class="new4">
  <h3 style="padding: 20px">Rentrez les informations demandées</h1>


<!-------------------------------------------------------------------------------------------------->
<!-------------------------------------------VENDEUR------------------------------------------------>
<!-------------------------------------------------------------------------------------------------->

<div name="boite2" id="boite2">
  <form action="creation_Vendeur.php" method="post">
    <table>
      <!------------------------------------------- Identifiants--------------------------------------->
      <tr>
        <td><u>Vos Identifiants :</u><br></td>
      </tr>
      <tr>
        <td>Nom d'utilisateur :</td>
        <td><input type="text" required name="nom_utilisateur"></td>
      </tr>
      <tr>
        <td>Email:</td>
        <td><input type="email_vendeur" required name="email_vendeur"></td>
      </tr>
      <!------------------------------------------- Informations personnelles------------------------------------->

        <td><u>Informations personnelles :</u><br></td>
      </tr>
      <tr>
        <td>Nom:</td>
        <td><input type="text" required name="nom_vendeur"></td>
      </tr>
      <tr>
        <td>Prénom:</td>
        <td><input type="text" required name="prenom_vendeur"></td>
      </tr>
      <tr>
        <td>Ajoutez une photo de profil:</td>
        <td><input type="file" name="photo_pdp"></td>
      </tr>
      <tr>
        <td>Ajoutez une photo de couverture:</td>
        <td><input type="file" name="photo_couverture"></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
        <input type="Submit"  name="creation_vendeur">
        </td>
      </tr>
    </table>
  </form>
</div>


<br>

</div>
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