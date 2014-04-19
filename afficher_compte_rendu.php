<?php 
  session_start();
  include("lib/database_connexion.php");
  include("lib/function.php");
  include("lib/constants.php");
if (isset($_GET['page']) && is_numeric($_GET['page'])){
      $page = $_GET['page'];
      $nbParPage = 2;
      $limit = ($page-1) * $nbParPage;
      
      if (isset($_GET['q'])) {
          $search= substr_replace($_GET['q'], '%', 0, 0); //ajoute % au debut
          $search .= '%'; // ajoute % a la fin
          $search = $bdd->quote($search);
          $query = 
              "SELECT r.ID, r.DATERAPPORT, r.BILAN, mo.libelle as motif, m.NOM as nomRedige, v.NOM as nomVisite, m.PRENOM as prenomRedige, v.PRENOM as prenomVisite FROM rapport r
                INNER JOIN medecin m ON m.ID = r.ID_REDIGER
                INNER JOIN visiteur v ON v.ID = r.ID_CONCERNE
                INNER JOIN motif mo ON mo.ID = r.MOTIF
                 WHERE r.BILAN lIKE ".$search." ORDER BY r.ID LIMIT $limit, $nbParPage";
          $result=$bdd->query($query);
          $rapport = $result->fetchAll();
          if($result->rowCount()<1){
            if ($page==1) {
            setFlash("warning","Aucun résultats ne correspond à votre recherche.");
            header('Location: '.WEBROOT.'afficher_compte_rendu.php?page=1');
            die();
            }
            setFlash("info","Il n'y a plus de compte-rendu ensuite pour votre recherche, vous avez été redirigé en première page.");
            header('Location: '.WEBROOT.'afficher_compte_rendu.php?page=1&q='.$_GET['q']);
            die();
          }
          $title = "<small>Rechercher: '".$_GET['q']."'</small>";

        }
        else{
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
  <h1>
  Affichage des compte-rendu
  <?php
    if (isset($title)) {
      echo($title);
    }
  ?>
  </h1>
  <div class="row">
    
      <?php foreach($rapport as $CompteRendu):?>
          <article class="compte-rendu-list row">
            <div class="col-xs-12 col-sm-12 col-md-3">
              <ul class="meta-search">
                <li><i class="glyphicon glyphicon-calendar"></i> <span>&nbsp;<?= $CompteRendu['DATERAPPORT'];?></span></li>
                <li><i class="glyphicon glyphicon-flag" ></i> <span>&nbsp;<?= $CompteRendu['motif'];?></span></li>
                <li><i class="glyphicon glyphicon-user" ></i> <span>&nbsp;Auteur: <?= $CompteRendu['nomRedige'].' '.$CompteRendu['prenomRedige'];?></span></li>
                <li><i class="glyphicon glyphicon-user" ></i> <span>&nbsp;Visiteur: <?= $CompteRendu['nomVisite'].' '.$CompteRendu['prenomVisite'];?></span></li>
              </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9">
            <div class="panel panel-primary">
              <div class="panel-heading">Bilan:</div>
                <div class="panel-body">
                  <p><?= $CompteRendu['BILAN'];?></p>
                </div>
              </div>
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
        $hrefPrevious = WEBROOT."afficher_compte_rendu.php?page=".($_GET['page']-1);
      }
      $hrefNext = WEBROOT."afficher_compte_rendu.php?page=".($_GET['page']+1);
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


<?php include("partials/footer.php");?>
