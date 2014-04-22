<?php 
  session_start();

  // correction date pour Uwamp
  if( ! ini_get('date.timezone') )
  {
    date_default_timezone_set('GMT');
  }

  include("lib/database_connexion.php");
  include("lib/function.php");
  include("lib/constants.php");


  // enregistrement des modifications
  if(isset($_POST['id'])){

  }else{
    //Si le post est rentré
    if(isset($_GET["id"])){
      $id = $_GET['id'];

      // recuperation des donnees du CR
      $query= "SELECT * FROM rapport WHERE id=$id;";
      $result_rapport = $bdd->query($query)->fetchAll();

      foreach ($result_rapport as $rapport) {
        $date = $rapport['DATERAPPORT'];
        $visiteur = $rapport['ID_RAPPORT'];
        $medecin = $rapport['ID_CONCERNE'];
        $motif = $rapport['MOTIF'];
        $bilan = $rapport['BILAN'];
      }


        // selection des medecins
        $query= "SELECT * FROM medecin ORDER BY nom;";
        $result_medecin = $bdd->query($query);

        // selection des motifs de CR
        $query= "SELECT * FROM motif ORDER BY libelle;";
        $result_motif = $bdd->query($query);

        // selection des visiteurs
        $query= "SELECT * FROM visiteur ORDER BY nom;";
        $result_visiteur = $bdd->query($query);

    }else{
      setFlash("danger","Aucun compte rendu correspondant !");
    }
  }

  include("partials/navbar.php");
  include("partials/header.php");
?>

<div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-6">
    <div class="well bs-component">

      <form class="form-horizontal" action="#" method="POST">

        <fieldset>
          <legend>Modifier le compte rendu</legend>

          <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Date</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="date" id="date" value="<?= $date; ?>" placeholder="<?= $date; ?>">
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
              <a href="<?= WEBROOT;?>"><button type="button" class="btn btn-default">Retour</button></a>
              <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
          </div>

        </fieldset>
      </form>
    </div>
  </div>


  
<?php include("partials/footer.php");?>
