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
          <li class="active"><a href="http://localhost/Projet_Piscine_Ing3/Accueil.php">Accueil</a></li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Catégories<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="FerrailleTresors.php">Féraille ou Trésor</a></li>
            <li><a href="musee.php">Bon pour le musée</a></li>
            <li><a href="VIP.php">Acessoire VIP</a></li>
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

  $conn=mysqli_connect('localhost:3308','root','','ece_ebay');

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
          echo "<div class='col-sm-6 style='height='600px';'>";
              echo "<div class='container'>";
                $image = $data['Photo'];
                echo "<img src='../imgs/$image' class='img-thumbnail ' alt='Image' width='374' height='266' >";
              echo"</div>";
            echo"</div>";
          echo"<div class='col-sm-6' id='fiche'>";
           echo "<h1 ><strong>".$data['Nom']."</strong></h1><br>";
            echo"<table>";
              echo"<tr>";
                echo"<td>".$data['Description']."</td>";
               echo"</tr>";

            $sql2= "SELECT * FROM vendeur Where ID ='".$data['ID_Vendeur']."'";
            $result2 = mysqli_query($conn,$sql2);
             if (mysqli_num_rows($result2)==0) { echo "Erreur sql2";};

            $data2 = mysqli_fetch_assoc($result2);

            $id_vendeur = $data2['ID'];
            echo"<tr>";
              echo"<td>Vendeur : ".$data2['Pseudo']."</td>";
            echo "</tr>"; 

        
             
/*------------------------------------------------Affichage de l'interaction avec enchère------------------------------------*/

                if($data['TypeVente1']=="encheres")
                {
                    $sql3="SELECT * FROM encheres WHERE ID_items ='".$ID."'";
                     $result3 = mysqli_query($conn,$sql3);
                      if (mysqli_num_rows($result3)==0) {
                            echo "Aucune enchere trouvé";
                           }
                      $data3 = mysqli_fetch_assoc($result3);
                      echo"<tr>";
                      echo"<td><stong>Prix minimum fixé par le Vendeur : ".$data3['Prix']."</strong></td>";
                      echo"</tr>";
                      echo"<tr>";
                      echo"<td>Date de fin de l'enchère :".$data3['Date_fin']."</td>";
                       echo"</tr>";
                      echo"<tr>";
                      $_SESSION['id_item']=$ID;
                      echo "<form action='../fonctionsPaiement/actionsClient.php' method='post'> ";
                        echo"<td>Faire une Enchère :</td>";
                          echo"</tr>";
                          echo"<tr>";
                          echo"<td><input type='text' name='montant'> &nbsp;&nbsp <button type='submit' name='type_achat' value='Enchere' class='btn btn-primary'>Encherir</button></td>";
                        echo "</form>";
                         echo"</tr>";
                        
                      }


/*------------------------------------------------Affichage de l'interaction avec offres------------------------------------*/
                 

                 if($data['TypeVente1']=="offres")
                {
                      echo"<tr>";
                      echo"<td>Faire une Offre pour cette objet : </td>" ;
                     
                     echo "<td>
                     <form action='../negociation.php' method='post'>
                 <input type='number' name='offre_acheteur'> <td>";
                       echo "<td>

                       <input type='hidden' value='$id_vendeur' name='id_du_vendeur'/>


                 <button type='submit' name='Envoyez_btn' class='btn btn-primary' value='".$ID."' >Envoyez l'offre </button> </form><td> 
                 </tr>" ;
                    }

/*------------------------------------------------Affichage de l'interaction avec Achat_Direct------------------------------------*/

                  if($data['TypeVente1']=="achat_direct" || $data['TypeVente2']=="achat_direct")
                {

                     $sql4="SELECT * FROM achat_Direct WHERE ID_items ='".$ID."'";
                     $result4 = mysqli_query($conn,$sql4);
                      if (mysqli_num_rows($result4)==0) {
                            echo "Erreur sql2";
                       }
                      $data4 = mysqli_fetch_assoc($result4);
                       echo"<tr>";
                      echo"<td>Achat Direct</td>";
                       echo"</tr>" ;
                      echo"<tr>";
                      echo"<td>Prix : ".$data4['Prix']."</td>";
                       echo"</tr>" ;
                        echo"<tr>";
                       echo "<td><form action='../Paiement/commandeP1.php' method='post'>
                 <button type='submit' name='Acheter_btn' class='btn btn-primary' value='".$ID."' >Acheter </button> </form><td>";
                        echo"</tr>" ;
                        
                       
                    }

                    echo"</table>";
          echo "</div>";
        echo "</div>";
        
}

?>



<br>
<br>
<br>
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