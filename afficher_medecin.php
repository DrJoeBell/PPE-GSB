<?php 
  session_start();
  include("lib/database_connexion.php");
  include("partials/header.php");
  include("lib/function.php");
  include("partials/navbar.php");
  include("partials/side_navbar.php");


//Si le post est rentré
if(isset($_GET["id"]))
{
  if ($_GET["id"]=="all")
  {
    //variable pour tout afficher
    $tout_afficher=true;
    if (isset($_GET["pos"]))
    {
      $query="SELECT * FROM medecin, specialite WHERE specialite.ID = medecin.ID_POSSEDE AND medecin.ID=". id_medecin($_GET['pos']).";";
    }
    else
    {
      $query="SELECT * FROM medecin, specialite WHERE specialite.ID = medecin.ID_POSSEDE LIMIT 1 ;";
    }
  }
  else
  {
    $id_medecin=$bdd->quote($_GET["id"]);
    $query="SELECT * FROM medecin, specialite WHERE specialite.ID = medecin.ID_POSSEDE AND medecin.ID=". $id_medecin.";";
  }

  $result=$bdd->query($query);
  while($value =$result->fetch())
  {
    $nom=$value['NOM'];
    $prenom=$value['PRENOM'];
    $adresse=$value['ADRESSE'];
    $tel=$value['TEL'];
    $specialite=$value['LIBELLE'];
  }

}

?>
<div class="container">

      <div class="span9 offset1 container">

  <h1><small>Fiche de  <?php echo $prenom."&nbsp;".$nom ;?></small></h1>
  <hr>

</div>
      <div class="span9 offset1 container">
        <div class="span6">


          <h4>Spécialité du practicien</h4>
            <p>
              <?php
                echo $specialite;
              ?>            
            </p>

          <hr>

          <h4>Numéro de téléphone</h4>
            <p>
              <?php echo $tel; ?>            
            </p>

          <hr>
          <h4>Adresse</h4>
            <p>
              <?php echo $adresse; ?>
            </p>

          <hr>

      <?php


// afiche tous les médecins sous le format de page
      if (isset($tout_afficher))
      {
        $nb_medecin=nombre_medecin();
          
         if (isset($_GET["pos"]))
         {
            $pos=$_GET["pos"];
         }
         else
         {
            $pos=0;
         }

         if (($nb_medecin-1)<=$pos)
         {
            $class_next="class='next disabled'";
            $href_next="#";
         }
         else
         {
            $class_next="class='next'";
            $href_next="href='afficher_medecin.php?id=all&pos=".($pos+1)."'";
         }

          if (0>=$pos)
         {
            $class_previous="class='previous disabled'";
            $href_previous="#";
         }
         else
         {
            $class_previous="class='previous'";
            $href_previous="href='afficher_medecin.php?id=all&pos=".($pos-1)."'";
         }

        echo "
        <p>".($pos + 1)."/".$nb_medecin ."</p>
        <ul class='pager'>
          <li  ".$class_previous." >
            <a ".$href_previous.">
              Précédent
            </a>
          </li>

          <li ".$class_next." >
            <a ".$href_next.">
              Suivant
            </a>
          </li>
        </ul>
        ";

      }

      ?>
<?php include("partials/footer.php");?>