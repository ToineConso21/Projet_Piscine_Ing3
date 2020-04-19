<?php
	session_start();
  require_once('../sessMgmt/session.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>ECE Ebay | Mon Compte</title>
</head>

 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" 
  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="http://localhost/Projet_Piscine_Ing3/util.css">

 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script type="text/javascript">
 $(document).ready(function(){
 $('.header').height($(window).height());
 });

  $(document).ready(function(){
  	var imgUrl=url("<?php echo $_SESSION['user_imageFond']; ?>");
 $('#profile').css('background-image','url(imgUrl)');
 });

 $(document).ready(function(){
 	$('#button').click(function(){
		 $('#profile').css('background-image', 'url(bgdImg/fond1.jpg)');
	 });
 });
</script>

</head>


<body>
	<div class="jumbotron">
  <div class="container-fluid">
    <div class="container text-center">
      <h1><a href="http://localhost/Projet_Piscine_Ing3/Accueil.php">EBAY ECE</a></h1>
    </div>
  </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="http://localhost/Projet_Piscine_Ing3/Accueil.php">Accueil</a></li>
  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Catégories<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Féraille ou Trésor</a></li>
          <li><a href="#">Bon pour le musée</a></li>
          <li><a href="#">Acessoire VIP</a></li>
        </ul>
      </li>
        <?php if((isset($_SESSION['user_type']) && $_SESSION['user_type']=="Vendeur" )|| (isset($_SESSION['user_type']) && $_SESSION['user_type']=="Admin" )) {
          ?>
          <li><a href="#">Vendre</a></li>
          <?php
        } 
        ?>
        
        <li><a href="#">Contact</a></li>
        <?php if (isset($_SESSION['user_login'])) {
          ?>
          <li><a href="#">Mon Compte</a></li>
          <?php
        } 
        ?>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Créer un compte</a></li>
        <li><a href="http://localhost/Projet_Piscine_Ing3/Connexion.php">Connexion</a></li>
      </ul>
    </div>
  </div>
</nav>

<style type="text/css">
	#profile {
		padding: 100px;
		background-image: url("<?php $_SESSION['user_imageFond']; ?>");
	}
</style>

<div id="profile" >
	<img class="round" style="max-width:150px;padding: 15px" src="<?php echo $_SESSION['user_pdp']; ?>" alt="photo">
	<p style="padding-left:15px ">Bonjour <strong><?php echo $_SESSION['user_login'] ?></strong> !</p>

	<div id="align">
		<h2 align="center"><u>Mes informations:</u></h2>
		<table align="center" class="h3" cellpadding="25">
			<tr >
				<td style="padding-bottom: 20px">Nom:</td>
				<td style="padding-bottom: 20px"><?php echo $_SESSION['user_nom']; ?> </td>
			</tr>

			<tr >
				<td style="padding-bottom: 20px">Pseudo:</td>
				<td style="padding-bottom: 20px"><?php echo $_SESSION['user_login'];?></td>
			</tr>

			<tr>
				<td style="padding-bottom: 20px">Email:</td>
				<td style="padding-bottom: 20px"><?php echo $_SESSION['user_email']; ?></td>
			</tr>

			<tr>
				<!-- <td colspan="2" align="center"><input type="submit" value="Modifier"></td> -- Bouton Modifier infos persos à implementer plus tard -->
			</tr>
		</table>
		<!--action="modifProfil.php"-->
		<form  method="post" enctype="multipart/form-data">
			<input type="file" id="photo" name="photo" style="margin-left: 25px">
			<button id="button" style="margin-left: 25px">Définir image comme fond</button>
		</form>

		<?php
		if (isset($_FILES['photo']['tmp_name'])) {  
			$_SESSION['user_imageFond']=imagecreatefromjpeg($_FILES['photo']['tmp_name']);
			imagejpeg($_SESSION['user_imageFond'],'bgdImg/'. $_FILES['photo']['name'], 90);
			
		}
		?>
	</div>
</div>

</body>
</html>