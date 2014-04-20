<?php 
  session_start();
  include("lib/database_connexion.php");
  include("lib/function.php");
  include("lib/constants.php");


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
                    VALUES ($visiteur, $medecin, $date, $motif, $bilan);";

    // exécution de la requête d'insertion
    $bdd->query($query_insert);
  }

  $query= "SELECT * FROM medecin ORDER BY nom;";
  $result_medecin = $bdd->query($query);
  $query= "SELECT * FROM motif ORDER BY libelle;";
  $result_motif = $bdd->query($query);
  $query= "SELECT * FROM visiteur ORDER BY nom;";
  $result_visiteur = $bdd->query($query);


  include("partials/navbar.php");
  include("partials/header.php");

?>

<div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-6">
    <div class="well bs-component">

      <form class="form-horizontal" action="#" method="POST">

        <fieldset>
          <legend>Ajouter un compte rendu</legend>

          <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Date</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="date" id="date" value="<?php echo date("d/m/Y"); ?>" placeholder="<?php echo date("d/m/Y"); ?>">
            </div>
          </div>

           <div class="form-group">
            <label for="select" class="col-lg-2 control-label">Visiteur</label>
            <div class="col-lg-10">
              <select class="form-control" name="visiteur" id="visiteur">
                <?php
                  while($value =$result_visiteur->fetch())
                  {
                    echo "<option  value='".$value['ID']."'>".$value['PRENOM']." ".$value['NOM']."</option>";
                  }
                  $result_visiteur->closeCursor();
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="select" class="col-lg-2 control-label">Médecin</label>
            <div class="col-lg-10">
              <select class="form-control" name="medecin" id="medecin">
                <?php
                  while($value =$result_medecin->fetch())
                  {
                    echo "<option value='".$value['ID']."'>".$value['PRENOM']." ".$value['NOM']."</option>";
                  }
                  $result_medecin->closeCursor();
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="select" class="col-lg-2 control-label">Motif</label>
            <div class="col-lg-10">
              <select class="form-control" name="motif" id="motif">
                  <?php
                    while($value =$result_motif->fetch())
                    {
                      echo "<option value='".$value['id']."'>".$value['libelle']."</option>";
                    }
                    $result_motif->closeCursor();
                  ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Bilan</label>
            <div class="col-lg-10">
              <textarea class="form-control" rows="3" name="bilan" id="bilan" placeholder="Ecrivez votre bilan de visite."></textarea>
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
              <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
          </div>

        </fieldset>
      </form>
    </div>
  </div>


  
<?php include("partials/footer.php");?>
