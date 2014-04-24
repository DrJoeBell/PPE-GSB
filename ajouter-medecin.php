<?php 
  session_start();
  if ((!isset($_SESSION["password"]) )&& (!isset($_SESSION["login"]))){
    header ("Location: signin.php");
    break;
  }
  
  include("lib/database_connexion.php");
  include("lib/function.php");
  include("lib/constants.php");

////////////// INIT /////////////////

    $nom = "nom";
    $prenom = "prénom";
    $adresse = "adresse";
    $ville = "ville";
    $cp = "XXXXX";
    $tel = "xx xx xx xx xx";
    $departement = "xx";

    $nomValue = "";
    $prenomValue = "";
    $adresseValue = "";
    $villeValue = "";
    $cpValue = "";
    $telValue = "";
    $departementValue = "";

    $ok = false;

////////////// //// /////////////////

  // modification du medecin
  if(isset($_GET['id'])){
    $id = $_GET['id'];


    // erreur de ID ou non existant
    $query = "SELECT * FROM medecin;";
    $result = $bdd->query($query);

    foreach ($result as $key) {
      if($key['ID'] == $id){
        $ok = true;
      }
    }

    if($ok == false){
      setFlash("danger", "Il n'y a pas de médecin correspondant !");
      header ("Location: " . WEBROOT);
      die();
    }

    $query = "SELECT * FROM medecin WHERE id = $id;";
    $resultMed = $bdd->query($query);

    foreach ($resultMed as $resultat) {
      $nomValue = $nom = $resultat['NOM'];
      $prenomValue = $prenom = $resultat['PRENOM'];
      $idSpe = $idSpeValue = $resultat['ID_POSSEDE'];
      $adresse = $adresseValue = $resultat['ADRESSE'];
      $ville = $villeValue = $resultat['VILLE_MEDECIN'];
      $cp = $cpValue = $resultat['CP_MEDECIN'];
      $tel = $telValue = $resultat['TEL'];
      $departement = $departementValue = $resultat['DEPARTEMENT'];
    }

    // recuperation de la spe du medecin
    $query = "SELECT * FROM specialite WHERE id = $idSpe;";
    $resultSpe = $bdd->query($query)->fetch();

    $specialite = $resultSpe['LIBELLE'];

  }


///////////////////////////

  // ajout d'un nouveau medecin
  if (isset($_POST['nom']) && $_POST['nom'] != '' && isset($_GET['id']))
  {
    $id = $bdd->quote($_GET['id']);
    $nom = $bdd->quote($_POST["nom"]);
    $prenom = $bdd->quote($_POST["prenom"]);
    $adresse = $bdd->quote($_POST["adresse"]);
    $ville = $bdd->quote($_POST["ville"]);
    $cp = $bdd->quote($_POST["cp"]);
    $tel = $bdd->quote($_POST["tel"]);
    $departement = $bdd->quote($_POST["departement"]);
    $specialite = $bdd->quote($_POST["specialite"]);


    // insertion des tuples
    $update = "UPDATE medecin SET ID_POSSEDE=$specialite, NOM=$nom, PRENOM=$prenom, ADRESSE=$adresse, VILLE_MEDECIN=$ville, CP_MEDECIN=$cp, TEL=$tel, DEPARTEMENT=$departement WHERE id=$id;";
   
    $bdd->query($update);

    setFlash("success","Modification(s) enregistrée(s) !");
    header('Location:'.WEBROOT);
      die();
  }




///////////////////////////

  // ajout d'un nouveau medecin
  if (isset($_POST['nom']) && $_POST['nom'] != '' && !isset($_GET['id']))
  {
    $nom = $bdd->quote($_POST["nom"]);
    $prenom = $bdd->quote($_POST["prenom"]);
    $adresse = $bdd->quote($_POST["adresse"]);
    $ville = $bdd->quote($_POST["ville"]);
    $cp = $bdd->quote($_POST["cp"]);
    $tel = $bdd->quote($_POST["tel"]);
    $departement = $bdd->quote($_POST["departement"]);
    $specialite = $bdd->quote($_POST["specialite"]);


    // insertion des tuples
    $insertion = "INSERT INTO medecin ( ID_POSSEDE, NOM, PRENOM, ADRESSE, VILLE_MEDECIN, CP_MEDECIN, TEL, DEPARTEMENT)
                  VALUES ($specialite, $nom, $prenom, $adresse, $ville, $cp, $tel, $departement);";

    $bdd->query($insertion);
    flashMessage("success","Enregistrement effectué !");

    ////////////// RE - INIT /////////////////

    $nom = "nom";
    $prenom = "prénom";
    $adresse = "adresse";
    $ville = "ville";
    $cp = "XXXXX";
    $tel = "xx xx xx xx xx";
    $departement = "xx";

    $nomValue = "";
    $prenomValue = "";
    $adresseValue = "";
    $villeValue = "";
    $cpValue = "";
    $telValue = "";
    $departementValue = "";

    $ok = false;

  }


///////////////////////////



  // recupération des libelles de la table "specialite"
  $requete_spe = "SELECT ID, LIBELLE FROM specialite ORDER BY 2;";
  $result_spe = $bdd->query($requete_spe);

  include("partials/header.php");
  include("partials/navbar.php");
?>

<div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-6">
    <div class="well bs-component">

      <form class="form-horizontal" action="#" method="POST">

        <fieldset>
          <legend>Ajouter un médecin</legend>
          <div class="form-group">
            <label for="nom" class="col-lg-2 control-label">Nom</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="nom" id="nom" value="<?= $nomValue; ?>" placeholder="<?= $nom; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="prenom" class="col-lg-2 control-label">Prénom</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="prenom" id="prenom"  value="<?= $prenomValue; ?>" placeholder="<?= $prenom; ?>">
            </div>
          </div>

           <div class="form-group">
            <label for="select" class="col-lg-2 control-label">Spécialité</label>
            <div class="col-lg-10">
              <select class="form-control" name="specialite" id="specialite">
                <?php
                  while ($value = $result_spe->fetch())
                  {
                    if($specialite == $value['LIBELLE']){
                      echo "<option selected='selected' value=$idSpe >$specialite</option>";
                    }else{
                      echo "<option value='".$value['ID']."'>".$value['LIBELLE']."</option>";
                    }
                  }
                  $result_spe->closeCursor();
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="adresse" class="col-lg-2 control-label">Adresse</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="adresse" id="adresse" value="<?= $adresseValue; ?>" placeholder="<?= $adresse; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="ville" class="col-lg-2 control-label">Ville</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="ville" id="ville" value="<?= $villeValue; ?>" placeholder="<?= $ville; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="cp" class="col-lg-2 control-label">Code postal</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="cp" id="cp" value="<?= $cpValue; ?>" placeholder="<?= $cp; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="tel" class="col-lg-2 control-label">Téléphone</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="tel" id="tel" value="<?= $telValue; ?>" placeholder="<?= $tel; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="departement" class="col-lg-2 control-label">Département</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="departement" id="departement" value="<?= $departementValue; ?>" placeholder="<?= $departement; ?>">
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
