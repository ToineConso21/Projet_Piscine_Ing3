<?php
//Cette page vérifie si l'user est connecté pour des raisons de sécurité,
	//nous le renvoyons à l'accueil si ce n'est pas le cas
	if (!isset($_SESSION['user_id'])) {
		header('Location: Projet_Piscine_Ing3/Accueil.php');
	}
?>