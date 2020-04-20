<?php
	session_start();
?>

<!------CODE POUR METTRE UN ITEM DANS LE PANIER-------------------->

<?php
	
	$id_item= isset($_POST['bouton'])? $_POST['bouton'] : "";
	echo $id_item;

	$conn=mysqli_connect('localhost','root','','ece_ebay');

	if (!$conn) {
		echo "Erreur de connexion à la bdd";
	}
	else{
		$sql="SELECT * FROM panier WHERE ID_acheteur='".$_SESSION['user_id']."' AND ID_items='".$id_item."' ";
		$result=mysqli_query($conn,$sql);

		if (mysqli_num_rows($result)==0) {
			$sql= " INSERT INTO panier VALUES('".$_SESSION['user_id']."', '".$id_item."') ";
			$result=mysqli_query($conn,$sql);

			if (!$result) {
				//METTRE DU JAVASCRIPT POUR AFFICHER UN ALERT
				echo "Nous n'avons pas pu ajouter cet item à votre panier, veuillez réessayer";
			}
			else{
				//METTRE DU JAVASCRIPT
				echo "Item ajouté à votre panier !";
				header('Location: monPanier.php');
			}
		}
		else
			echo "Cet item est déjà dans votre panier";
	}
?>

<!--------------------------AFFICHER DANS LE PANIER QUE L'ENCHERE EST REMPORTEE------------------------------
<?php /*
	$conn=mysqli_connect('localhost','root','','ece_ebay');

	if (!$conn) {
		echo "Erreur de connexion à la bdd";
	}
	else{
		$sql="SELECT bid.ID_encheres id_enchere, encheres.Statut statut_enchere 
				FROM bid
				LEFT JOIN encheres
				ON bid.ID_encheres = encheres.ID
				WHERE bid.ID_acheteurs='".$_SESSION['user_id']."' ";

		$result=mysqli_query($conn,$sql);

		if (mysqli_num_rows($result)!=0) {
			while ($data=mysqli_fetch_assoc($result)) {
				$statut=$data['statut_enchere'];
			}
			if ($statut==1) {
				//ENCHERE REMPORTEE, IL DOIT POUVOIR PAYER -> IMPLIQUE AFFICHAGE DANS PANIER
			}

		}
	}*/
?>
-->