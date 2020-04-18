<?php
	session_start();
?>

<?php
	
	$id_item= isset($_POST["item"])? $_POST["item"] : "";

	$conn=mysqli_connect('localhost','root','','ece_ebay');

	if (!$conn) {
		echo "Erreur de connexion à la bdd";
	}
	else{
		$sql="SELECT * FROM panier WHERE ID_acheteur='".$_SESSION['user_id']."' ";
		$result=mysqli_query($conn,$sql);

		if (mysqli_num_rows($result)==0) {
			$sql="INSERT INTO panier VALUES('$_SESSION['user_id']','$id_item') ";
			$result=mysqli_query($conn,$sql);

			if (mysqli_num_rows($result)==0) {
				//METTRE DU JAVASCRIPT POUR AFFICHER UN ALERT
				echo "Nous n'avons pas pu ajouter cet item à votre panier, veuillez réessayer";
			}
			else{
				//METTRE DU JAVASCRIPT
				echo "Item ajouté à votre panier !";
			}
		}
		else
			echo "Cet item est déjà dans votre panier";
	}
?>