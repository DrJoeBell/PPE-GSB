<?php 
  session_start();
  include("lib/database_connexion.php");
  include("lib/function.php");
  include("lib/constants.php");
if (isset($_GET['page']) && is_numeric($_GET['page'])){
      $page = $_GET['page'];
      $nbParPage = 2;
      $limit = ($page-1) * $nbParPage;
      $limit2 = $limit + $nbParPage;
      $query = "SELECT * FROM rapport ORDER BY ID LIMIT $limit, $limit2";
      $result = $bdd->query($query);
      $rapport = $result->fetchAll();
}
elseif (isset($_GET['id']) && is_numeric($_GET['id'])) {
      $IdRapport = $bdd->quote($_GET['id']);
      $query = "SELECT * FROM rapport WHERE ID=".$IdRapport;
      $result=$bdd->query($query);
      $rapport = $result->fetchAll();
}
  include("partials/header.php");
  include("partials/navbar.php");
<<<<<<< HEAD
=======
?>
<div class="container">
  <h1>Affichage des compte-rendu</h1>
  <div class="row">
    
      <?php foreach($rapport as $CompteRendu):?>
          <div class="well">
            <h4><span class="glyphicon glyphicon-time"></span> <?= $CompteRendu['DATERAPPORT'];?></h4>
            <div><?= $CompteRendu['BILAN'];?></div>
            <div><?= $CompteRendu['MOTIF'];?></div>
            <div><?= $CompteRendu['ID_REDIGER'];?></div>
            <div><?= $CompteRendu['ID_CONCERNE'];?></div>
          </div>
      <?php endforeach; ?>
      
  </div>
  <ul class="pager">
  <li class="previous disabled"><a href="#">&larr; Précédents</a></li>
  <li class="next"><a href="<?= WEBROOT ?>afficher_compte_rendu.php?page=<?= ($_GET['page']+1) ?>">Suivants &rarr;</a></li>
</ul>
</div>



<!-- 

<?php




>>>>>>> 7e471e7f4c497a18177dfc094f35b959b1826c68

//Si le post est rentré
if(isset($_GET["id"]))
{
  if ($_GET["id"]=="all")
  {
    if (isset($_GET["page"]))
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




      ?> -->
<?php include("partials/footer.php");?>
