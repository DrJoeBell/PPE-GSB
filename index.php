<?php
session_start();
if ((!isset($_SESSION["password"]) )&& (!isset($_SESSION["login"])))
{  header ("Location: signin.php")   ;
    break;}
include("header.php");
include("function.php");
include("navbar.php");
include("side_navbar.php");
include("database_connexion.php");
if(isset($_GET["a"]))
if (($_GET["a"]=="login"))
  {
    flashMessage("success","Bienvenue sur l'application GSB");
  }
?>

<div align="center" style="width: 40%;margin:20 auto;">
	<img src="images/logo_GSB.png"/>
<div>
<?php include("footer.php");?>