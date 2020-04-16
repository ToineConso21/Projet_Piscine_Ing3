<?php
	session_start();
?>

<?php

/*------------------------------------------attributs d'un vendeur----------------------------------------------*/

	$nom_utilisateur = isset($_POST["nom_utilisateur"])? $_POST["nom_utilisateur"] : "";
	$email_vendeur= isset($_POST["email_vendeur"])? $_POST["email_vendeur"] : "";
	$nom_vendeur= isset($_POST["nom_vendeur"])? $_POST["nom_vendeur"] : "";
	$prenom_vendeur= isset($_POST["prenom_vendeur"])? $_POST["prenom_vendeur"] : "";

	$photo_pdp=isset($_POST["photo_pdp"])? $_POST["photo_pdp"] : "";

	$photo_couverture= isset($_POST["photo_couverture"])? $_POST["photo_couverture"] : "";


/*--------------------------------------------Debut du PHP------------------------------------------------------*/

	$database = "ece_ebay";

	$conn=mysqli_connect('localhost:3308','root','','ece_ebay');

	if (!$conn) {
		echo "Erreur de connexion a la bdd";
	}
	else{

		if ($_POST['creation_vendeur']) 
		{
			$sql = " INSERT INTO vendeur (Nom, Prenom, Pseudo, Email, Pdp, Image) VALUES('$nom_vendeur', '$prenom_vendeur', '$nom_utilisateur','$email_vendeur  '$photo_pdp', '$photo_couverture')
			 ";		
			$result=mysqli_query($conn,$sql);
				if (mysqli_num_rows($result)==0) {
					echo "Identifiant ou Mot de passe incorrects";
				}

				else{
					echo "Votre Compte à bien été créé !" . "<br>" ;

				}

		}
		
	}
?>