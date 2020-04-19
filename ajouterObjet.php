<?php
  session_start();
?>




<!DOCTYPE html>
<html>
<head>
  <title>Ebay ECE - Ajouter un objet</title>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="util.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
 </script>

 <script type="text/javascript">
   function faireApparaitre_disparaitre(laCase,leId, leId2)
   {
    if (laCase.checked) 
    {
      document.getElementById(leId).style.visibility = "visible";
      document.getElementById(leId2).style.visibility = "visible";

    }
    else
    {
      document.getElementById(leId).style.visibility = "hidden";
      document.getElementById(leId2).style.visibility = "hidden";
    }
   }

 </script>

</head>


<body>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Ebay ECE</h1>      
    <p>Mission, Vission & Values</p>
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

<div class="container-fluid">

  <h1><center>Vendre</center></h1><br>

    <div style="float: left; width: 10%;">
      <?php

        $database = "ece_ebay";

        $conn=mysqli_connect('localhost:3308','root','','ece_ebay');

        $sql= "SELECT * FROM vendeur";
              $result=mysqli_query($conn,$sql);
                $data = mysqli_fetch_assoc($result);
                $image = $data['Image'];
                            echo "<img class='left'  src='$image' height='120' width='100'>"

      ?>
    </div>
      <div><hr class="new4" style="width: 100%;"></div>

<!-------------------------------------------DEBUT DE CREATION------------------------------------------->


<div>
  <center>
  <h3><strong>Ajoutez un objet :</strong></h3>

  <div name="boite2" id="boite2">
    <form action="http://localhost/Projet_Piscine_Ing3/creationObjet.php" method="post">
      <table>
        <tr>
          <td>Nom de votre objet :</td>
          <td><input type="text" required name="nom_objet"></td>
        </tr>
        <tr>
          <td>Description de votre Objet:</td>
          <td><textarea name="description_objet" rows="3" cols="50" required></textarea></td>
        <tr>
          <td>Ajoutez une photo de l'objet:</td>
          <td><input type="file" name="photo_objet" required></td>
        </tr>
        <tr>
          <td>Ajoutez une vidéo de l'objet:</td>
          <td><input type="file" name="video_objet"></td>
        </tr>
        <tr>
          <td>A quelle catégorie appartient-il ?</td>
          <td>
            <input type="radio" name="categorie_objet" value="ferraille ou Tresor" required>
            <label>Ferraille ou tresor</label><br>
            <input type="radio" name="categorie_objet" value="Bon pour le musee" required>
            <label>Bon pour le musee</label><br>
            <input type="radio" name="categorie_objet" value="accessoire VIP" required>
            <label>Accessoire VIP</label>
          </td>
        </tr>
      </table>

      <h4><strong>Mode de vente souhaité : </strong></h4>

<div style="display: flex; flex-direction: row; justify-content: center; margin-bottom: 50px;">
  
  <div style="display: flex; flex-direction: column;  margin: 10px; width: 350px;" >
        
          <label><input type="checkbox" id="checkbox1"  onclick="faireApparaitre_disparaitre(this,'1')"> Enchères</label>
          <table  id="1" style="visibility: hidden;">
            <tr>
              <td>Entrez votre prix minimum en euros:</td>
              <td><input type="number" id="11" name="prix_min"></td>
            </tr>
            <tr>
              <td>Début des enchères :</td>
              <td><input type="date" name="debut_enchère" id="12" value="2020-07-01"></td>
            </tr>
            <tr>
              <td>Fin des enchères:</td>
              <td><input type="date" name="fin_enchere" id="13" value="2020-07-01"></td>
            </tr>
          </table>
  </div>

  <div style="display: flex;flex-direction: column;   margin: 10px; width: 350px;">

         <label><input type="checkbox" id="checkbox2"   onclick="faireApparaitre_disparaitre(this,'2')">Offres</label>
          <table id="2" style="visibility: hidden;" >
            <tr>
              <td>Prix initial:</td>
              <td><input type="number" name="prix_init"  ></td>
            </tr>
          </table>
  </div>

  <div style="display: flex;flex-direction: column; margin: 10px; width: 350px;">

          <label><input type="checkbox" id="checkbox3"   onclick="faireApparaitre_disparaitre(this,'3')">Vente Direct</label>
          <table id="3" style="visibility: hidden;">
            <tr>
              <td>Prix fixe:</td>
              <td><input type="number" name="prix_fixe" ></td>
            </tr>
          </table>
  </div>

</div>

          <input  type="submit" name="Valider"> 

    </form>
  </div>
  </center>
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