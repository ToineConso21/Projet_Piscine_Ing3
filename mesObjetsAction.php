<?php
	session_start();
?>

<?php


	$id_button= isset($_POST["Supprimer_btn"])? $_POST["Supprimer_btn"] : "";

/*--------------------------------------------Debut du PHP------------------------------------------------------*/

	$database = "ece_ebay";

	$conn=mysqli_connect('localhost','root','','ece_ebay');
				echo $id_button;

	if (!$conn) {
		echo "Erreur de connexion a la bdd";
	}
	else{
			//$sql = "SELECT FROM items WHERE "
						echo $id_button;


						$sql= "DELETE  FROM offres WHERE ID_items = '$id_button' ";
						$result = mysqli_query($conn, $sql);
						echo $id_button;
						if (!$result) {
							echo "debile";
						}
						else
						{
							echo $id_button;
						}

						$sql= "DELETE  FROM achat_direct WHERE ID_items = '$id_button' ";
						$result = mysqli_query($conn, $sql);
						echo $id_button;
						if (!$result) {
							echo "debile";
						}
						else
						{
							echo $id_button;
						}

						$sql= "DELETE  FROM encheres WHERE ID_Items = '$id_button' ";
						$result = mysqli_query($conn, $sql);
						echo $id_button;
						if (!$result) {
							echo "debile";
						}
						else
						{
							echo $id_button;
						}

						$sql= "DELETE  FROM items WHERE ID = '$id_button' ";
						$result = mysqli_query($conn, $sql);
						echo $id_button;
						if (!$result) {
							echo "debile";
						}
						else
						{
							echo $id_button;
						}

			header("Location: http://localhost/Projet_Piscine_Ing3/mesObjets.php");
		}


?>