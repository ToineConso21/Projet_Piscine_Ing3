
<?php
	session_start();

?>

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
					$_SESSION['user_id']=$login;
					$_SESSION['user_type']=$statut;
					header("Location: http://localhost/Projet_Piscine_Ing3/Accueil.php");
				}
		}

		if ($statut=="Vendeur") {
			$sql="SELECT * FROM vendeur WHERE Pseudo = '".$login."' AND  Email = '".$mdp."'";

			$result=mysqli_query($conn,$sql);

				if (mysqli_num_rows($result)==0) {
					echo "Identifiant ou Mot de passe incorrects";
				}

				else{
					$_SESSION['user_login']=$login;
					$_SESSION['user_type']=$statut;
					$_SESSION['user_email']=$mdp;

					while ($data=mysqli_fetch_assoc($result)) {
						$_SESSION['user_id']=$data['ID'];
						$_SESSION['user_nom']=$data['Nom'];
						$_SESSION['user_Prenom']=$data['Prenom'];
						$_SESSION['user_pdp']=$data['Pdp'];
						$_SESSION['user_imageFond']=$data['Image'];
						}
					header("Location: http://localhost/Projet_Piscine_Ing3/Accueil.php");
				}
		}

		if ($statut=="Acheteur") {
			$sql="SELECT * FROM acheteurs WHERE Email = '".$login."' AND  Mdp = '".$mdp."'";

			$result=mysqli_query($conn,$sql);

				if (mysqli_num_rows($result)==0) {
					echo "Identifiant ou Mot de passe incorrects";
				}

				else{

					$_SESSION['user_login']=$login;
					$_SESSION['user_type']=$statut;

					while ($data=mysqli_fetch_assoc($result)) {
						$_SESSION['user_id']=$data['ID'];
						$_SESSION['user_nom']=$data['Nom'];
						$_SESSION['user_Prenom']=$data['Prenom'];
						$_SESSION['user_Email']=$data['Email'];
						$_SESSION['user_Adresse1']=$data['Adresse1'];
						$_SESSION['user_Adresse2']=$data['Adresse2'];
						$_SESSION['user_Ville']=$data['Ville'];
						$_SESSION['user_CP']=$data['Code_Postal'];
						$_SESSION['user_Pays']=$data['Pays'];
						$_SESSION['user_Tel']=$data['Tel'];
						$_SESSION['user_Pay']=$data['Type_paiement'];
						$_SESSION['user_numCard']=$data['Num_carte'];
						$_SESSION['user_nomCard']=$data['Nom_carte'];
						$_SESSION['user_dateExp']=$data['date_exp'];
						$_SESSION['user_cardCode']=$data['Code'];
						}

					header("Location: http://localhost/Projet_Piscine_Ing3/Accueil.php");
					
				}
		}
	}
?>