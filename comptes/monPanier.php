<?php
  session_start();
?>


<!DOCTYPE html>
<html>
<head>
  <title>Ebay ECE - Mon Panier</title>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="../util.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
 </script>

 <script type="text/javascript">

 </script>

</head>


<body>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Ebay ECE</h1>      
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
        <?php if(isset($_SESSION['user_login']) && $_SESSION['user_type']=="Acheteur" ) {
          ?>
            <li><a href="monPanier.php" title="Acceder aux items enregistrés"><img src="http://localhost/Projet_Piscine_Ing3/imgs/supermarket.png"></a></li>
          <?php
        } 
        ?>
        <?php if (isset($_SESSION['user_id'])) {
          ?>
          <li><a href="../sessMgmt/logout.php" title="Logout"><img src="../imgs/logout.png" style="size: relative;"></a></li>
        <?php
          }
        ?>
        </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">

  <h1><center><strong>Mon Panier</strong></center></h1><br>

  <hr class="new4">
  <br><br>

    
<!-------------------------------------------DEBUT DE MES_OBJETS------------------------------------------->

<?php

  $id_vendeur=$_SESSION['user_id'];

  $id_items_tampon = '0';

  $conn=mysqli_connect('localhost:3308','root','','ece_ebay');

  if (!$conn) 
  {
    echo "Erreur de connexion a la bdd";
  }
  else
  {
   
    $sql="SELECT * 
          FROM items
          LEFT JOIN panier
          ON items.ID = panier.ID_items
          WHERE panier.ID_acheteur='".$_SESSION['user_id']."' ";

    $result = mysqli_query($conn, $sql);
    $compteur = mysqli_num_rows($result);
    
    if ($compteur == 0) 
    {
      echo "Pas trouve de items. <br>";
    } 
    else 
    {
      
      for ($i=0; $i < $compteur ; $i++) { 


        while ($data = mysqli_fetch_assoc($result)) {

          echo "<div style='border-style: double; display: flex; flex-direction: row; margin-bottom: 50px; margin-left: 60px; margin-right: 60px; width=auto; '> ";
            $id_item=$data['ID_items'];
            echo "    <div style=' padding-left: 20px; padding-top: 10px; padding-bottom: 10px; padding-right: 20px; '>";
            $image = '../imgs/$data["Photo"]';
            echo "<td>" . "<img src='$image' height='274' width='260'>" . "</td>";
            echo "</div>";
            echo "<div style='width: 400px; margin-right: 10px; background-color: #A47D74'>";
            echo "<h1 style='padding:30px;'>" . $data['Nom'] . "</h1><br>";
            echo "<h5 align='center'>" . $data['Description'] . "</h5><br>";
            echo "<br><br><br><h4>Cet item appartient à cette catégorie : " . $data['Categorie'] . "</h4>";
            echo "</div>";

            echo "<div style=' width: 450px; background-color: grey; margin-right: 10px;'>";
            echo "<center>";
            echo "<h3>Cet item est disponible en : </h3>";
            echo "<h2>". $data['TypeVente1'] . "</h2><br>";


            $tmp = $data['ID'];

            if ($data['TypeVente1'] == 'Enchere' ) 
            {
                $type_achat="encheres";
                $conn=mysqli_connect('localhost','root','','ece_ebay');

                if (!$conn) {
                  echo "Erreur de connexion à la bdd";
                }
                else{
                  $sql9="SELECT bid.ID_encheres id_enchere, encheres.Statut statut_enchere 
                      FROM bid
                      LEFT JOIN encheres
                      ON bid.ID_encheres = encheres.ID
                      WHERE bid.ID_acheteurs='".$_SESSION['user_id']."' AND encheres.ID_items= '".$id_item."' ";

                  $result9=mysqli_query($conn,$sql9);

                  if (mysqli_num_rows($result)!=0) {
                  $data9=mysqli_fetch_assoc($result9);
                      $statut=$data9['statut_enchere'];
                    
                    if ($statut==1) {
                      //ENCHERE REMPORTEE, IL DOIT POUVOIR PAYER -> IMPLIQUE AFFICHAGE DANS PANIER
                      
                       echo "<div>
                        <div>
                          <h4>Statut :</h4>
                        </div>
                        <div>
                          <h3 style='color: green;'>Enchere Remportée! Disponible à l'achat!</h3>
                          
                          <form action='../Paiement/commandeP1.php' method='post'>
                            <input type='hidden' value='encheres' name='type_achat'>
                           <button type='submit' name='Acheter_btn' class='btn btn-primary' value='".$id_item."' >Acheter  </button> 
                           </form>;
                        </div>
                      </div>";
                    }
                    else{
                      $sql2 = "SELECT * FROM encheres WHERE ID_Items LIKE  '$tmp' ";

                      $result2 = mysqli_query($conn, $sql2);

                      while ($data = mysqli_fetch_assoc($result2)) 
                      {
                        $id_date_fin_enchere = $data['Date_fin'];
                      }
                      

                      echo "<h4>Date de fin : " . $id_date_fin_enchere . "</h4><br>";
                      
                      echo "<div>
                                <div>
                                  <h4>Statut :</h4>
                                </div>
                                <div>
                                  <h3 style='color: green;'>Enchère en cours</h3>
                                </div>
                              </div>";
                    }

                  }
                }
                  
            }

            if ($data['TypeVente1'] == 'achat_direct' ) 
            {
              $type_achat="achat_direct";
              echo "<div>
                        <div>
                          <h4>Statut :</h4>
                    
                        </div>
                        <div>
                          <h3 style='color: green;'>Achat Direct en cours</h3>
                        </div>
                      </div>";
                       echo "<form action='../Paiement/commandeP1.php' method='post'>
                      <input type='hidden' value='achat_direct' name='type_achat'>
                 <button type='submit' name='Acheter_btn' class='btn btn-primary' value='".$id_item."' >Acheter </button> 
                 </form>";
            }
            if ($data['TypeVente1'] == 'Offres' ) 
            {


                $sql2 = "SELECT * FROM offres WHERE ID_items =   '".$tmp."' ";

                $result2 = mysqli_query($conn, $sql2);

                $data2 = mysqli_fetch_assoc($result2);

                $round=$data2['Round'];
                  
                $decompte = '5'-$round;

              echo "<h6>Round : " . $round . ". Il en reste : " . $decompte . "</h6>";
              echo "<h4>Statut :</h4>
                    <h3 style='color: green;'>Offre en cours</h3>";

                $sql3 = "SELECT * FROM offres WHERE ID_items =   '".$tmp."' ";

                $result3 = mysqli_query($conn, $sql3);

                $data3 = mysqli_fetch_assoc($result3);

                $id_vendeur=$data3['ID_vendeur'];
                echo $id_vendeur;

                $sql4 = "SELECT * FROM vendeur WHERE ID =  '".$id_vendeur."' ";

                $result4 = mysqli_query($conn, $sql4);

                $data4 = mysqli_fetch_assoc($result4);

                $nom_vendeur=$data4['Nom'];

                $sql5="SELECT * FROM panier 
                LEFT JOIN offres
                ON offres.ID_items=panier.ID_item  
                WHERE offres.ID_vendeur='".$id_vendeur."' AND offres.Changement=0 AND offres.ID_items='".$tmp."' ";
                $result5=mysqli_query($conn,$sql5);
               
                if ($result5) {
                  echo "Pas de retour sur votre offre pour le moment";
                }
                else{
                  $sql6 = "SELECT * FROM offres WHERE ID_items =  '".$tmp."' ";

                  $result6 = mysqli_query($conn, $sql6);

                  $data6 = mysqli_fetch_assoc($result6);

                  $montant=$data6['Montant'];

                  echo "<table>
                          </tr>
                            <td>Derniere offre de " . $nom_vendeur . " : <strong>" . $montant . " euros  </strong></td>
                            <td><button type='button' name='accept_offre'>Accepter l'offre</button></td>
                          </tr>
                        </table>";

              /*    echo "<form action='../fonctionsPaiement/actionsClient.php' method='post'>;
                          <table>
                            </tr>
                              <td><p>Nouvelle Offre : </p></td>
                                <td><input type='text' name='nouvelle_offre'></input></td>
                                <td><button type='submit' name='type_achat' value='Offre'>Envoyez la contre-offre</button></td>
                            </tr>
                          </table>
                        </form>";*/
                }
                  


            }

            if ($data['TypeVente2'] == 'achat_direct' ) 
            {
              echo "<br><br><h2>" . $data['TypeVente2'] . "</h2>";
              $type_achat="achat_direct";
              echo "<div>
                        <div>
                          <h4>Statut :</h4>
                        </div>
                        <div>
                          <h3 style='color: green;'>Achat Direct en cours</h3>
                        </div>
                      </div>";
                      echo "<form action='../Paiement/commandeP1.php' method='post'>
                      <input type='hidden' value='achat_direct' name='type_achat'>
                 <button type='submit' name='Acheter_btn' class='btn btn-primary' value='".$id_item."' >Acheter </button> 
                 </form>";
            }

            echo "</div>";
            echo"<form action='../Categorie/Fiche_item.php' method='post'>";//lien vers la page fiche item
                echo "<button class='btn btn-primary' type='submit' name='bouton' value='".$id_item."'>Aller sur la page de l'item</button>";
            echo "</form>";
            
                  


        echo "</div>";
        }

      }
    }
  }

?>

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