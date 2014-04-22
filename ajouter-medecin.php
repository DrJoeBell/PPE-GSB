<?php 
  session_start();
  include("lib/database_connexion.php");
  include("lib/function.php");
  include("lib/constants.php");


  // si le nom est saisie et non nul
  if (isset($_POST['nom']) && $_POST['nom'] != '')
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
  }

  // recupération des libelles de la table "specialite"
  $requete_spe = "SELECT ID, LIBELLE FROM specialite;";
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
              <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom">
            </div>
          </div>

          <div class="form-group">
            <label for="prenom" class="col-lg-2 control-label">Prénom</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prénom">
            </div>
          </div>

           <div class="form-group">
            <label for="select" class="col-lg-2 control-label">Spécialité</label>
            <div class="col-lg-10">
              <select class="form-control" name="specialite" id="specialite">
                <?php
                  while ($value = $result_spe->fetch())
                  {
                    echo "<option value='".$value['ID']."'>".$value['LIBELLE']."</option>";
                  }
                  $result_spe->closeCursor();
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="adresse" class="col-lg-2 control-label">Adresse</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse">
            </div>
          </div>

          <div class="form-group">
            <label for="ville" class="col-lg-2 control-label">Ville</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville">
            </div>
          </div>

          <div class="form-group">
            <label for="cp" class="col-lg-2 control-label">Code postal</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="cp" id="cp" placeholder="XXXXX">
            </div>
          </div>

          <div class="form-group">
            <label for="tel" class="col-lg-2 control-label">Téléphone</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="tel" id="tel" placeholder="xx xx xx xx xx">
            </div>
          </div>

          <div class="form-group">
            <label for="departement" class="col-lg-2 control-label">Département</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="departement" id="departement" placeholder="XX">
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
