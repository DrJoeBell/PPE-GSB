<?php
function flashMessage($type, $message)
{
		echo
		"<div class='flashMessage alert alert-".$type." animated fadeInDown'>
		".$message."
		<button class='close' data-dismiss='alert'>x</button>
		</div>";
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




