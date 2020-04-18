<?php
session_start();
?>
<!-------------------------PARTIE DE LA NEGOCIATION LIEE AU VENDEUR------------->

<!--PARTIE DU CODE QUI DEVRAIT ALLER DANS VENDRE.PHP
SERT A AFFICHER DANS SA LISTE D'ITEMS MIS EN VENTE,
LESQUELS ONT RECU DES OFFRES DE NEGOCIATION
/!\REMARQUE/!\: S'APPLIQUE AUSSI AU PANIER DU CLIENT-->

<?php
	$conn=mysqli_connect('localhost','root','','ece_ebay');

	if (!$conn) {
		echo "Erreur de connexion à la base de données";
	}
	else{
		$sql="SELECT * FROM offres WHERE ID_vendeur='".$_SESSION['user_id']."' AND Changement=true ";
		$result=mysqli_query($conn,$sql);

		if (mysqli_num_rows($result)==0) {
			echo "Pas de nouvelle offre reçue pour le moment";
		}
		else{
			//AFFICHER DANS LA PAGE VENDRE LES CHANGEMENTS 
			//AJOUTER DES BOUTONS 'ACCEPTER' ET 'REFUSER' A COTE DE L'ITEM
		}
	}
?>
<!---------------------------------------------------------------->

<!--------------NEGOCIATION AVEC UN CLIENT------------------>

<?php
	$montant=isset($_POST["montant"])? $_POST["montant"] : "";
	$id_item=isset($_POST["id_item"])? $_POST["id_item"] : "";

	$conn=mysqli_connect('localhost','root','','ece_ebay');
	if (!$conn) {
		echo "Une erreur est suvenue... Veuillez réessayer plus tard";
	}
	else{
		if ($decision=="Refuser") {
		if (!$conn) {
		echo "Erreur de connexion à la base de données";
		}
		else{
			$sql="UPDATE offres SET Montant='".$montant."' WHERE ID_vendeur='".$_SESSION['user_id']."' AND ID_items='".$id_item."' AND Changement=false ";
			$result=mysqli_fetch($conn,$sql);

			if (mysqli_num_rows($result)==0) {
				echo "La contre-offre n'a pas pu être envoyée. Réessayez";
			}
			else{
				echo "Votre contre-offre a été envoyée !";
			}
		}
	}
	elseif ($decision=="Accepter") {
		$sql="UPDATE offres SET Decision='".$decision."' WHERE ID_items='".$id_item."' AND ID_vendeur='".$_SESSION['user_id']."' ";
		$result=mysqli_query($conn,$sql);

		if (!$result) {
			echo "Erreur, Decision non prise";
		}
		else
			echo "TUDO BEM";
	}
	}
	
	
?>