<?php
  session_start();
?>

<?php
  $type_de_carte= isset($_POST["type_de_carte"])? $_POST["type_de_carte"] : "";
  $num_carte=isset($_POST["num_carte"])? $_POST["num_carte"] : "";
  $nom_titulaire= isset($_POST["nom_titulaire"])? $_POST["nom_titulaire"] : "";
  $date_exp= isset($_POST["date_exp"])? $_POST["date_exp"] : "";
  $num_secu=isset($_POST["num_secu"])? $_POST["num_secu"] : "";

  $conn=mysqli_connect('localhost','root','','ece_ebay');

  if (!$conn) {
    echo "Erreur de connexion a la bdd";
  }
  else{
          //ON VERIFIE SI L'ARTICLE EXISTE
        $sql="SELECT Prix FROM achat_direct WHERE ID_Items='".$id_item."' ";

        $result=mysqli_query($conn,$sql);

        if (mysqli_num_rows($result)==0) {
          echo "Une erreur est survenue... Veuillez réessayer plus tard";
        }
        //ON VERIFIIE LES COORDONNEES BANCAIRES
        else{
          $sql="SELECT Type_paiement, Num_carte, Nom_carte, Date_exp, Code, Solde FROM acheteurs WHERE ID='".$_SESSION['user_id']."' ";
          $result=mysqli_query($conn,$sql);

          if (mysqli_num_rows($result)==0) {
            echo "Les informations entrées ne correspondent pas à celles enregistrées de votre compte. Veuillez les mettre à jour ou entrez de nouveau les informations";
            //PAGE DE REFUT DE PAIEMENT
            header('Location: paiementRefuse.php');
          }

          else{
            $sql="SELECT Solde FROM acheteurs WHERE ID='".$_SESSION['user_id']."' ";

            $result=mysqli_query($conn,$sql);

            if (mysqli_num_rows($result)==0) {
              echo "Une erreur est survenue... Veuillez réessayer plus tard";
            }
            
            else{
              //SOLDE PLUS PETIT QUE LE PRIX, PAIEMENT REFUSE
              if ($prix_item>$_SESSION['user_Solde']) {
                echo "Paiement refusé";
                header('Location: paiementRefuse.php');
              }
            
              else{
                $_SESSION['user_Solde'] = $_SESSION['user_Solde'] - $prix_item;

                $sql="UPDATE acheteurs SET Solde='".$_SESSION['user_Solde']."' WHERE ID='".$_SESSION['user_id']."'  ";
                $result=mysqli_query($conn,$sql);

                if (!$result) {
                  echo "Solde non débité";
                }
                else{
                    echo "Solde débité";
                    //ON EFFACE L'ARTICLE ?
                    if ($type_achat=="Achat_im") {
                      $sql="DELETE FROM achat_direct WHERE ID_Items='".$id_item."' ";
                      $result=mysqli_query($conn,$sql);

                      if (!$result) {
                        echo "erreur dans la suppression de l'article dans la table achat_direct <br>";
                      }
                      else{
                        $sql="DELETE FROM items WHERE ID='".$id_item."' ";
                        $result=mysqli_query($conn,$sql);

                        if (!$result) {
                          echo "erreur dans la suppression de l'article dans la table items <br>";
                        }
                        else{
                          echo "article successfully enlevé";
                          header('Location: paiementAccepte.php');
                        }
                      }
                    }

                  elseif ($type_achat=="Enchere") {
                    $sql="DELETE FROM encheres WHERE ID_items='".$id_item."' ";
                    $result=mysqli_query($conn,$sql);

                    if (!$result) {
                      echo "erreur dans la suppression de l'article dans la table encheres <br>";
                    }
                    else{
                      $sql="DELETE FROM bid WHERE ID_items='".$id_item."' ";
                      $result=mysqli_query($conn,$sql);

                      if (!$result) {
                        echo "erreur dans la suppression de l'article dans la table items <br>";
                      }
                      else{
                        $sql="DELETE FROM items WHERE ID='".$id_item."' ";
                        $result=mysqli_query($conn,$sql);

                        if ($result) {
                          header('Location: paiementAccepte.php');
                        }
                      }
                    }
                  }

                  elseif ($type_achat=="Offre") {
                    $sql="DELETE FROM offres WHERE ID_items='".$id_item."' ";
                    $result=mysqli_query($conn,$sql);

                    if (!$result) {
                      echo "erreur dans la suppression de l'article dans la table offres <br>";
                    }
                    else{
                        $sql="DELETE FROM items WHERE ID='".$id_item."' ";
                        $result=mysqli_query($conn,$sql);

                        if ($result) {
                          echo "Item supprimé";
                          header('Location: paiementAccepte.php');
                        }
                      }
                    }
                }
                  
                
              }

            }
          }
        }
        
        
      
?>