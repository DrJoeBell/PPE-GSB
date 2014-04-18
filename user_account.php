<?php 
session_start();
include("lib/database_connexion.php");
include("lib/function.php");
include("partials/navbar.php");
include("partials/side_navbar.php");
if  (!isset($_SESSION["login"]))
{  header ("Location: signin.php")   ;
    break;}
if (isset($_POST["nom"]))
{
if ($_POST["pass"]!="") #Si le mot de passe est changer
{
  if ($_POST["pass"]==$_POST["pass2"])
  {
      $query= "UPDATE visiteur SET NOM = '".$_POST["nom"]."' ,PRENOM = '".$_POST["prenom"]."' ,MAIL = '".$_POST["email"]."' ,MDP = '".md5($_POST["pass"])."' where login='".$_SESSION["login"]."' ;";
$result = $bdd->query($query);
header ("Location: signin.php")   ;
    break;
  }
  else{
    flashMessage("error","Les mots de passe ne correspondent pas");
  }
}
else { #Sinon
  $query= "UPDATE visiteur SET NOM = '".$_POST["nom"]."' ,PRENOM = '".$_POST["prenom"]."' ,MAIL = '".$_POST["email"]."' where login='".$_SESSION["login"]."' ;";
$result = $bdd->query($query);
header ("Location: signin.php")   ;
    break;

}
}
include("partials/header.php");

?>
<div class="container">
     <form method="POST" action="user_account.php">
  <fieldset>
    <legend>Changer mes informations personnelles</legend>
    <label>Nom</label>
    <input type="text" value="<?php echo $_SESSION["nom"]; ?>" name="nom">
    <label>Prénom</label>
    <input type="text" value="<?php echo $_SESSION["prenom"]; ?>" name="prenom">
    <label>E-mail</label>
    <input type="email" value="<?php echo $_SESSION["email"]; ?>" name="email">
    <label>Mot de passe</label>
    <input type="password" placeholder="Nouveau mot de passe..." name="pass">
    <span class="help-block">Entrer un mot de passe seulement si vous voulez le modifier</span>
    <label>Confirmer le nouveau mot de passe</label>
    <input type="password" placeholder="Confirmer le mot de passe..." name="pass2">
     <span class="help-block">Confirmer le mot de passe seulement si vous voulez le modifier</span>
    <!-- <span class="help-block">Example block-level help text here.</span> 
    <label class="checkbox">
      <input type="checkbox"> Check me out
    </label>
    -->
    <button type="submit" class="btn">Valider</button>
  </fieldset>
</form>  
    </div>

<?php include("partials/footer.php");?>
