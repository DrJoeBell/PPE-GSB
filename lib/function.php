<?php
function flashMessage()
{
    if (isset($_SESSION['flash'])) {
        echo $_SESSION['flash'];
        unset($_SESSION['flash']);
    }
}
function setFlash($type="success", $message){
    $_SESSION['flash'] = 
    "<div class='alert alert-$type alert-dismissable bounceInDown'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <div class='text-center'>$message</div>
        
    </div>
    ";
}

function id_compte_rendu($position)
{
  	include("database_connexion.php");
    $query="SELECT ID FROM rapport;";
    $result=$bdd->query($query);
    $nb_id=$result->rowCount();
    if ($position>($nb_id-1))
    {
    	 return false;
    }
    $all_id = array();
    while($value =$result->fetch())
    {
        $all_id[]=$value['ID'];
    }
    return $all_id[$position];
}
function nombre_compte_rendu() //nombre de compte-rendu
{
    include("database_connexion.php");
    $query= "select ID from rapport ;";
    $result = $bdd->query($query);
    $nb_id = $result->rowCount();
    return $nb_id;
}


// retourne le nombre de médecin
function nombre_medecin()
{
    include("database_connexion.php");
    $query= "select ID from medecin ;";
    $result = $bdd->query($query);
    $nb_id = $result->rowCount();
    return $nb_id;
}

function id_medecin($position)
{
    include("database_connexion.php");
    $query="SELECT ID FROM medecin;";
    $result=$bdd->query($query);
    $nb_id=$result->rowCount();
    if ($position>($nb_id-1))
    {
         return false;
    }
    $all_id = array();
    while($value =$result->fetch())
    {
        $all_id[]=$value['ID'];
    }
    return $all_id[$position];
}

///////// concernant les visiteurs /////////

function id_visiteur($position)
{
    include("database_connexion.php");
    $query="SELECT ID FROM visiteur;";
    $result=$bdd->query($query);
    $nb_id=$result->rowCount();
    if ($position>($nb_id-1))
    {
         return false;
    }
    $all_id = array();
    while($value =$result->fetch())
    {
        $all_id[]=$value['ID'];
    }
    return $all_id[$position];
}
function nombre_visiteur() //nombre de visiteur commercial
{
    include("database_connexion.php");
    $query= "select ID from visiteur ;";
    $result = $bdd->query($query);
    $nb_id = $result->rowCount();
    return $nb_id;
}
function select(){

}




