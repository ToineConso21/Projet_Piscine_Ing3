<?php
session_start();
?>

<!--PARTIE DU CODE QUI DEVRAIT ALLER DANS VENDRE.PHP-->
<?php
	$conn=mysqli_connect('localhost','root','','ece_ebay');

	if (!$conn) {
		echo "Erreur de connexion à la base de données";
	}
	else{
		$sql="SELECT * FROM offres WHERE ID_vendeur='".$_SESSION['user_id']."' AND Changement=true ";
		$result=mysqli_fetch($conn,$sql);

		if (mysqli_num_rows($result)==0) {
			echo "Pas de nouvelle offre reçue pour le moment";
		}
		else{
			//AFFICHER DANS LA PAGE VENDRE LES CHANGEMENTS 
			//AJOUTER DES BOUTONS 'ACCEPTER' ET 'REFUSER' A COTE DE L'ITEM
		}
	}
?>