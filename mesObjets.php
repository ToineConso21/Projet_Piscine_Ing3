<?php
  session_start();
?>


<!DOCTYPE html>
<html>
<head>
  <title>Ebay ECE - Mes Objets</title>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="util.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
 </script>

 <script type="text/javascript">

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

  <h1><center><strong>Vendre</strong></center></h1><br>

  <hr class="new4">
  <br><br>

    
<!-------------------------------------------DEBUT DE MES_OBJETS------------------------------------------->

  <h3><center><u>Mes Objets :</u></center></h1><br><br>

<?php

  $id_vendeur=$_SESSION['user_id'];
  $database = "ece_ebay";
  $id_items_tampon = '0';

  $conn=mysqli_connect('localhost:3308','root','','ece_ebay');

  if (!$conn) 
  {
    echo "Erreur de connexion a la bdd";
  }
  else
  {
    $sql = "SELECT * FROM items WHERE  ID_Vendeur = '".$id_vendeur."' ";

    $result = mysqli_query($conn, $sql);
    $compteur = mysqli_num_rows($result);
    if ($compteur == 0) 
    {
      echo "Pas trouve de items. <br>";
      echo "$id_vendeur";
    } 
    else 
    {
      echo "on a trouve";
      for ($i=0; $i < $compteur ; $i++) { 


        while ($data = mysqli_fetch_assoc($result)) {
          echo "<div style='border-style: double; display: flex; flex-direction: row; margin-bottom: 50px; margin-left: 60px; margin-right: 60px; '> ";

            echo "    <div style=' padding-left: 20px; padding-top: 10px; padding-bottom: 10px; padding-right: 20px; '>";
            $image = $data['Photo'];
            echo "<td>" . "<img src='$image' height='274' width='260'>" .
            "</td>";
            echo "</div>";
            echo "<div style='width: 400px; margin-right: 10px; background-color: #A47D74'>";
            echo "<h1>" . $data['Nom'] . "</h1><br>";
            echo "<h5>" . $data['Description'] . "</h5><br>";
            echo "<br><br><br><h4>Cet item appartient à cette catégorie : " . $data['Categorie'] . "</h4>";
            echo "</div>";

            echo "<div style=' width: 300px; background-color: grey; margin-right: 10px;'>";
            echo "<center>";
            echo "<h3>Cet item est disponible en : </h3><br>";
            echo "<br><h2>". $data['TypeVente1'] . "</h2>";
            if ($data['TypeVente2'] == 'VenteDirect' ) 
            {
              echo "<br><br><h2>" . $data['TypeVente2'] . "</h2>";
            }
            echo "</div>";

            echo "<button type='button' style='margin-top:20px; margin-left: 20px; width:200px; height:40px;'>Supprimer</button> ";


        echo "</div>";
        }

      }
    }
  }

?>

  <div style="border-style: double; display: flex; flex-direction: row; margin-top: 50px; margin-bottom: 50px; margin-left: 60px; margin-right: 60px;">

    <a href="ajouterObjet.php"> <button type='button' style='margin-top:20px; margin-left: 20px; width:200px; height:40px;'>Ajouter un Objet</button> </a>
  </div>


  <div>

    <form action="bid.php">
      <input type="text" name="nouvelle_offre">Nouvelle Offre : </input>
      <button type="submit">Envoyer</button>
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