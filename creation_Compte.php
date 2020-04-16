<?php
	session_start();
?>

<?php

/*------------------------------------------attributs d'un acheteur----------------------------------------------*/

	$email_acheteur = isset($_POST["email_acheteur"])? $_POST["email_acheteur"] : "";
	$mdp= isset($_POST["mdp"])? $_POST["mdp"] : "";
	$mdp2=isset($_POST["mdp2"])? $_POST["mdp2"] : "";

	$nom_acheteur= isset($_POST["nom_acheteur"])? $_POST["nom_acheteur"] : "";
	$prenom_acheteur= isset($_POST["prenom_acheteur"])? $_POST["prenom_acheteur"] : "";
	$adresse1=isset($_POST["adresse1"])? $_POST["adresse1"] : "";
	$adresse2= isset($_POST["adresse2"])? $_POST["adresse2"] : "";
	$code_postale= isset($_POST["code_postale"])? $_POST["code_postale"] : "";
	$ville=isset($_POST["ville"])? $_POST["ville"] : "";
	$pays= isset($_POST["pays"])? $_POST["pays"] : "";
	$tel= isset($_POST["tel"])? $_POST["tel"] : "";

	$type_de_carte= isset($_POST["type_de_carte"])? $_POST["type_de_carte"] : "";
	$num_carte=isset($_POST["num_carte"])? $_POST["num_carte"] : "";
	$nom_titulaire= isset($_POST["nom_titulaire"])? $_POST["nom_titulaire"] : "";
	$date_exp= isset($_POST["date_exp"])? $_POST["date_exp"] : "";
	$num_secu=isset($_POST["num_secu"])? $_POST["num_secu"] : "";

/*------------------------------------------attributs d'un vendeur----------------------------------------------*/

	$nom_utilisateur = isset($_POST["nom_utilisateur"])? $_POST["nom_utilisateur"] : "";
	$email_vendeur= isset($_POST["email_vendeur"])? $_POST["email_vendeur"] : "";

	$nom_vendeur= isset($_POST["nom_vendeur"])? $_POST["nom_vendeur"] : "";
	$prenom_vendeur= isset($_POST["prenom_vendeur"])? $_POST["prenom_vendeur"] : "";
	$photo_pdp=isset($_POST["photo_pdp"])? $_POST["photo_pdp"] : "";
	$photo_couverture= isset($_POST["photo_couverture"])? $_POST["photo_couverture"] : "";


/*--------------------------------------------Debut du PHP------------------------------------------------------*/


	$conn=mysqli_connect('localhost:3308','root','','ece_ebay');

	if (!$conn) {
		echo "Erreur de connexion a la bdd";
	}
	else{
		if ($_POST['creation_acheteur']) 
		{
			$sql = "INSERT INTO acheteurs(Nom, Prenom, Email, Adresse1, Adresse2, Ville, Code_Postal, Pays, Tel, Type_paiement, Num_carte, Nom_carte, Date_exp, Code) VALUES('$nom_acheteur', '$prenom_acheteur', '$email_acheteur', '$adresse1', '$adresse2', '$ville', '$code_postale', '$pays', '$tel', '$type_de_carte', '$num_carte', '$nom_titulaire', '$date_exp', '$num_secu')";
		}

		if ($_POST['creation_vendeur']) 
		{
			$sql = "INSERT INTO vendeur(Nom, Prenom, Pseudo, Email, Pdp, Image) VALUES('$nom_vendeur', '$prenom_vendeur', '$nom_utilisateur', '$photo_pdp', '$photo_couverture')";		
		}
		
	}
?>