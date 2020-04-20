<?php
	session_start();
?>

<?php 
	/*TOUTES LES METHODES DE PAIEMENT VENANT D'UN COMPTE CLIENT SONT REGROUPEES ICI, */

	
	//L'ITEM ACHETE EST RECUPERE
	$id_item= 2;
	//isset($_POST["item"])? $_POST["item"] : "";

	//LA METHODE D'ACHAT EST RECUPEREE
	$type_achat= isset($_POST["type_achat"])? $_POST["type_achat"] : ""; 
	//isset($_POST["methodeAchat"])? $_POST["methodeAchat"] : "";

	$conn=mysqli_connect('localhost:3308','root','','ece_ebay');

	if (!$conn) {
		echo "Erreur de connexion à la base de données";
	}
	else{
		/* if ($type_achat=="Achat_im") {
			/*EN FAISANT UN ACHAT DIRECT, IL EST RENVOYE AUX PAGES CONFRIRMANT LA LIVRAISON
			ET MODE DE PAIEMENT AVANT D'ENVOYER LA REQUETE SQL POUR EFFECTUER L'ACHAT*/

			//ON VERIFIE SI L'ARTICLE EXISTE
			/*$sql="SELECT Prix FROM achat_direct WHERE ID_Items='".$id_item."' ";

			$result=mysqli_query($conn,$sql);

			if (mysqli_num_rows($result)==0) {
				echo "Une erreur est survenue... Veuillez réessayer plus tard";
			}
			else{
				while ($data=mysqli_fetch_assoc($result)) {
					$prix_item=$data['Prix'];
				}

				$sql="SELECT Solde FROM acheteurs WHERE ID='".$_SESSION['user_id']."' ";

				$result=mysqli_query($conn,$sql);

				if (mysqli_num_rows($result)==0) {
					echo "Une erreur est survenue... Veuillez réessayer plus tard";
				}
				else{
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
							else
								echo "article successfully enlevé";
								header('Location: paiementAccepte.php');
							}
							
						}

					}
				}

			}

		}*/

/////////////////////////////////////////////////////////////////////

		if ($type_achat=="Enchere") {
			//ON SET LE MONTANT ET L'ID DE L'ENCHERE VIA UN POST
			 $montant=isset($_POST["montant"])? $_POST["montant"] : "";
			 //isset($_POST["montant"])? $_POST["montant"] : "";
			$_SESSION['id_item'];
			 //
			$sql="SELECT ID FROM encheres WHERE ID_items='".$_SESSION['id_item']."' ";
			$result=mysqli_query($conn,$sql);

			$data=mysqli_fetch_assoc($result);

			$id_enchere=$data['ID'];

			 //ON VERIFIE AVANT TOUT SI L'ACHETEUR N'A PAS DEJA FAIT UNE ENCHERE SUR LE MÊME ITEM, SINON... IL TRICHE
			 $sql="SELECT ID_encheres, ID_acheteurs FROM bid WHERE ID_acheteurs='".$_SESSION['user_id']."' AND ID_encheres='".$id_enchere."' ";
			 $result=mysqli_query($conn,$sql);

			 if (mysqli_num_rows($result)!=0) {
			 	echo "TRICHEUR !!";
			 }
			 else{
			 	//VERIFIER SI LE MONTANT DE L'ENCHERE EST SUPERIEUR 
			 //A CELUI DE DE L'ITEM
			 $sql="SELECT Prix Prix FROM encheres WHERE ID='".$id_enchere."' ";
			 $result=mysqli_query($conn,$sql);

			 if (mysqli_num_rows($result)==0) {
			 	echo "PROBLEME 1";
			 }
			 else{
			 	while ($data=mysqli_fetch_assoc($result)) {
			 		$prix_set=$data['Prix'];
			 	}
			 	if ($montant<=$prix_set) {
			 		echo "Votre proposition n'est pas valide, vous devez placer une offre supérieure au prix indiqué";
			 	}
			 	else{
			 		//PLACEMENT DE L'ENCHERE
			 		 $sql = " INSERT INTO bid (ID_encheres, ID_acheteurs, Montant) 
			 		 	VALUES('$id_enchere', '".$_SESSION['user_id']."','$montant') ";

					 $result=mysqli_query($conn,$sql);

					 if (!$result) {
					 	echo "L'enchère n'a pas pu être prise en compte";
					 }

					 else{
					 	echo "L'enchère a été prise en compte !<br>";

					 	//ON REGARDE SI C'EST LE PLUS HAUT ENCHERISSEUR
					 	$sql="SELECT MAX(Montant), ID_encheres, ID_acheteurs FROM bid WHERE ID_encheres='".$id_enchere."' ";
					 	$result=mysqli_query($conn,$sql);

					 	if (mysqli_num_rows($result)==0) {
					 		echo "PROBLEME 2";
					 	}
					 	else{
					 		while ($data=mysqli_fetch_assoc($result)) {
					 			echo "Max_bid:" .$data['MAX(Montant)'];
					 			$max_bid=$data['MAX(Montant)'];
					 			echo "<br>".$montant;
					 		}

					 		if ($max_bid==$montant) {
					 			$sql="SELECT MAX(Montant) FROM bid WHERE Montant NOT IN (SELECT MAX(Montant) FROM bid) AND ID_encheres='".$id_enchere."' ";
					 			$result=mysqli_query($conn,$sql);
					 			$data=mysqli_fetch_assoc($result);
					 			if ($data['MAX(Montant)']==NULL) {
					 				$sql="SELECT Prix FROM encheres WHERE ID='".$id_enchere."'";
					 				$result=mysqli_query($conn,$sql);
					 				$data=mysqli_fetch_assoc($result); 
					 					$old_max=$data['Prix'];
						 				$sql="UPDATE encheres SET Prix='".$old_max."'+1 WHERE ID='".$id_enchere."' ";
							 			$result=mysqli_query($conn,$sql);

							 			if (!$result) {
							 				echo "Erreur d'update de l'enchere";
							 			}
							 			else{
							 				echo "TOUT ROULE POTO";
							 			}
					 			}
					 			else{
					 			//MISE A JOUR DU PRIX MINIMUM DU L'ENCHERE EN COURS
					 					$old_max=$data['MAX(Montant)'];
								 		$sql="UPDATE encheres SET Prix='".$old_max."'+1 WHERE ID='".$id_enchere."' ";
							 			$result=mysqli_query($conn,$sql);

							 			if (!$result) {
							 				echo "Erreur d'update de l'enchere";
							 			}
							 			else{
							 				echo "TOUT ROULE POTO";
							 				header('Location: ../Accueil.php');
							 			}
					 				}
					 		}


					 			
						}

					 }
					 	}
					 }

			 	}
			 }
			 
			
		
/////////////////////////////////////////////////////////////////////

		//L'UTILISATEUR FAIT UNE OFFRE
		elseif ($type_achat=="Offre") {
			$montant=isset($_POST["nouvelle_offre"])? $_POST["nouvelle_offre"] : ""; 

			$sql="SELECT * FROM offres WHERE ID_items='".$id_item."' ";
			$result=mysqli_query($conn,$sql);

			if (mysqli_num_rows($result)==0) {
				echo "Une erreur est servenu... Veuillez réessayer plus tard";
			}
			//VERIFIE SI LE NOMBRE DE NEGOCIATIONS EST DE 5 OU PLUS
			else{
				while ($data=mysqli_fetch_assoc($result)) {
					$nbRounds=$data['Round'];
					}
				if ($nbRounds==5) {
					echo "Vous ne pouvez plus faire d'offres sur cet item";
				}
				//ENVOI DE L'OFFRE
				elseif($nbRounds==0){
					$sql="UPDATE offres SET ID_acheteurs='".$_SESSION['user_id']."' AND Round='".$nbRounds."'+1 Montant='".$montant."' AND Changement=true WHERE ID_items='".$id_item."' ";
					$result=mysqli_query($conn,$sql) ;

					if (!$result) {
						echo "L'offre n'a pas été enregistrée";
					}
					else{
						echo "Votre offre a été envoyée !";
					}
				}
				elseif ($nbRounds>=1) {
					$sql="UPDATE offres SET Round='".$nbRounds."'+1 Montant='".$montant."' AND Changement=true WHERE ID_items='".$id_item."'  ";
					$result=mysqli_query($conn,$sql) ;

					if (!$result) {
						echo "L'offre n'a pas été enregistrée";
					}
					else{
						echo "Votre offre a été envoyée !";
					}
				}
			}
			}
		}

	
?>