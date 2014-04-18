
<?php 
session_start();
include("database_connexion.php");
include("header.php");
include("function.php");
include("navbar.php");
include("side_navbar.php");
//Si le post est rentré
if(isset($_POST["bilan"]))
{
  $date=$bdd->quote($_POST["date"]);
  $visiteur=$_POST["visiteur"];
  $medecin=$_POST["medecin"];
  $motif=$_POST["motif"];
  $bilan=$bdd->quote($_POST["bilan"]);

// insertion d'un nouveau compte rendu dans la base de données
  $query_insert="INSERT INTO rapport ( ID_REDIGER, ID_CONCERNE, DATERAPPORT, MOTIF, BILAN )
                  VALUES ($visiteur, $medecin, $date,$motif,$bilan);";
// exécution de la requête d'insertion
$bdd->query($query_insert);
}

  $query= "select * from medecin ;";
$result_medecin = $bdd->query($query);
  $query= "select * from motif ;";
$result_motif = $bdd->query($query);
  $query= "select * from visiteur ;";
$result_visiteur = $bdd->query($query);
?>
<div class="span9 offset1 container">
    <div class="row-fluid">
    <h4 style="margin:20 0 0 -10"><i class="icon-plus-sign-alt"></i>Ajouter un compte-rendu</h4>
    <hr>
    <div class="clearfix">
    <!-- ##################################-->
    <form method="POST" action="ajouter_compte_rendu.php">
      <fieldset >
        <label>Date</label>
        <input style="width:40%" name="date" type="text" class="span4 datepicker" value="<?php echo date("d/m/Y") ?>">
      </fieldset>
      <!-- ##################################-->
      <fieldset >
        <label>Visiteur</label>
    <select style="width:40%" name="visiteur">
      <?php
          while($value =$result_visiteur->fetch())
          {
              echo "<option  value='".$value['ID']."'>".$value['PRENOM']." ".$value['NOM']."</option>";
          }
          $result_visiteur->closeCursor();
      ?>
    </select>
      </fieldset>
      <!-- ##################################-->
        <fieldset >
        <label>Médecin</label>
    <select style="width:40%" name="medecin">
      <?php
    while($value =$result_medecin->fetch())
  {
   echo "<option value='".$value['ID']."'>".$value['PRENOM']." ".$value['NOM']."</option>";
  }
$result_medecin->closeCursor();

      
      ?>
    </select>
      </fieldset>
      <!-- ##################################-->
        <fieldset >
        <label>Motif</label>
      <select style="width:40%" name="motif">
      <?php
    while($value =$result_motif->fetch())
  {
   echo "<option value='".$value['id']."'>".$value['libelle']."</option>";
  }
$result_motif->closeCursor();
      ?>
    </select>
   </fieldset>
   <!-- ##################################-->
    <fieldset>
    <label>Bilan</label>
    <textarea id="textarea" style="width:40%" cols="40" rows="5" name="bilan" placeholder="Écrivez ici ce que vous concluez sur cette visite..."></textarea>
  </fieldset>
   <button style="margin:auto; width:40%;" type="submit" class="btn span6">Valider</button>
</form>
  </div><!--/.row-->
<?php include("footer.php");?>
