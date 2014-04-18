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
            <li><a href="<?= WEBROOT ;?>afficher_medecin.php">
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
            <span class="caret"></span>
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
<?php flashmessage(); ?>
