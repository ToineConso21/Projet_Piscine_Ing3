<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ebay ECE</title>
  <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" 
  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="../util.css">

 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
 $('.header').height($(window).height());
 });
</script>


</head>
<body>
<!---------------------------------------------Affichage Du Header------------------------------------------------------------->
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
        <li class="active"><a href="../Accueil.php">Accueil</a></li>
  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Catégories<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="FerrailleTresors.php">Féraille ou Trésor</a></li>
          <li><a href="musee.php">Bon pour le musée</a></li>
          <li><a href="VIP.php">Acessoire VIP</a></li>
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
         <?php if ((isset($_SESSION['user_type']) && $_SESSION['user_type']=="Admin" )) {
          ?>
          <li><a href="http://localhost/Projet_Piscine_Ing3/comptes/Utilisateurs.php">Utilisateurs</a></li>
        
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
          <li><a href="sessMgmt/logout.php" title="Logout"><img src="../imgs/logout.png" style="size: relative;"></a></li>
        <?php
          }
        ?>
        </ul>
    </div>
  </div>
</nav>


<br>
<br>


       <div><h4><strong>Accessoires VIP</strong></h4> <br>
        <hr class="new4">  
        
       </div> 
    <div style>   
        
      
<?php
 
 

  
  
  $conn=mysqli_connect('localhost','root','','ece_ebay');

  if (!$conn) {
    echo "Erreur de connexion a la bdd";
  }
  else {

          $sql="SELECT * FROM items WHERE Categorie = 'VIP'"; // On Selectionne les objets de la categorie VIP 
          $result=mysqli_query($conn,$sql);


          if (mysqli_num_rows($result)==0) {
            echo "Aucun objet dans cette catégorie";
            }

          else{


                 
           echo "<div class='row'>";
            while ($data= mysqli_fetch_assoc($result)) {   // Affichage de tous les objets sélectionnés 
              echo "<div class='col-sm-3'>";
              echo "<div class='container'>";  
              $image = $data['Photo'];
              echo "<img src='../imgs/$image' class='img-thumbnail ' alt='Image' width='224' height='116' >";
              echo"</div>";
              echo"</div>";
               echo"<div class='col-sm-3'>";
              echo"<div class='panel panel-danger'>";
                echo"<div class='panel-heading'> ". $data['Nom'] ."</div>";
                echo"<div class='panel-body'>". $data['Description']."<br>";
                echo "Type de vente de cet objet :<br>";
                 echo $data['TypeVente1']."&nbsp &nbsp <br>";
                  echo $data['TypeVente2']."&nbsp &nbsp <br>";
                  echo"<form action='Fiche_item.php' method='post'>";//lien vers la page fiche item
                  echo "ID de l'objet : ".$data['ID']."<br>";
                echo "<button type='submit' name='bouton' value='".$data['ID']."' >Voir</button>";
                echo "</form>";
                echo "<button type='submit' name='bouton' value='".$data['ID']."'class='btn btn-primary'>Ajouter au panier</button><br>";
                echo"</div>" ;
                $sql2= "SELECT Pseudo FROM vendeur Where ID ='".$data['ID_Vendeur']."'";
                $result2 = mysqli_query($conn,$sql2);
                 if (mysqli_num_rows($result2)==0) {
                echo "Aucun objet dans cette catégorie";
                }
                $data2 = mysqli_fetch_assoc($result2);
                echo"<div class='panel-footer'>". $data2['Pseudo'] ."</div>";
              echo"</div>";
            echo"</div>";
          
            
            }
            echo "</div>";
             
            }

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