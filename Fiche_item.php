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
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Créer un compte</a></li>
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
<br>
<br>
<br>

<?php 


  $ID=isset($_POST["bouton"])? $_POST["bouton"] : "";

  $conn=mysqli_connect('localhost','root','','ece_ebay');

  if (!$conn) {
    echo "Erreur de connexion a la bdd";
  }
  else {

          $sql="SELECT * FROM items WHERE ID='".$ID."'";
          $result=mysqli_query($conn,$sql);

          if (mysqli_num_rows($result)==0) {
            echo "Erreur bdd";
            }
        $data= mysqli_fetch_assoc($result);
        echo "<div class='row'>";
         echo "<div class='col-sm-6>";
              echo "<div class='container'>";
                $image = $data['Photo'];
                echo "<img src='$image' class='img-thumbnail ' alt='Image' width='374' height='266' >";
              echo"</div>";
            echo"</div>";
          echo"<div class='col-sm-6'>";
            echo "<h1><strong>".$data['Nom']."</strong></h1><br>";
            echo $data['Description']."<br>";

            $sql2= "SELECT Pseudo FROM vendeur Where ID ='".$data['ID_Vendeur']."'";
            $result2 = mysqli_query($conn,$sql2);
            $data2 = mysqli_fetch_assoc($result2);
            echo "Veudeur : ".$data2['Pseudo']."<br>";
            
                if($data['TypeVente1']=="Enchere" || $data['TypeVente2']=="Enchere")
                {
                    $sql3="SELECT * FROM encheres WHERE ID_items ='".$ID."'";
                     $result3 = mysqli_query($conn,$sql3);
                      $data3 = mysqli_fetch_assoc($result3);
                      echo"<stong>Prix minimum fixé par le Vendeur : ".$data3['Prix']."</strong><br>";
                      echo"Date de fin de l'enchère :".$data2['Date_fin']."<br>";
                      echo"<form>";
                        echo"Faire une Enchère :<br>";
                        echo"<input type='text' name='enchere' value='newPrix'>";
                        echo "$nbsp;$nbsp; <input type='submit'value='Enchrir'>";
                      echo"</form>";}
          echo "</div>";
          echo "</div>";






}

?>



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