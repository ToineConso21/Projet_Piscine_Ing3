<?php
	session_start();
?>

<?php

/*------------------------------------------attributs d'un objet----------------------------------------------*/

	$nom_objet = isset($_POST["nom_objet"])? $_POST["nom_objet"] : "";
	$description_objet= isset($_POST["description_objet"])? $_POST["description_objet"] : "";
	$photo_objet= isset($_POST["photo_objet"])? $_POST["photo_objet"] : "";
	$video_objet=isset($_POST["video_objet"])? $_POST["video_objet"] : "";
	$categorie_objet= isset($_POST["categorie_objet"])? $_POST["categorie_objet"] : "";

	$prix_min=isset($_POST["prix_min"])? $_POST["prix_min"] : "";
	$debut_enchère=isset($_POST["debut_enchère"])? $_POST["debut_enchère"] : "";

	$fin_enchere=isset($_POST["fin_enchere"])? $_POST["fin_enchere"] : "";
	
	$prix_init=isset($_POST["prix_init"])? $_POST["prix_init"] : "";

	$prix_fixe=isset($_POST["prix_fixe"])? $_POST["prix_fixe"] : "";

	$id_vendeur=$_SESSION['user_id'];

	$statut = '1';
	$round = '0';
	$id_acheteur = '0';

