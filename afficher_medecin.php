<?php 
  session_start();
  include("lib/constants.php");
  include("lib/database_connexion.php");
  include("lib/function.php");
if (isset($_GET['page']) && is_numeric($_GET['page'])){
      $page = $_GET['page'];
      $nbParPage = 4;
      $limit = ($page-1) * $nbParPage;
      
      if (isset($_GET['q'])) {
          $search= substr_replace($_GET['q'], '%', 0, 0); //ajoute % au debut
          $search .= '%'; // ajoute % a la fin
          $search = $bdd->quote($search);
          $query = 
              "SELECT * FROM medecin
                WHERE nom LIKE ".$search." OR prenom LIKE ".$search." ORDER BY nom DESC LIMIT $limit, $nbParPage";
          $result=$bdd->query($query);
          $medecins = $result->fetchAll();
          if($result->rowCount()<1){
            if ($page==1) {
            setFlash("warning","Aucun résultats ne correspond à votre recherche.");
            header('Location: '.WEBROOT.'afficher_medecin.php?page=1');
            die();
            }
            setFlash("info","Il n'y a plus de compte-rendu ensuite pour votre recherche, vous avez été redirigé en première page.");
            header('Location: '.WEBROOT.'afficher_medecin.php?page=1&q='.$_GET['q']);
            die();
          }
          $title = "<small>Rechercher: '".$_GET['q']."'</small>";

        }
        else{
            $query = 
            "SELECT * FROM medecin
              ORDER BY nom DESC LIMIT $limit, $nbParPage";

            $result = $bdd->query($query);
            $medecins = $result->fetchAll();  
          if($result->rowCount()<1){
            setFlash("info","Il n'y a plus de compte-rendu ensuite, vous avez été redirigé en première page.");
            header('Location: '.WEBROOT.'afficher_medecin.php?page=1');
            die();
          }
        }

}
elseif (isset($_GET['id']) && is_numeric($_GET['id'])) {
      $IdRapport = $bdd->quote($_GET['id']);
      $query = 
      "SELECT * FROM medecin
        WHERE ID = ".$IdRapport;
      $result=$bdd->query($query);
      $medecins = $result->fetchAll();
}
else{
      setFlash("danger","L'id saisi est incorrect");
       header('Location: '.WEBROOT);
       die();
}

  include("partials/header.php");
  include("partials/navbar.php");
?>
<div class="container">
  <h1>
  Affichage des médecins
  <?php
    if (isset($title)) {
      echo($title);
    }
  ?>
  </h1>
  <div class="row">
    
      <?php foreach($medecins as $unMedecin):?>
          <article class="compte-rendu-list row">
            <div class="col-md-2">
            <img src="<?= WEBROOT ?>images/portrait-medecin.jpg" class="img-thumbnail">
            </div>
            <div class="col-md-10">
              <ul>
                <li><h3><?= $unMedecin['NOM'].' '.$unMedecin['PRENOM'] ?></h3></li>
                <li><span class="glyphicon glyphicon-globe"></span>&nbsp;<?= $unMedecin['ADRESSE'] ?></li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $unMedecin['VILLE_MEDECIN'] ?></li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $unMedecin['CP_MEDECIN'] ?></li>
                <li><span class="glyphicon glyphicon-earphone"></span>&nbsp;<?= $unMedecin['TEL'] ?></li>
              </ul>
            </div>
          </article>

      <?php endforeach; ?>
      
  </div>
<?php  if (isset($_GET['page'])): ?>

      <?php
      if ($_GET['page']==1) {
        $classePrevious = 'disabled';
        $hrefPrevious = '#';
      }
      else{
        $classePrevious = '';
        $hrefPrevious = WEBROOT."afficher_medecin.php?page=".($_GET['page']-1);
      }
      $hrefNext = WEBROOT."afficher_medecin.php?page=".($_GET['page']+1);
      if (isset($_GET['q'])) {
        $hrefPrevious.="&q=".$_GET['q'];
        $hrefNext .="&q=".$_GET['q'];
      }
      ?>
      <ul class="pager">
      <li class="previous <?= $classePrevious; ?>"><a href="<?= $hrefPrevious; ?>">&larr; Précédents</a></li>
      <li>Page <?= $_GET['page']; ?></li>
      <li class="next"><a href="<?= $hrefNext; ?>">Suivants &rarr;</a></li>
    </ul>
<?php endif; ?>

</div>


      ?>
<?php include("partials/footer.php");?>