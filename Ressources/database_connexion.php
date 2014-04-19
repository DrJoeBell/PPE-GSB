<?php

//Fichier à copier dans lib/


// remplacer les variables suivantes:
$database="usersio_gsb";
$server="localhost";
$user="Utilisateur";
$password="Mot de passe";


try{
$bdd = new PDO("mysql:host=$server; dbname=$database", $user, $password );

} catch(PDOException $e) {

    echo $e->getMessage();
}
?>
