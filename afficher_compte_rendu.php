<?php 
  session_start();
  include("lib/database_connexion.php");
  include("lib/function.php");
  include("lib/constants.php");
if (isset($_GET['page']) && is_numeric($_GET['page'])){
      $page = $_GET['page'];
      $nbParPage = 2;
      $limit = ($page-1) * $nbParPage;
      
      $query = 
      "SELECT r.DATERAPPORT, r.BILAN, mo.libelle as motif, m.NOM as nomRedige, v.NOM as nomVisite, m.PRENOM as prenomRedige, v.PRENOM as prenomVisite
        FROM rapport r
        INNER JOIN medecin m ON m.ID = r.ID_REDIGER
        INNER JOIN visiteur v ON v.ID = r.ID_CONCERNE
        INNER JOIN motif mo ON mo.ID = r.MOTIF
        ORDER BY r.ID LIMIT $limit, $nbParPage";

      $result = $bdd->query($query);
      $rapport = $result->fetchAll();
      if($result->rowCount()<1){
        setFlash("info","Il n'y a plus de compte-rendu ensuite, vous avez été redirigé en première page.");
        header('Location: '.WEBROOT.'afficher_compte_rendu.php?page=1');
        die();
      }
}
elseif (isset($_GET['id']) && is_numeric($_GET['id'])) {
      $IdRapport = $bdd->quote($_GET['id']);
      $query = 
      "SELECT r.ID, r.DATERAPPORT, r.BILAN, mo.libelle as motif, m.NOM as nomRedige, v.NOM as nomVisite, m.PRENOM as prenomRedige, v.PRENOM as prenomVisite FROM rapport r
        INNER JOIN medecin m ON m.ID = r.ID_REDIGER
        INNER JOIN visiteur v ON v.ID = r.ID_CONCERNE
        INNER JOIN motif mo ON mo.ID = r.MOTIF
         WHERE r.ID=".$IdRapport;
      $result=$bdd->query($query);
      $rapport = $result->fetchAll();
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
  <h1>Affichage des compte-rendu</h1>
  <hr>
  <div class="row">
    
      <?php foreach($rapport as $CompteRendu):?>
          <div class="well">
            <h4><span class="glyphicon glyphicon-time"></span> <?= $CompteRendu['DATERAPPORT'];?></h4>
            <blockquote style="font-size:15px;"><?= $CompteRendu['BILAN'];?></blockquote style="text:10px;">
            <div>Motif: <?= $CompteRendu['motif'];?></div>
            <div>Rédiger par: <?= $CompteRendu['nomRedige'].' '.$CompteRendu['prenomRedige'];?></div>
            <div>Visiteur: <?= $CompteRendu['nomVisite'].' '.$CompteRendu['prenomVisite'];?></div>
          </div>
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
      $hrefPrevious = WEBROOT."afficher_compte_rendu.php?page=".($_GET['page']-1);
      }
      $hrefNext = WEBROOT."afficher_compte_rendu.php?page=".($_GET['page']+1);
      ?>
      <ul class="pager">
      <li class="previous <?= $classePrevious; ?>"><a href="<?= $hrefPrevious; ?>">&larr; Précédents</a></li>
      <li>Page <?= $_GET['page']; ?></li>
      <li class="next"><a href="<?= $hrefNext; ?>">Suivants &rarr;</a></li>
    </ul>
<?php endif; ?>

</div>


<?php include("partials/footer.php");?>
