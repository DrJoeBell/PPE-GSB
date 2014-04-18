<?php 
session_start();
include("lib/database_connexion.php");
include("lib/constants.php");
include("lib/function.php");

if (!isset($_SESSION["login"]))
{
  header ("Location: signin.php")   ;
  die();
}
if (isset($_POST["nom"]))
{
  if ($_POST["pass"]!="") #Si le mot de passe est modifié
  {
    if ($_POST["pass"]==$_POST["pass2"])
    {
      $query= "UPDATE visiteur SET NOM = '".$_POST["nom"]."' ,PRENOM = '".$_POST["prenom"]."' ,MAIL = '".$_POST["email"]."' ,MDP = '".md5($_POST["pass"])."' where login='".$_SESSION["login"]."' ;";
      $result = $bdd->query($query);
      header ("Location: signin.php");
    die();
  }
    else
    {
      flashMessage("error","Les mots de passe ne correspondent pas");
    }
  }
  else { #Sinon est le même
    $query= "UPDATE visiteur SET NOM = '".$_POST["nom"]."' ,PRENOM = '".$_POST["prenom"]."' ,MAIL = '".$_POST["email"]."' where login='".$_SESSION["login"]."' ;";
    $result = $bdd->query($query);

    // setFlash("success","Les modifications ont été enregistrées.");

    header ("Location: signin.php");
    die();
  }
}
include("partials/header.php");
include("partials/navbar.php");

?>

<div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-6">
    <div class="well bs-component">

      <form class="form-horizontal" action="#" method="POST">

        <fieldset>
          <legend>Modifier les informations personnelles</legend>

          <div class="form-group">
            <label for="nom" class="col-lg-2 control-label">Nom</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $_SESSION["nom"]; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="prenom" class="col-lg-2 control-label">Prénom</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $_SESSION["prenom"]; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="email" class="col-lg-2 control-label">E-mail</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="email" id="email" value="<?php echo $_SESSION["email"]; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="pass" class="col-lg-2 control-label">Mot de passe</label>
            <div class="col-lg-10">
              <input type="password" class="form-control" name="pass" id="pass" placeholder="Nouveau mot de passe...">
              <span class="help-block">Entrer un mot de passe seulement si vous voulez le modifier</span>
            </div>
          </div>

          <div class="form-group">
            <label for="pass2" class="col-lg-2 control-label">Confirmer</label>
            <div class="col-lg-10">
              <input type="password" class="form-control" name="pass2" id="pass2" placeholder="Confirmer le mot de passe...">
              <span class="help-block">Confirmer le mot de passe seulement si vous voulez le modifier</span>
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
              <button type="submit" class="btn btn-primary">Enregistrer</button>
              <a href="<?= WEBROOT;?>"><button type="button" class="btn btn-primary">Retour</button></a>
            </div>
          </div>

        </fieldset>
      </form>
    </div>
  </div>



<?php include("partials/footer.php");?>
