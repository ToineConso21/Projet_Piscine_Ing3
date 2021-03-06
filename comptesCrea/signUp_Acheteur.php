<!DOCTYPE html>
<html>
<head>
	<title>Ebay ECE - Sign in Acheteur</title>


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

  <label>Si vous voulez créer un compte Vendeur, appuyez ici :</label>

  <button onclick="document.location = 'signUp_Vendeur.php'">Vendeur</button>

  <hr class="new4">
  <h1 style="padding: 20px">Créer mon compte Acheteur</h1>
    <hr class="new4">

  <h3 style="padding: 20px">Rentrez les informations demandées</h1>

<!------------------------------------------------------------------------------------------------------->
<!-------------------------------------------ACHETEUR------------------------------------------------------>
<!-------------------------------------------------------------------------------------------------------->

<div class="boite" name="boite" id="boite">
  <form action="creation_Acheteur.php" method="post">
    <table>
      <!------------------------------------------- Identifiants--------------------------------------->
      <tr>
        <td><u>Vos Identifiants :</u><br></td>
      </tr>
      <tr>
        <td>Email:</td>
        <td><input type="email" name="email_acheteur" required></td>
      </tr>
      <tr>
        <td>Votre mot de passe:</td>
        <td><input type="password" name="mdp" required></td>
      </tr>
      <tr>
        <td>Confirmer votre mot de passe:</td>
        <td><input type="password" name="mdp2" required></td>
      </tr>
      <!------------------------------------------- Informations personnelles------------------------------------->

        <td><u>Informations personnelles :</u><br></td>
      </tr>
      <tr>
        <td>Nom:</td>
        <td><input type="text" name="nom_acheteur" required></td>
      </tr>
      <tr>
        <td>Prénom:</td>
        <td><input type="text" name="prenom_acheteur" required></td>
      </tr>
      <tr>
        <td>Adresse1:</td>
        <td><textarea name="adresse1" rows="3" cols="50" required></textarea></td>
      </tr>
      <tr>
        <td>Adresse2:</td>
        <td><textarea name="adresse2" rows="3" cols="50"></textarea></td>
      </tr>
      <tr>
        <td>Code Postale:</td>
        <td><input type="number" name="code_postal" required></td>
      </tr>
      <tr>
        <td>Ville:</td>
        <td><input type="text" name="ville" required></td>
      </tr>
      <tr>
        <td>Pays:</td>
        <td><input type="text" name="pays"></td>
      </tr>
      <tr>
        <td>Téléphone:</td>
        <td><input type="number" name="tel"></td>
      </tr>
      <!------------------------------------------- Informations banquaires--------------------------------------->
      <tr>
        <td><u>Vos Informations banquaires :</u><br></td>
      </tr>
      <tr>
        <td>Type de carte de paiement:</td>
        <td> 
                  <select name="type_de_carte">
                        <option value="MasterCard">MasterCard</option>
                        <option value="VISA">VISA</option>
                        <option value="American Express">American Express</option>
                  </select>
            </td>
      </tr>
      <tr>
        <td>Numéro de la carte:</td>
        <td><input type="number" name="num_carte"></td>
      </tr>
      <tr>
        <td>Nom du titulaire:</td>
        <td><input type="text" name="nom_titulaire"></td>
      </tr>
      <tr>
        <td>Date d'expiration :</td> 
        <td><input type="date" name="date_exp" value="2030-07-01"></td>
      </tr>
      <tr>
        <td>Code de sécurité :</td>
        <td><input type="number" name="num_secu"></td>
      </tr>
      <tr>
        <td><input type="checkbox" name="condition_accepte" required>Vous acceptez les conditions de la clause</td>
      </tr>
      <tr>
        <td colspan="2" align="center">
        <input type="Submit"  name="creation_acheteur">
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