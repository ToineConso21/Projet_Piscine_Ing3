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
	$code_postal= isset($_POST["code_postal"])? $_POST["code_postal"] : "";
	$ville=isset($_POST["ville"])? $_POST["ville"] : "";
	$pays= isset($_POST["pays"])? $_POST["pays"] : "";
	$tel= isset($_POST["tel"])? $_POST["tel"] : "";

	$type_de_carte= isset($_POST["type_de_carte"])? $_POST["type_de_carte"] : "";
	$num_carte=isset($_POST["num_carte"])? $_POST["num_carte"] : "";
	$nom_titulaire= isset($_POST["nom_titulaire"])? $_POST["nom_titulaire"] : "";
	$date_exp= isset($_POST["date_exp"])? $_POST["date_exp"] : "";
	$num_secu=isset($_POST["num_secu"])? $_POST["num_secu"] : "";

/*--------------------------------------------Debut du PHP------------------------------------------------------*/

	$database = "ece_ebay";

	$conn=mysqli_connect('localhost:3308','root','','ece_ebay');

	if (!$conn) {
		echo "Erreur de connexion a la bdd";
	}
	else{
		if ($_POST['creation_acheteur']) 
		{
			if ($mdp == $mdp2) {

				$date = new DateTime($date_exp);
				$date_exp_final = $date->format('y/m/d');

				$sql = " INSERT INTO acheteurs (Nom, Prenom, Email, Mdp, Adresse1, Adresse2, Ville, Code_Postal, Pays, Tel, Type_paiement, Num_carte, Nom_carte, Date_exp, Code) 
VALUES ('$nom_acheteur', '$prenom_acheteur', '$email_acheteur', '$mdp', '$adresse1', '$adresse2', '$ville', '$code_postal', '$pays', '$tel', '$type_de_carte', '$num_carte', '$nom_titulaire', '$date_exp_final', '$num_secu')";

				$result=mysqli_query($conn,$sql);
				if ($result==1) {
						echo "Votre compte Acheteur a bien été crée !";
						header("Location: http://localhost/Projet_Piscine_Ing3/Accueil.php");

				}
				else
						echo "CHEH";
			}
			else
				echo "Vueillez mettre un bon mot de passe ! votre mot de passe n'est pas identique !";

		}
	}

?>