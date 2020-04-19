<?php
  session_start();
?>

<?php
  $type_de_carte= isset($_POST["type_de_carte"])? $_POST["type_de_carte"] : "";
  $num_carte=isset($_POST["num_carte"])? $_POST["num_carte"] : "";
  $nom_titulaire= isset($_POST["nom_titulaire"])? $_POST["nom_titulaire"] : "";
  $date_exp= isset($_POST["date_exp"])? $_POST["date_exp"] : "";
  $num_secu=isset($_POST["num_secu"])? $_POST["num_secu"] : "";

  $conn=mysqli_connect('localhost:3308','root','','ece_ebay');
  $id_item = isset($_POST["Valider_btn"])? $_POST["Valider_btn"] : "";


  if (!$conn) {
    echo "Erreur de connexion a la bdd";
  }
  else{
          //ON VERIFIE SI L'ARTICLE EXISTE
        $sql="SELECT Prix FROM achat_direct WHERE ID_Items='".$id_item."' ";

        $result=mysqli_query($conn,$sql);

        if (mysqli_num_rows($result)==0) {
          echo "Une erreur ALLLERRRest survenue... Veuillez réessayer plus tard";
        }
        //ON VERIFIIE LES COORDONNEES BANCAIRES
        else{
          echo $id_item;
          echo "<br><br>";

          $sql2="SELECT Type_paiement, Num_carte, Nom_carte, Date_exp, Code, Solde FROM acheteurs WHERE ID='".$_SESSION['user_id']."' ";
          $result2=mysqli_query($conn,$sql2);

          if (mysqli_num_rows($result2)==0) {
            echo "Les informations entrées ne correspondent pas à celles enregistrées de votre compte. Veuillez les mettre à jour ou entrez de nouveau les informations";
            //PAGE DE REFUT DE PAIEMENT
            header('Location: paiementRefuse.php');
          }

          else{
            $sql3="SELECT Solde FROM acheteurs WHERE ID='".$_SESSION['user_id']."' ";

            $result3=mysqli_query($conn,$sql3);

            if (mysqli_num_rows($result3)==0) {
                        echo "iciC'estIci";
              echo "Une erreur est survenue... Veuillez réessayer plus tard";
            }
            
            else{
                echo $_SESSION['user_Solde'];
                echo "<br><br>";
                echo $_SESSION['user_id'];
                echo "<br><br>";


              //SOLDE PLUS PETIT QUE LE PRIX, PAIEMENT REFUSE
              $sql4="SELECT * FROM achat_direct WHERE ID_Items='".$id_item."' ";

              $result4=mysqli_query($conn, $sql4);

              $data = mysqli_fetch_assoc($result4);

              $prix_item = $data['Prix'];

              echo $prix_item;

              if ($prix_item>$_SESSION['user_Solde']) {
                echo "Paiement refusé";
                //header('Location: paiementRefuse.php');
              }
            
              else
              {
                $_SESSION['user_Solde'] = $_SESSION['user_Solde'] - $prix_item;

                $sql5="UPDATE acheteurs SET Solde='".$_SESSION['user_Solde']."' WHERE ID='".$_SESSION['user_id']."'  ";
                $result5=mysqli_query($conn,$sql5);

                if (!$result5) {
                  echo "Solde non débité";
                }
                else
                {
                    echo "Solde débité";
                    header('Location: paiementAccepte.php');
                    //ON EFFACE L'ARTICLE ?
/*
                    $sql56="SELECT * FROM achat_direct WHERE ID_Items='".$id_item."' ";

                    $result56=mysqli_query($conn, $sql56);

                    $data = mysqli_fetch_assoc($result56);

                    $type_achat = $data['Prix'];

                    echo $type_achat;



                    if ($type_achat=="Achat_im") {
                      $sql6="DELETE FROM achat_direct WHERE ID_Items='".$id_item."' ";
                      $result6=mysqli_query($conn,$sql6);

                      if (!$result6) {
                        echo "erreur dans la suppression de l'article dans la table achat_direct <br>";
                      }
                      else{
                        $sql7="DELETE FROM items WHERE ID='".$id_item."' ";
                        $result7=mysqli_query($conn,$sql7);

                        if (!$result7) {
                          echo "erreur dans la suppression de l'article dans la table items <br>";
                        }
                        else{
                          echo "article successfully enlevé";
                          header('Location: paiementAccepte.php');
                        }
                      }
                    }

                  elseif ($type_achat=="Enchere") {
                    $sql8="DELETE FROM encheres WHERE ID_items='".$id_item."' ";
                    $result8=mysqli_query($conn,$sql8);

                    if (!$result8) {
                      echo "erreur dans la suppression de l'article dans la table encheres <br>";
                    }
                    else{
                      $sql9="DELETE FROM bid WHERE ID_items='".$id_item."' ";
                      $result9=mysqli_query($conn,$sql9);

                      if (!$result9) {
                        echo "erreur dans la suppression de l'article dans la table items <br>";
                      }
                      else{
                        $sql10="DELETE FROM items WHERE ID='".$id_item."' ";
                        $result10=mysqli_query($conn,$sql10);

                        if ($result10) {
                          header('Location: paiementAccepte.php');
                        }
                      }
                    }
                  }

                  elseif ($type_achat=="Offre") {
                    $sql11="DELETE FROM offres WHERE ID_items='".$id_item."' ";
                    $result11=mysqli_query($conn,$sql11);

                    if (!$result11) {
                      echo "erreur dans la suppression de l'article dans la table offres <br>";
                    }
                    else{
                        $sql12="DELETE FROM items WHERE ID='".$id_item."' ";
                        $result12=mysqli_query($conn,$sql12);

                        if ($result12) {
                          echo "Item supprimé";
                          header('Location: paiementAccepte.php');
                        }
                      }
                    }*/
                }
                  
                
              }

            }
          }
        }
        }
        
      
?>