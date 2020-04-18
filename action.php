<?php
	session_start();
?>

<?php 
	/*TOUTES LES METHODES DE PAIEMENT SONT REGROUPEES ICI, 
	EN FAISANT UN ACHAT DIRECT, IL EST RENVOYE AUX PAGES CONFRIRMANT LA LIVRAISON
	ET MODE DE PAIEMENT AVANT D'ENVOYER LA REQUETE SQL POUR EFFECTUER L'ACHAT*/

	$id_item= 2;
	//isset($_POST["item"])? $_POST["item"] : "";

	//IL SELECTIONNE UNE METHODE D'ACHAT
	$type_achat= "Enchere"; 
	//isset($_POST["achat"])? $_POST["achat"] : "";

	$conn=mysqli_connect('localhost','root','','ece_ebay');

	if (!$conn) {
		echo "Erreur de connexion à la base de données";
	}
	else{
		if ($type_achat=="Achat_im") {
			//ON VERIFIE SI L'ARTICLE EXISTE
			$sql="SELECT Prix FROM achat_direct WHERE ID_Items='".$id_item."' ";

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
						echo $prix_item;
						echo $_SESSION['user_Solde'];
					}
					else{
						echo "Paiement accepté";
						//AFFICHER LE TRALALA
						$_SESSION['user_Solde'] = $_SESSION['user_Solde'] - $prix_item;

						$sql="UPDATE acheteurs SET Solde='".$_SESSION['user_Solde']."' WHERE ID='".$_SESSION['user_id']."'  ";
						$result=mysqli_query($conn,$sql);

						if (!$result) {
							echo "Solde non débité";
						}
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
						}
						echo "article successfully enlevé";
					}
				}

			}

		}


		elseif ($type_achat=="Enchere") {
			//ON SET LE MONTANT ET L'ID DE L'ENCHERE VIA UN POST
			 $montant=80;
			 //isset($_POST["montant"])? $_POST["montant"] : "";
			 $id_enchere=1;
			 //isset($_POST["item"])? $_POST["item"] : "";

			 //RECUPERER HEURE AUTOMATIQUEMENT CI-DESSOUS

			 //ON VERIFIE AVANT TOUT SI L'ACHETEUR N'A PAS DEJA FAIT UNE ENCHERE SUR LE MÊME ITEM, SINON... IL TRICHE
			 $sql="SELECT ID_encheres, ID_acheteurs FROM bid WHERE ID_acheteurs='".$_SESSION['user_id']."' AND ID_encheres='".$id_enchere."' ";
			 $result=mysqli_query($conn,$sql);

			 if (mysqli_num_rows($result)!=0) {
			 	echo "TRICHEUR !!";
			 }
			 else{
			 	//VERIFIER SI LE MONTANT DE L'ENCHERE EST SUPERIEUR 
			 //A CELUI DE DE L'ITEM
			 $sql="SELECT Prix FROM encheres WHERE ID='".$id_enchere."' ";
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
					 	echo "L'enchère a été prise en compte !";

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
					 			echo $montant;
					 		}

					 		if ($max_bid==$montant) {
					 			$sql="SELECT MAX(Montant) FROM bid WHERE Montant NOT IN (SELECT MAX(Montant) FROM bid) ";
							 	$result=mysqli_query($conn,$sql);

							 	if (mysqli_num_rows($result)==0) {
							 		echo "PROBLEME 3";
							 	}
							 	else{
							 		while ($data=mysqli_fetch_assoc($result)) {
							 			$old_max=$data['MAX(Montant)'];
							 		}

							 		//MISE A JOUR DU PRIX MINIMUM DU L'ENCHERE EN COURS
							 		$sql="UPDATE encheres SET Prix='".$old_max."'+1 WHERE ID='".$id_enchere."' ";
						 			$result=mysqli_query($conn,$sql);

						 			if (!$result) {
						 				echo "Erreur d'update de l'enchere";
						 			}
						 			else{
						 				echo "TOUT ROULE POTO";
						 			}
							 	}

					 		}
					 	}
					 }

			 	}
			 }
			 }
			
		}

		elseif ($type_achat=="Offre") {
			$sql="SELECT * FROM offres WHERE ID_items='".$id_item."' ";
			$result=mysqli_query($conn,$sql);

			if (mysqli_num_rows($result)==0) {
				echo "Une erreur est servenu... Veuillez réessayer plus tard";
			}
			else{
				while ($data=mysqli_fetch_assoc($result)) {
					$nbRounds=$data['Round'];
					}
				if ($nbRounds==5) {
					echo "Vous ne pouvez plus faire d'offres sur cet item";
				}
				else{
					$sql="INSERT INTO offres (ID_acheteurs,ID_vendeurs,ID_items,Round,Montant) 
					VALUES ('$_SESSION['user_id']', '$id_vendeur', '$id_item', '"$nbRounds".+1','$montant') ";
					$result=mysqli_query($conn,$sql);

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

	}
?>