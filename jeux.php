<?php

   $gagnant=$_POST['gagnant'];
if($gagnant){
  $conn=mysqli_connect('localhost','root','','ece_ebay');
  $sql ="UPDATE acheteurs SET Solde = Solde+50 WHERE ID ='".$_SESSION['user_id']."'";

  $result = mysqli_query($conn, $sql);
  if(!$result){
    echo"pas ouf";
  }
  
header("http://localhost/Projet_Piscine_Ing3/Accueil.php");
}
}

?>