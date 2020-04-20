<?php
	session_start();
?>

<?php


	$offre_acheteur= isset($_POST["offre_acheteur"])? $_POST["offre_acheteur"] : "";
	echo $offre_acheteur;

	$id_du_vendeur= isset($_POST["id_du_vendeur"])? $_POST["id_du_vendeur"] : "";
	echo $id_du_vendeur;

  	$id_item = isset($_POST["Envoyez_btn"])? $_POST["Envoyez_btn"] : "";
	echo $id_item;

	$round = '0';
	$changement = '0';
	$decision = 'Refuse';
/*--------------------------------------------Debut du PHP------------------------------------------------------*/
	$id_acheteur = $_SESSION['user_id'];

	$database = "ece_ebay";

	$conn=mysqli_connect('localhost:3308','root','','ece_ebay');
				

	if (!$conn) {
		echo "Erreur de connexion a la bdd";
	}
	else
	{
		if ($_POST['Envoyez_btn']) 
		{
			$sql3 = " INSERT INTO offres (ID_acheteurs, ID_vendeur, ID_items, Round, Montant, Changement, Decision) 
			VALUES ('$id_acheteur', '$id_du_vendeur', '$id_item', '$round', '$offre_acheteur','$changement', '$decision')";
			$result3= mysqli_query($conn,$sql3);
			if (!$result3) {
				echo "fail";
			}
			else
			{
				echo "l'offre a bien été envoyé ! ";
			}

		}

	}

?>