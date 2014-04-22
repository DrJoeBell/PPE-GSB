<div class="bs-component">
  <div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">

      </a>
    </div>
    <div class="navbar-collapse collapse navbar-inverse-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?= WEBROOT ;?>"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Accueil</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">
            <span class="glyphicon glyphicon-file"></span>
            &nbsp;&nbsp;Comptes Rendus&nbsp;&nbsp;<span class="caret"></span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="download">
            <li><a href="<?= WEBROOT ;?>ajouter-compte-rendu.php">
                  <span class="glyphicon glyphicon-plus"></span>
                  Ajouter un compte rendu
                </a>
            </li>
            <li><a href="<?= WEBROOT ;?>afficher_compte_rendu.php?page=1">
                  <span class="glyphicon glyphicon-bookmark"></span>
                  Afficher les comptes rendus
                </a>
            </li>
            <li>
              <!-- Small modal -->
              <a href="#" data-toggle="modal" data-target=".bs-example-modal-sm">
              <span class="glyphicon glyphicon-search"></span>
              Rechercher</a>
            </li>
          </ul>
        </li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">
            <span class="glyphicon glyphicon-briefcase"></span>
            &nbsp;&nbsp;Médecins&nbsp;&nbsp;<span class="caret"></span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="download">
            <li><a href="<?= WEBROOT ;?>ajouter-medecin.php">
                  <span class="glyphicon glyphicon-plus"></span>
                  Ajouter un médecin
                </a>
            </li>
            <li><a href="<?= WEBROOT ;?>afficher_medecin.php?page=1">
                  <span class="glyphicon glyphicon-bookmark"></span>
                  Afficher les fiches médecins
                </a>
            </li>
          </ul>
        </li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">
            <span class="glyphicon glyphicon-user"></span>
            &nbsp;&nbsp;<?php echo $_SESSION["nom"]." ". $_SESSION["prenom"]?>
            <span class="caret"></span>&nbsp;&nbsp;
          </a>
          <ul class="dropdown-menu" aria-labelledby="download">
            <li><a href="<?= WEBROOT ;?>user_account.php">
                  <span class="glyphicon glyphicon-edit"></span>
                  Modifier les informations
                </a>
            </li>
            <li><a href="<?= WEBROOT ;?>logout.php">
                  <span class="glyphicon glyphicon-off"></span>
                  Deconnexion
                </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
<br>
<br>
<br>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <form action="afficher_compte_rendu.php" method="get">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Compte-rendu</h4>
        </div>
        <div class="modal-body">
            <p>
             <div class="input-group">
              <input type="text" value="1" name="page" hidden>
              <input type="text" placeholder="Rechercher..." name="q" class="form-control">
              <span class="input-group-btn">
                <button class="btn btn-danger" type="submit">Go!</button>
              </span>
            </div><!-- /input-group -->
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
          <button class="btn btn-primary" type="submit">Rechercher</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php flashmessage(); ?>
