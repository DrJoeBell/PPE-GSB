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

/////////////// INIT /////////////////
  $visiteurModif = "";
  $medecinModif = "";
  $motifModif = "";
  $bilanModif = "";
  $date = date("Y-m-d");
  $ok = false;

/////////////////////////////////////


  // charge les données à modifier du CR
  if(isset($_GET['id'])){
    $id = $_GET['id'];

    // erreur de ID ou non existant
    $query = "SELECT * FROM rapport;";
    $result = $bdd->query($query);

    foreach ($result as $key) {
      if($key['ID'] == $id){
        $ok = true;
      }
    }

    if($ok == false){
      setFlash("danger", "Il n'y a pas de compte rendu correspondant !");
      header ("Location: " . WEBROOT);
      die();
    }





    $query = "SELECT * FROM rapport WHERE id = $id;";
    $resultModif = $bdd->query($query);

    foreach ($resultModif as $select) {
      $date = $select['DATERAPPORT'];
      $visiteurModif = $select['ID_REDIGER'];
      $medecinModif = $select['ID_CONCERNE'];
      $motifModif = $select['MOTIF'];
      $bilanModif = $select['BILAN'];
    }

    // selection du visiteur
    $query2 = "SELECT * FROM visiteur WHERE id = $visiteurModif;";
    $visiteurSelect = $bdd->query($query2)->fetch();

    $nomVisit = $visiteurSelect['NOM'];
    $prenomVisit = $visiteurSelect['PRENOM'];
    $idVisit = $visiteurSelect['ID'];


    // selection du medecin
    $query2 = "SELECT * FROM medecin WHERE id = $medecinModif;";
    $medecinSelect = $bdd->query($query2)->fetch();

    $nomMed = $medecinSelect['NOM'];
    $idMed = $medecinSelect['ID'];
    $prenomMed = $medecinSelect['PRENOM'];


    // selection du bilan
    $query2 = "SELECT * FROM motif WHERE id = $motifModif;";
    $selectMotif = $bdd->query($query2)->fetch();

    $motifSelect = $selectMotif['libelle'];
    $idBilan = $selectMotif['id'];

  }


///////////////////////////

  // UPDATE CR
  if(isset($_POST["bilan"]) && $_POST["bilan"] != "" && isset($_GET['id']))
  {
    $date = $bdd->quote($_POST["date"]);
    $visiteur = $_POST["visiteur"];
    $medecin = $_POST["medecin"];
    $motif = $_POST["motif"];
    $bilan = $bdd->quote($_POST["bilan"]);
    $id = $bdd->quote($_GET['id']);


    // requete de UPDATE
    $queryUpdate = "UPDATE rapport SET ID_REDIGER=$visiteur, ID_CONCERNE=$medecin, DATERAPPORT=$date, MOTIF=$motif, BILAN=$bilan WHERE id=$id;";

    // exécution de la requête UPDATE
    $bdd->query($queryUpdate);

    setFlash("success", "Le compte rendu a été mis à jour !");
    header('Location:'.WEBROOT);
      die();
  }





///////////////////////////

  // ajout d'un CR
  if(isset($_POST["bilan"]) && $_POST["bilan"] != "" && !isset($_GET['id']))
  {
    $date = $bdd->quote($_POST["date"]);
    $visiteur = $_POST["visiteur"];
    $medecin = $_POST["medecin"];
    $motif = $_POST["motif"];
    $bilan = $bdd->quote($_POST["bilan"]);

    // insertion d'un nouveau compte rendu dans la base de données
    $query_insert = "INSERT INTO rapport ( ID_REDIGER, ID_CONCERNE, DATERAPPORT, MOTIF, BILAN )
                    VALUES ($visiteur, $medecin, $date, $motif, $bilan);";

    // exécution de la requête d'insertion
    $bdd->query($query_insert);

    setFlash("success", "Le compte rendu a été enregistré !");

    /////////////// RE - INIT /////////////////
    $visiteurModif = "";
    $medecinModif = "";
    $motifModif = "";
    $bilanModif = "";
    $date = date("Y-m-d");
    $ok = false;
  }

///////////////////////////////

  // selection des medecins
  $query= "SELECT * FROM medecin ORDER BY nom;";
  $result_medecin = $bdd->query($query);

  // selection des motifs de CR
  $query= "SELECT * FROM motif ORDER BY libelle;";
  $result_motif = $bdd->query($query);

  // selection des visiteurs
  $query= "SELECT * FROM visiteur ORDER BY nom;";
  $result_visiteur = $bdd->query($query);

/////////////////////////////

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
              <input type="text" class="form-control" name="date" id="date" value="<?php echo $date; ?>" placeholder="<?php echo $date; ?>">
            </div>
          </div>

           <div class="form-group">
            <label for="select" class="col-lg-2 control-label">Visiteur</label>
            <div class="col-lg-10">
              <select class="form-control" name="visiteur" id="visiteur">
                <?php
                  while($value =$result_visiteur->fetch())
                  {
                    if($nomVisit == $value['NOM'] && $prenomVisit == $value['PRENOM']){
                    echo "<option  selected='selected' value=$idVisit >$prenomVisit $nomVisit </option>";

                    }else{
                      echo "<option  value='".$value['ID']."'>".$value['PRENOM']." ".$value['NOM']."</option>";
                    }
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
                    if($nomMed == $value['NOM'] && $prenomMed == $value['PRENOM']){
                      echo "<option  selected='selected' value=$idMed >$prenomMed $nomMed </option>";
                    }else{
                      echo "<option value='".$value['ID']."'>".$value['PRENOM']." ".$value['NOM']."</option>";
                    }
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
                      if($motifSelect == $value['libelle']){
                        echo "<option  selected='selected' value=$idBilan >$motifSelect</option>";
                      }else{
                        echo "<option value='".$value['id']."'>".$value['libelle']."</option>";
                      }
                    }
                    $result_motif->closeCursor();
                  ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Bilan</label>
            <div class="col-lg-10">
              <textarea class="form-control" rows="3" name="bilan" id="bilan" value="<?= $bilanModif; ?>" placeholder="<?= $bilanModif; ?>"><?= $bilanModif; ?></textarea>
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
