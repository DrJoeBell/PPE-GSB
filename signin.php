<?php 
session_start();
include("header.php");
include("function.php");
include("database_connexion.php");
if (isset($_POST["login"]) && isset($_POST["password"]))
{
    $query= "select * from visiteur where login='".$_POST["login"]."' and password='".md5($_POST["password"])."' ;";
    $result = $bdd->query($query);
    //Si l'utilasateur existe
    while($value =$result->fetch())
    {
        $user_exist_ok=1;
        $_SESSION["login"]=$value["LOGIN"];
        $_SESSION["nom"]=$value["NOM"];
        $_SESSION["prenom"]=$value["PRENOM"];
        $_SESSION["email"]=$value["MAIL"];
        $_SESSION["id"]=$value["ID"];
    }
    $result->closeCursor();
    if (isset($user_exist_ok))
    {
        header ("Location: index.php?a=login")   ;
        break;
    }
    else
    {
        flashMessage("error","Informations éronées");
    }
}
?>
    <div class="container">
        <form class="form-signin" style="margin-top: 15%;" method="POST" action="signin.php">
            <h2 class="form-signin-heading">Connectez-vous</h2>
            <input type="text" class="input-block-level" placeholder="Nom d'utilisateur" name="login" >
            <input type="password" class="input-block-level" placeholder="Mot de passe" name="password" >
            <button class="btn btn-large btn-primary" type="submit">Connexion</button>
        </form>
    </div> <!-- /container -->
<?php 
include("footer.php");
?>