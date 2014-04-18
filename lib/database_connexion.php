<?php
// $database="usersio_gsb";
// $server="mysql1.alwaysdata.com";
// $user="usersio";
// $password="mavace";


$database="usersio_gsb";
$server="localhost";
$user="root";
<<<<<<< HEAD
$password="valentin";


=======
$password="root";
>>>>>>> 7e471e7f4c497a18177dfc094f35b959b1826c68
try{
$bdd = new PDO("mysql:host=$server; dbname=$database", $user, $password );

} catch(PDOException $e) {

    echo $e->getMessage();
}
?>
