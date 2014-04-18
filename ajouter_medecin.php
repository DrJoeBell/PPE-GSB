
<?php 
  session_start();
  include("lib/database_connexion.php");
  include("partials/header.php");
  include("lib/function.php");
  include("partials/navbar.php");
  include("partials/side_navbar.php");

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




?>

  <div class="span9 offset1 container">
    <div class="row-fluid">
    <h4 style="margin:20 0 0 -10">
      <i class="icon-plus-sign-alt"></i>Ajouter un practicien pour le commercial :&nbsp;<?= $_SESSION['nom'] .'&nbsp;'. $_SESSION['prenom'] ?></h4>

    <hr>

    <div class="clearfix">
    <!-- ##################################-->
    <form method="POST" action="ajouter_medecin.php">

      <fieldset>
        <label>Nom</label>
        <textarea id="textarea" style="width:40%" cols="30" rows="1" name="nom" placeholder="Nom"></textarea>
      </fieldset>

      <fieldset>
        <label>Prénom</label>
        <textarea id="textarea" style="width:40%" cols="30" rows="1" name="prenom" placeholder="Prénom"></textarea>
      </fieldset>


      <fieldset>
        <label>Spécialité</label>
        <select style="width:40%" name="specialite">
          <?php

            while ($value = $result_spe->fetch())
            {
              echo "<option value='".$value['ID']."'>".$value['LIBELLE']."</option>";
            }
            $result_spe->closeCursor();
          ?>

        </select>
      </fieldset>



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

  </div><!--/.row-->
<?php include("partials/footer.php");?>
