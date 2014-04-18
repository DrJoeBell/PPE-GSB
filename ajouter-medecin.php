<?php 
  session_start();
  include("lib/database_connexion.php");
  include("lib/function.php");

  $nom = $_SESSION['nom'];
  $prenom = $_SESSION['prenom'];


  if (isset($_POST['nom']))
  {
    $nom=$bdd->quote($_POST["nom"]);
    $prenom=$bdd->quote($_POST["prenom"]);
    $adresse=$bdd->quote($_POST["adresse"]);
    $ville=$bdd->quote($_POST["ville"]);
    $cp=$bdd->quote($_POST["cp"]);
    $tel=$bdd->quote($_POST["tel"]);
    $departement=$bdd->quote($_POST["departement"]);
    $specialite=$bdd->quote($_POST["specialite"]);




    // insertion des tuples
    $insertion = "INSERT INTO medecin ( ID_POSSEDE, NOM, PRENOM, ADRESSE, VILLE_MEDECIN, CP_MEDECIN, TEL, DEPARTEMENT)
                  VALUES ($specialite, $nom, $prenom, $adresse, $ville, $cp, $tel, $departement);";

    $bdd->query($insertion);
    flashMessage("success","Enregistrement effectué !");
  }
  // recupération des libelle de la table "specialite"
    $requete_spe = "SELECT ID, LIBELLE FROM specialite;";
    $result_spe = $bdd->query($requete_spe);


  include("partials/header.php");
  include("partials/navbar.php");

?>

      <fieldset>
        <label>Adresse</label>
        <textarea id="textarea" style="width:40%" cols="30" rows="1" name="adresse" placeholder="Adresse"></textarea>
      </fieldset>

      <fieldset>
        <label>Ville</label>
        <textarea id="textarea" style="width:40%" cols="30" rows="1" name="ville" placeholder="Ville"></textarea>
      </fieldset>

      <fieldset>
        <label>Code postal</label>
        <textarea id="textarea" style="width:40%" cols="30" rows="1" name="cp" placeholder="xxxxx"></textarea>
      </fieldset>

      <fieldset>
        <label>Téléphone</label>
        <textarea id="textarea" style="width:40%" cols="30" rows="1" name="tel" placeholder="xx xx xx xx xx"></textarea>
      </fieldset>

      <fieldset>
        <label>Département</label>
        <textarea id="textarea" style="width:40%" cols="30" rows="1" name="departement" placeholder="xx"></textarea>
      </fieldset>

      <hr>

      <button style="margin:auto; width:40%;" type="submit" class="btn span6">Enregistrer</button>
    </form>


<div class="row">
  <div class="col-lg-9">
    <div class="well bs-component">
      <form class="form-horizontal">
        <fieldset>
          <legend>Ajouter un practicien pour le commercial :&nbsp;<?= $_SESSION['nom'] .'&nbsp;'. $_SESSION['prenom'] ;?></legend>
          <div class="form-group">
            <label for="nom" class="col-lg-2 control-label">Nom</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" id="nom" placeholder="Nom">
            </div>
          </div>

          <div class="form-group">
            <label for="prenom" class="col-lg-2 control-label">Prénom</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" id="prenom" placeholder="Prénom">
            </div>
          </div>

           <div class="form-group">
            <label for="select" class="col-lg-2 control-label">Spécialité</label>
            <div class="col-lg-10">
              <select class="form-control" id="select">
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
              <input type="text" class="form-control" id="adresse" placeholder="Adresse">
            </div>
          </div>

          <div class="form-group">
            <label for="adresse" class="col-lg-2 control-label">Adresse</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" id="adresse" placeholder="Adresse">
            </div>
          </div>

          <div class="form-group">
            <label for="adresse" class="col-lg-2 control-label">Adresse</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" id="adresse" placeholder="Adresse">
            </div>
          </div>

          <div class="form-group">
            <label for="adresse" class="col-lg-2 control-label">Adresse</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" id="adresse" placeholder="Adresse">
            </div>
          </div>

          <div class="form-group">
            <label for="adresse" class="col-lg-2 control-label">Adresse</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" id="adresse" placeholder="Adresse">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Radios</label>
            <div class="col-lg-10">
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                  Option one is this
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                  Option two can be something else
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="select" class="col-lg-2 control-label">Selects</label>
            <div class="col-lg-10">
              <select class="form-control" id="select">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
              <br>
              <select multiple="" class="form-control">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
              <button class="btn btn-default">Cancel</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>





<?php include("partials/footer.php");?>
