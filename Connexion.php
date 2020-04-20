<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ebay ECE - Sign in</title>
	<meta charset="utf-8">

</head>

<style>
	/* Thick red border */
	hr.new4 {
	  border: 1px solid black;
	}

	.vl {
  border-left: 6px black;
  height: 50px;
}
</style>

	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link href="util.css" rel="stylesheet">

</head>


<body style="align-content: center;">

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
                <li><a href="comptesCrea/signUp_Acheteur.php"><span class="glyphicon glyphicon-user"></span> Créer un compte</a></li>
                <li><a href="#">Connexion</a></li>
              <?php
            } 
            ?>

            <?php if (isset($_SESSION['user_id'])) {
              ?>
              <li><a href="http://localhost/Projet_Piscine_Ing3/sessMgmt/logout.php" title="Logout"><img src="imgs/logout.png" style="size: relative;"></a></li>
            <?php

              }
            ?>

          </ul>

    </div>
  </div>
</nav>


<div class="container" align="center">
	<h1 style="padding: 20px">Connexion</h1>
	<hr class="new4">

			<form class="h3" action="connectivite.php" method="post">
				<table>
					<tr>
						<td>Identifiant</td>
						<td> <input type="text" name="login" required><br><br></td>
					</tr>

					<tr>
						<td> Mot de passe </td>
						<td> <input type="password" name="mdp" required></td>
					</tr>

					<tr>
						<td style="padding: 5px"><input type="radio" name="statut" value="Vendeur" required> Vendeur </td>
					</tr>
					<tr>
						<td style="padding: 5px"><input type="radio" name="statut" value="Acheteur" required> Acheteur </td>
					</tr>

					<tr>
						<td colspan="2" align="center"> 
						<input type="submit" name="connexion"></td>
					</tr>
				</table>

				
			</form>
		

	
</div>

</body>
</html>