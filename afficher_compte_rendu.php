<?php 
  session_start();
  include("lib/database_connexion.php");
  include("partials/header.php");
  include("lib/function.php");
  include("partials/navbar.php");

//Si le post est rentré
if(isset($_GET["id"]))
{
  if ($_GET["id"]=="all")
  {
    //variable pour tout afficher
      $tout_afficher=true;
    if (isset($_GET["pos"]))
    {
      $query="SELECT * FROM rapport where ID=". id_compte_rendu($_GET['pos']).";";
    }
     else
     {
     $query="SELECT * FROM rapport LIMIT 1 ;";
    }
  }
  else
  {
  $id_compte_rendu=$bdd->quote($_GET["id"]);
  $query="SELECT * FROM rapport WHERE ID=". $id_compte_rendu.";";
    }
  $result=$bdd->query($query);
  while($value =$result->fetch())
  {
    $id_rediger=$value['ID_REDIGER'];
    $id_concerner=$value['ID_CONCERNE'];
    $motif=$value['MOTIF'];
    $date_compte_rendu=$value['DATERAPPORT'];
    $bilan=$value['BILAN'];
  }
}
  $query= "select * from medecin WHERE ID=".$id_rediger.";";
$result_medecin = $bdd->query($query);
  $query= "select * from motif WHERE ID=".$motif.";";
$result_motif = $bdd->query($query);
  $query= "select * from visiteur WHERE ID=".$id_concerner.";";
$result_visiteur = $bdd->query($query);
?>
<div class="container">

      <div class="span9 offset1 container">

  <h1><small>Compte rendu du <?php echo $date_compte_rendu ;?></small></h1>
</div>
      <div class="span9 offset1 container">
        <div class="span6">
          <h4>Bilan</h4>
          <p>
            <?php echo $bilan; ?>            
          </p>
          <hr>
          <h4>Médecin</h4>
          <p><?php 
           while($value =$result_medecin->fetch())
            {
             echo $value['PRENOM']." ".$value['NOM'];
            }
            $result_medecin->closeCursor();
          ?></p>
          <hr>
          <h4>Visiteur</h4>
          <p>
          <?php 
           while($value =$result_visiteur->fetch())
            {
             echo $value['PRENOM']." ".$value['NOM']."<br/><br/><b>Date de première visite</b><br/>".$value['DATEEMBAUCHE']." 
             <br/><hr><br/><h4>Adresse du visiteur</h4>".$value['ADRESSE']."<br/>".$value['VILLE']."<br/>".$value['CP']
             ;
            }
            $result_visiteur->closeCursor();
          ?></p>
      <hr>
      <?php
      
      if (isset($tout_afficher))
      {
        $nb_compte_rendu=nombre_compte_rendu();
          
         if (isset($_GET["pos"]))
         {
          $pos=$_GET["pos"];
  
            
         }
         else
         {
          $pos=0;
         }
         if (($nb_compte_rendu-1)<=$pos)
         {
            $class_next="class='next disabled'";
            $href_next="#";
         }
         else
         {
          $class_next="class='next'";
          $href_next="href='afficher_compte_rendu.php?id=all&pos=".($pos+1)."'";
         }
          if (0>=$pos)
         {
            $class_previous="class='previous disabled'";
            $href_previous="#";
         }
         else
         {
          $class_previous="class='previous'";
          $href_previous="href='afficher_compte_rendu.php?id=all&pos=".($pos-1)."'";
         }

        echo "
        <p>".($pos + 1)."/".$nb_compte_rendu ."</p>
        <ul class='pager'>
          <li  ".$class_previous." ><a ".$href_previous.">Précédent</a></li>
          <li ".$class_next." ><a ".$href_next.">Suivant</a></li>
        </ul>
        ";

      }




      ?>
<?php include("partials/footer.php");?>
