<?php
	$login= isset($_POST["login"])? $_POST["login"] : "";
	$mdp= isset($_POST["mdp"])? $_POST["mdp"] : "";
	$statut=isset($_POST["statut"])? $_POST["statut"] : "";

	$conn=mysqli_connect('localhost','root','','ece_ebay');

	if (!$conn) {
		echo "Erreur de connexion a la bdd";
	}
	else{
		if ($statut=="Admin") {
			$sql="SELECT Pseudo, Mdp FROM admin WHERE Pseudo = '".$login."' AND  Mdp = '".$mdp."'";

			$result=mysqli_query($conn,$sql);

				if (mysqli_num_rows($result)==0) {
					echo "Identifiant ou Mot de passe incorrects";
				}

				else{
					echo "Bienvenue ".$login;
					header("Location: http://localhost/Projet_Piscine_Ing3/Accueil.html");
				}
		}

		if ($statut=="Vendeur") {
			$sql="SELECT Pseudo, Email FROM vendeur WHERE Pseudo = '".$login."' AND  Email = '".$mdp."'";

			$result=mysqli_query($conn,$sql);

				if (mysqli_num_rows($result)==0) {
					echo "Identifiant ou Mot de passe incorrects";
				}

				else{
					echo "Bienvenue ".$login;

					header("Location: http://localhost/Projet_Piscine_Ing3/Accueil.html");
				}
		}

		if ($statut=="Acheteur") {
			$sql="SELECT Email, Mdp FROM acheteurs WHERE Email = '".$login."' AND  Mdp = '".$mdp."'";

			$result=mysqli_query($conn,$sql);

				if (mysqli_num_rows($result)==0) {
					echo "Identifiant ou Mot de passe incorrects";
				}

				else{
					echo "Bienvenue ".$login;

					header("Location: http://localhost/Projet_Piscine_Ing3/Accueil.html");
				}
		}
	}
?>