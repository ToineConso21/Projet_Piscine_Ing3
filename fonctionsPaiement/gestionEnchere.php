<?php 
	$conn=mysqli_connect('localhost','root','','ece_ebay');
	date_default_timezone_set('France/Paris');
	$currentDate = date('m/d/Y h:i:s a', time());

	if (!$conn) {
		echo "Erreur de connexion au serveur";
	}
	else{
		$sql="SELECT * FROM encheres  ";
		$result=mysqli_query($conn,$sql);

		if (mysqli_num_rows($result)==0) {
			echo "Pas d'enchère";
		}
		else{
			while ($data=mysqli_fetch_assoc($result)) {
				$dateFin=$data['Date_fin'];
				$id_enchere=$data['ID'];

				if ($dateFin<=$currentDate) {
					$sql="SELECT * FROM bid WHERE ID_encheres='".$id_enchere."' ";
					$result=mysqli_query($conn,$sql);

					if (mysqli_num_rows($result)==0) {
						$sql="DELETE FROM encheres WHERE ID='".$id_enchere."' ";
						$result=mysqli_query($conn,$sql);

						if (!$result) {
							echo "Enchere non supprimée";
						}
					}
					else{
						$sql="UPDATE encheres SET Statut=1 WHERE ID_encheres='".$id_enchere."' ";
					}
				}
			}

		}
	}
?>