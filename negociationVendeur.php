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
	$decision = 'Accepte';
/*--------------------------------------------Debut du PHP------------------------------------------------------*/
	$id_acheteur = $_SESSION['user_id'];

	$database = "ece_ebay";

	$conn=mysqli_connect('localhost:3308','root','','ece_ebay');
				

	if (!$conn) {
		echo "Erreur de connexion a la bdd";
	}
	else
	{

		if ($_POST['Yes_offre_btn']) 
		{
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