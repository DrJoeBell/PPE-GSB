<?php 
    session_start();
    include("lib/function.php");
    include("lib/constants.php");
    include("lib/database_connexion.php");
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
            flashMessage("error","Informations erronées");
        }
    }


include("partials/header.php");
?>
        <style type="text/css">
            body {
              padding-top: 40px;
              padding-bottom: 40px;
              background-color: #eee;
            }

            .form-signin {
              max-width: 330px;
              padding: 15px;
              margin: 0 auto;
            }
            .form-signin .form-signin-heading,
            .form-signin .checkbox {
              margin-bottom: 10px;
            }
            .form-signin .checkbox {
              font-weight: normal;
            }
            .form-signin .form-control {
              position: relative;
              height: auto;
              -webkit-box-sizing: border-box;
                 -moz-box-sizing: border-box;
                      box-sizing: border-box;
              padding: 10px;
              font-size: 16px;
            }
            .form-signin .form-control:focus {
              z-index: 2;
            }
            .form-signin input[type="email"] {
              margin-bottom: -1px;
              border-bottom-right-radius: 0;
              border-bottom-left-radius: 0;
            }
            .form-signin input[type="password"] {
              margin-bottom: 10px;
              border-top-left-radius: 0;
              border-top-right-radius: 0;
            }

        </style>
    <div class="container">
        <form class="form-signin" style="margin-top: 15%;" method="POST" action="signin.php" role="form">
            <h2 class="form-signin-heading">Connectez-vous</h2>
            <input type="text" class="form-control" placeholder="Nom d'utilisateur" name="login" >
            <input type="password" class="form-control" placeholder="Mot de passe" name="password" >
            <button class="btn btn-lg btn-primary  btn-block" type="submit">Connexion</button>
        </form>
    </div> <!-- /container -->
<?php 
include("partials/footer.php");
?>