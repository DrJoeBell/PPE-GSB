<?php
session_start();
if ((!isset($_SESSION["password"]) )&& (!isset($_SESSION["login"])))
{  header ("Location: signin.php")   ;
    break;}
    
include("lib/function.php");
include("lib/constants.php");
include("partials/header.php");
include("partials/navbar.php");
include("lib/database_connexion.php");


if(isset($_GET["a"]))
if (($_GET["a"]=="login"))
  {
    setFlash("success","Bienvenue sur l'application GSB");
  }
?>

<div align="center" style="width: 40%;margin:20 auto;">
	<img src="images/logo_GSB.jpg"/>
<div>
<?php include("partials/footer.php");?>