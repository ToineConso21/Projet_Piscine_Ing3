<?php
	session_start();
	session_unset();
	session_destroy();
	header('Location: http://localhost/Projet_Piscine_Ing3/Accueil.php');
?>