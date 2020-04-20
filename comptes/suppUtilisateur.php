
<?php
	session_start();
?>

<?php


	$id_button= isset($_POST["bouton"])? $_POST["bouton"] : "";
	echo$id_button;
/*--------------------------------------------Debut du PHP------------------------------------------------------*/

	$database = "ece_ebay";

	$conn=mysqli_connect('localhost','root','','ece_ebay');
				

	if (!$conn) {
		echo "Erreur de connexion a la bdd";
	}
	else{

						$sql2 = "SELECT * FROM items WHERE ID_Vendeur='$id_button'";
						$result2 = mysqli_query($conn, $sql2);
						
						
						if (!$result2) {
							echo "1";
						}
						else
						{
							echo "oui1";
						}
						$data= mysqli_fetch_assoc($result2);

						$sql3="SELECT * FROM bid
			                LEFT JOIN encheres
			                ON encheres.ID_items=Bid.ID_encheres  
			                WHERE encheres.ID_items='".$data['ID']."'";
			                $result3 = mysqli_query($conn, $sql3);
						$data2= mysqli_fetch_assoc($result3);
						echo$data2['ID_encheres'];
			                if (!$result3) {
			                	echo"1";
						}
			  
						else
						{
							echo "oui1";
						}
						

						$sql= "DELETE  FROM offres WHERE ID_items = '".$data['ID']."' ";
						$result = mysqli_query($conn, $sql);
						
						if (!$result) {
							echo "2";
						}
						else
						{
							echo "oui2";
						}

						$sql= "DELETE  FROM achat_direct WHERE ID_items = '".$data['ID']."' ";
						$result = mysqli_query($conn, $sql);
						
						if (!$result) {
							echo "3";
						}
						else
						{
							echo "oui3";
						}

						$sql= "DELETE  FROM bid WHERE ID_encheres = '".$data2['ID_encheres']."' ";
						$result = mysqli_query($conn, $sql);
						
						if (!$result) {
							echo "4";
						}
						else
						{
							echo"oui4";
						}

						$sql= "DELETE  FROM encheres WHERE ID_items = '".$data['ID']."' ";
						$result = mysqli_query($conn, $sql);
						
						if (!$result) {
							echo "4";
						}
						else
						{
							echo"oui4";
						}



						$sql= "DELETE  FROM items WHERE ID_Vendeur ='$id_button'";
						$result = mysqli_query($conn, $sql);
						
						if (!$result) {
							echo "5";
						}
						else
						{
							echo "oui5";
						}
						
						$sql= "DELETE  FROM vendeur WHERE ID = '$id_button' ";
						$result = mysqli_query($conn, $sql);
						echo $id_button;
						if (!$result) {
							echo "6";
						}
						else
						{
							echo "oui6";
						}

			//header("Location: http://localhost/Projet_Piscine_Ing3/comptes/Utilisateurs.php");
		}


?>