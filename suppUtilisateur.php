<?php
	session_start();
?>

<?php


	$id_button= isset($_POST["bouton"])? $_POST["bouton"] : "";
	echo$id_button;
/*--------------------------------------------Debut du PHP------------------------------------------------------*/

	$database = "ece_ebay";

	$conn=mysqli_connect('localhost:3308','root','','ece_ebay');
				

	if (!$conn) {
		echo "Erreur de connexion a la bdd";
	}
	else{

						$sql2 = "SELECT * FROM items WHERE ID_Vendeur='$id_button'";
						$result2 = mysqli_query($conn, $sql2);

						$data= mysqli_fetch_assoc($result2);
       					$compteur = mysqli_num_rows($result2);
       					echo "compteur :" .$compteur. "<br>";
						$id_item= $data['ID'];

						echo $id_item;
						if (!$data) {
							$sql= "DELETE  FROM vendeur WHERE ID = '$id_button' ";
							$result = mysqli_query($conn, $sql);
							echo $id_button;
							if (!$result) {
								echo "6";
							}
						}
						else 
						    {
						      for ($i=0; $i < $compteur ; $i++) { 
							echo "voici l'id_item que jai recoonu : " .$id_item;
							echo "<br>je trouve un item du vendeur selectiionné<br>";
						
							$sql56= " SELECT * FROM items WHERE ID= '".$id_item."' " ;

			                    $result56=mysqli_query($conn, $sql56);

			                    $data2 = mysqli_fetch_assoc($result56);

			                    $type_achat = $data2['TypeVente1'];

			                    echo $type_achat;


					                    if ($type_achat=="achat_direct") {
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
					                          $sql= "DELETE  FROM vendeur WHERE ID = '$id_button' ";
												$result = mysqli_query($conn, $sql);
												echo $id_button;
												if (!$result) {
													echo "6";
												}
												else
												{
					                          		header('Location: utilisateur.php');
												}
					                        }
					                      }
					                    }

					                  elseif ($type_achat=="encheres") {
					                    $sql56= " SELECT * FROM encheres WHERE ID_items= '".$id_item."' " ;

					                    $result56=mysqli_query($conn, $sql56);

					                    $data2 = mysqli_fetch_assoc($result56);

					                    $id_enchere = $data2['ID'];

					                    echo $id_enchere;
					                    echo "<br><br>";

					                      $sql9="DELETE FROM bid WHERE ID_encheres='".$id_enchere."' ";
					                      $result9=mysqli_query($conn,$sql9);
					                      echo $id_enchere;
					                      echo "<br>je suis ici";
					                      if (!$result9) {

					                        echo "erreur dans la suppression de l'article dans la table bid <br>";
					                      }

					                    else{
					                      $sql8="DELETE FROM encheres WHERE ID_items='".$id_item."' ";
					                      $result8=mysqli_query($conn,$sql8);
					                      echo $id_item;
					                      echo "<br>me voila<br>";

					                      if (!$result8) {
					                        echo "erreur dans la suppression de l'article dans la table encheres <br>";
					                      }
					                        else{
					                        $sql28="DELETE FROM achat_direct WHERE ID_items='".$id_item."' ";
					                        $result28=mysqli_query($conn,$sql28);
					                        echo $id_item;
					                        echo "<br>me revoilouvoila<br>";

					                        if (!$result28) {
					                          echo "erreur dans la suppression de l'article dans la table achat_direct <br>";
					                        }
					                        else{
					                          $sql10="DELETE FROM items WHERE ID='".$id_item."' ";
					                          $result10=mysqli_query($conn,$sql10);
					                          echo $id_item;
					                          echo "<br>encore moi<br>";

					                          if (!$result10) {
					                            echo "erreur dans la suppression de l'article dans la table items <br>";
					                          }
					                          else
					                          {
					                          	echo "article successfully enlevé";
					                          	$sql= "DELETE  FROM vendeur WHERE ID = '$id_button' ";
												$result = mysqli_query($conn, $sql);
												echo $id_button;
												if (!$result) {
													echo "6";
												}
												else
												{
					                          		header('Location: utilisateur.php');
												}
					                          }
					                        }
					                      }
					                    } 
					                   }
					                  elseif ($type_achat=="offres") {
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
					                          header('Location: utilisateur.php');
					                        }
					                        else
					                        {
					                        	echo "article successfully enlevé";
					                          	$sql= "DELETE  FROM vendeur WHERE ID = '$id_button' ";
												$result = mysqli_query($conn, $sql);
												echo $id_button;
												if (!$result) {
													echo "6";
												}
												else
												{
					                          		header('Location: utilisateur.php');
												}
					                        }
					                      }
					                    }
							}
			}//header("Location: http://localhost/Projet_Piscine_Ing3/comptes/Utilisateurs.php");
		}


?>