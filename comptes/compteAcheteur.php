<?php
	session_start();
	require_once('../sessMgmt/session.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>ECE Ebay | Mon Compte</title>
</head>

 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" 
  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="http://localhost/Projet_Piscine_Ing3/util.css">

 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>


</head>

<!-----------------------------------DEBUT DU BODY--------------------------------------------->

<body>
	<div class="jumbotron">
  <div class="container-fluid">
    <div class="container text-center">
      <a href="http://localhost/Projet_Piscine_Ing3/Accueil.php"><img src="http://localhost/Projet_Piscine_Ing3/imgs/Logo.jpg" class="img-thumbnail" style="width:261px; height:100px; "></a>    </div>
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
          <li><a href="../Categorie/FerrailleTresors.php">Féraille ou Trésor</a></li>
          <li><a href="../Categorie/musee.php">Bon pour le musée</a></li>
          <li><a href="../Categorie/VIP.php">Acessoire VIP</a></li>
        </ul>
      </li>
        <?php if((isset($_SESSION['user_type']) && $_SESSION['user_type']=="Vendeur" )|| (isset($_SESSION['user_type']) && $_SESSION['user_type']=="Admin" )) {
          ?>
          <li><a href="#">Vendre</a></li>
          <?php
        } 
        ?>

        <?php if (isset($_SESSION['user_login'])) {
          ?>
          <li><a href="#">Mon Compte</a></li>
          <?php
        } 
        ?>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if(!isset($_SESSION['user_type'])) {
          ?>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Créer un compte</a></li>
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


<!------------------------------------------------------------AFFICHAGE DES INFORMATIONS------------------------------------->

<h3 style="padding-left: 25px; padding-top: 25px;">Bonjour <strong><?php echo $_SESSION['user_login'] ?></strong> !</h3><br>
<h4 style="padding-left: 25px; padding-top: 25px">Voici votre profil enregistré</h4>

<div style="display: flex; flex-direction: row; justify-content: center; margin-bottom: 50px;">
	
	<div style="display: flex; flex-direction: column; background-color: #6BAB90; border-radius: 25px; padding: 45px; border: 2px solid black;" >
		<h3 style="padding: 20px; font-style: italic;"  align="center">Mes informations</h3>
			<form>
				<table class="h4" style="margin-left: 50px; margin-right: 45px;">
			      <tr>
			        <td>Nom:</td>
			        <td><?php echo $_SESSION['user_nom']; ?></td>
			      </tr>
			      
			      <tr>
			        <td>Prénom:</td>
			        <td><?php echo $_SESSION['user_Prenom']; ?> </td>
			      </tr>

			      <tr>
			        <td>Email:</td>
			        <td><?php echo $_SESSION['user_Email']; ?> </td>
			      </tr>

			      <tr>
			        <td>Adresse1:</td>
			        <td><?php echo $_SESSION['user_Adresse1']; ?> </td>
			      </tr>

			      <tr>
			        <td>Adresse2:</td>
			        <td><?php echo $_SESSION['user_Adresse2']; ?></td>
			      </tr>

			      <tr>
			        <td>Code Postal:</td>
			        <td><?php echo $_SESSION['user_CP']; ?> </td>
			      </tr>

			      <tr>
			        <td>Ville:</td>
			        <td><?php echo $_SESSION['user_Ville']; ?> </td>
			      </tr>

			      <tr>
			        <td colspan="2" align="center" >
			        <input type="Submit"  class="regular" name="creation_acheteur" value="Modifier">
			        </td>
			      </tr>
				</table>
			</form>
	</div>
<!-------------------------------------------------- INFORMATIONS BANCAIRES------------------------------------------------------------>
	 
	<div style="display: flex;flex-direction: column; background-color: #0E7C7B; border-radius: 25px; border: 2px solid black;">
		<h3 style="padding: 20px; font-style: italic;" align="center">Mes informations bancaires</h3>
		<form>
			<table class="h4" style="margin-left: 50px; margin-right: 45px;">
			  
			      <tr>
			        <td>Type de carte de paiement:</td>
			        <td><?php echo $_SESSION['user_Pay']; ?> </td>
			      </tr>

			      <tr>
			        <td>Numéro de la carte:</td>
			        <td><?php echo $_SESSION['user_numCard']; ?></td>
			      </tr>
			      <tr>
			        <td>Nom du titulaire:</td>
			        <td><?php echo $_SESSION['user_nomCard']; ?></td>
			      </tr>
			      <tr>
			        <td>Date d'expiration:</td> 
			        <td><?php echo $_SESSION['user_dateExp']; ?></td>
			      </tr>
			      <tr>
			        <td>Code de sécurité :</td>
			        <td><?php echo $_SESSION['user_cardCode']; ?></td>
			      </tr>
			      <tr>
			        <td colspan="2" align="center" >
			        <input type="Submit"  class="regular" name="creation_acheteur" value="Modifier">
			        </td>
			      </tr>
     		</table>
  		</form>
	</div>
</div>

<!-------------------------------------------------------------FOOTER-------------------------------------------------------------->

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