/*--------------------------------------------Debut du PHP------------------------------------------------------*/

	$database = "ece_ebay";

	$conn=mysqli_connect('localhost:3308','root','','ece_ebay');

	if (!$conn) {
		echo "Erreur de connexion a la bdd";
	}
	else
	{
		if ($_POST['Valider']) 
		{
			/*-------------------------Si l'objet ne peut se vendre qu' en Enchere : -----------------------*/
			if ($prix_min != 0 && $prix_init == 0  && $prix_fixe == 0) {
					$type_vente1 = "Enchere";
					$type_vente2 = "0";
					$sql = " INSERT INTO items (Nom, Photo, Description, Video, Categorie, TypeVente1, TypeVente2, ID_Vendeur) VALUES ('$nom_objet', '$photo_objet', '$description_objet', '$video_objet', '$categorie_objet', '$type_vente1', '$type_vente2', '$id_vendeur')";

				}
			/*-------------------------Si l'objet ne peut se vendre qu' en Offres : -----------------------*/

			elseif ($prix_min == 0 && $prix_init != 0 && $prix_fixe == 0 ) {
					$type_vente1 = "Offres";
					$type_vente2 = "0";
					$sql = " INSERT INTO items (Nom, Photo, Description, Video, Categorie, TypeVente1, TypeVente2, ID_Vendeur) VALUES ('$nom_objet', '$photo_objet', '$description_objet', '$video_objet', '$categorie_objet', '$type_vente1', '$type_vente2', '$id_vendeur')";
				}	
			/*-------------------------Si l'objet ne peut se vendre qu' en VenteDirect : -----------------------*/

			elseif ($prix_min == 0 && $prix_init == 0 && $prix_fixe != 0) {
					$type_vente1 = "VenteDirect";
					$type_vente2 = "0";
					$sql = " INSERT INTO items (Nom, Photo, Description, Video, Categorie, TypeVente1, TypeVente2, ID_Vendeur) VALUES ('$nom_objet', '$photo_objet', '$description_objet', '$video_objet', '$categorie_objet', '$type_vente1', '$type_vente2', '$id_vendeur')";
				}
			/*----------------Si l'objet ne peut se vendre qu'en Enchere et en VenteDirect : -----------------*/

			elseif ($prix_min != 0 && $prix_init == 0 && $prix_fixe != 0) {
					$type_vente1 = "Enchere";
					$type_vente2 = "VenteDirect";
					$sql = " INSERT INTO items (Nom, Photo, Description, Video, Categorie, TypeVente1, TypeVente2, ID_Vendeur) VALUES ('$nom_objet', '$photo_objet', '$description_objet', '$video_objet', '$categorie_objet', '$type_vente1', '$type_vente2', '$id_vendeur')";
				}
			/*----------------Si l'objet ne peut se vendre qu'en Offres et en VenteDirect : -----------------*/

			elseif ($prix_min == 0 && $prix_init != 0 && $prix_fixe != 0) {
					$type_vente1 = "Offres";
					$type_vente2 = "VenteDirect";
					$sql = " INSERT INTO items (Nom, Photo, Description, Video, Categorie, TypeVente1, TypeVente2, ID_Vendeur) VALUES ('$nom_objet', '$photo_objet', '$description_objet', '$video_objet', '$categorie_objet', '$type_vente1', '$type_vente2', '$id_vendeur')";
				}


				$result=mysqli_query($conn,$sql);
				if ($result) {
				echo "Votre items a bien été crée dans la bdd items!";


						/*----------------------Si l'objet ne peut se vendre qu'en Enchere : --------------------------*/
						if ($prix_min != 0 && $prix_init == 0  && $prix_fixe == 0) {
								
								$sql2 = "SELECT * FROM items";
								if ($nom_objet !="") 
								{
									$sql2 .= " WHERE Nom LIKE '%$nom_objet%'";
									if ($description_objet !="") 
									{
										$sql2 .= "AND Description LIKE '%$description_objet%'";
									}
								}
								$result2 = mysqli_query($conn, $sql2);
								if (mysqli_num_rows($result2) == 0) 
								{
									echo "item not found";
								} 
								else 
								{
									while ($data = mysqli_fetch_assoc($result2)) 
									{
										$id_items= $data['ID'];
										echo "id_items a bien été trouvé";
									}
								}

								$sql3 = " INSERT INTO encheres (Prix, Date_debut, Date_fin, ID_items, Statut) VALUES ('$prix_min', '$debut_enchère', '$fin_enchere', '$id_items', '$statut')";
								$result3= mysqli_query($conn,$sql3);
								echo "On a ajouté dans la bdd enchere l'item ";

							}
						/*-------------------------Si l'objet ne peut se vendre qu' en Offres : -----------------------*/
/*
						elseif ($prix_min == 0 && $prix_init != 0 && $prix_fixe == 0 ) {

								$sql2 = "SELECT * FROM items";
								if ($nom_objet !="") 
								{
									$sql2 .= " WHERE Nom LIKE '%$nom_objet%'";
									if ($description_objet !="") 
									{
										$sql2 .= "AND Description LIKE '%$description_objet%'";
									}
								}
								$result2 = mysqli_query($conn, $sql2);
								if (mysqli_num_rows($result2) == 0) 
								{
									echo "item not found";
								} 
								else 
								{
									while ($data = mysqli_fetch_assoc($result2)) 
									{
										$id_items= $data['ID'];
										echo "id_items a bien été trouvé dans la bdd items";
									}
								}

								$sql3 = " INSERT INTO offres (ID_acheteurs, ID_vendeur, ID_items, Round, Montant) VALUES ('$id_acheteur', '$id_vendeur', '$id_items', '$round', '$prix_init')";
								$result3= mysqli_query($conn,$sql3);


								if(!$result3)
									echo "Erreur";
								else
									echo "On a ajouté dans la bdd offres l'item ";

							}	*/
						/*-------------------------Si l'objet ne peut se vendre qu' en VenteDirect : -----------------------*/

						elseif ($prix_min == 0 && $prix_init == 0 && $prix_fixe != 0) {
								
								$sql2 = "SELECT * FROM items";
								if ($nom_objet !="") 
								{
									$sql2 .= " WHERE Nom LIKE '%$nom_objet%'";
									if ($description_objet !="") 
									{
										$sql2 .= "AND Description LIKE '%$description_objet%'";
									}
								}
								$result2 = mysqli_query($conn, $sql2);
								if (mysqli_num_rows($result2) == 0) 
								{
									echo "item not found";
								} 
								else 
								{
									while ($data = mysqli_fetch_assoc($result2)) 
									{
										$id_items= $data['ID'];
										echo "id_items a bien été trouvé dans sa bdd";
									}
								}

								$sql3 = " INSERT INTO achat_direct (Prix, ID_Items) VALUES ('$prix_fixe', '$id_items')";
								$result3= mysqli_query($conn,$sql3);
								echo "On a ajouté dans la bdd achat_direct l'item ";

							}
							
						/*----------------Si l'objet ne peut se vendre qu'en Enchere et en VenteDirect : -----------------*/

						elseif ($prix_min != 0 && $prix_init == 0 && $prix_fixe != 0) {

								$sql2 = "SELECT * FROM items";
								if ($nom_objet !="") 
								{
									$sql2 .= " WHERE Nom LIKE '%$nom_objet%'";
									if ($description_objet !="") 
									{
										$sql2 .= "AND Description LIKE '%$description_objet%'";
									}
								}
								$result2 = mysqli_query($conn, $sql2);
								if (mysqli_num_rows($result2) == 0) 
								{
									echo "item not found";
								} 
								else 
								{
									while ($data = mysqli_fetch_assoc($result2)) 
									{
										$id_items= $data['ID'];
										echo "id_items a bien été trouvé dans sa bdd";
									}
								}

								$sql3 = " INSERT INTO encheres (Prix, Date_debut, Date_fin, ID_items, Statut) VALUES ('$prix_min', '$debut_enchère', '$fin_enchere', '$id_items', '$statut')";
								$result3= mysqli_query($conn,$sql3);
								echo "On a ajouté dans la bdd enchere l'item ";

								$sql4 = " INSERT INTO achat_direct (Prix, ID_Items) VALUES ('$prix_fixe', '$id_items')";
								$result4= mysqli_query($conn,$sql4);
								echo "On a ajouté dans la bdd achat_direct l'item ";
							}

						/*----------------Si l'objet ne peut se vendre qu'en Offres et en VenteDirect : -----------------*/

						elseif ($prix_min == 0 && $prix_init != 0 && $prix_fixe != 0) 
						{

								$sql2 = "SELECT * FROM items";
								if ($nom_objet !="") 
								{
									$sql2 .= " WHERE Nom LIKE '%$nom_objet%'";
									if ($description_objet !="") 
									{
										$sql2 .= "AND Description LIKE '%$description_objet%'";
									}
								}
								$result2 = mysqli_query($conn, $sql2);
								if (mysqli_num_rows($result2) == 0) 
								{
									echo "item not found";
								} 
								else 
								{
									while ($data = mysqli_fetch_assoc($result2)) 
									{
										$id_items= $data['ID'];
										echo "id_items a bien été trouvé dans sa bdd";
									}
								}

						/*		$sql3 = " INSERT INTO offres (ID_acheteurs, ID_vendeur, ID_items, Round, Montant) VALUES ('$id_acheteur', '$id_vendeur', '$id_items', '$round', '$prix_init')";
								$result3= mysqli_query($conn,$sql3);
								echo "On a ajouté dans la bdd offres l'item ";
						*/
								$sql4 = " INSERT INTO achat_direct (Prix, ID_Items) VALUES ('$prix_fixe', '$id_items')";
								$result4= mysqli_query($conn,$sql4);
								echo "On a ajouté dans la bdd achat_direct l'item ";
							}
							header("Location: http://localhost/Projet_Piscine_Ing3/mesObjets.php");

				}
						
				
				else
				{
					echo "CHEH";
				}
		}

	}


?>