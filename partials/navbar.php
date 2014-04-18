<div class="bs-component">
  <div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">
          <?php setlocale (LC_TIME, 'fr_FR.ISO-8859-1','fra');
                echo (strftime("%A %d %B")); ?>
      </a>
    </div>
    <div class="navbar-collapse collapse navbar-inverse-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Accueil</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download"><?php echo $_SESSION["nom"]." ". $_SESSION["prenom"]?> <span class="caret"></span></a>
          <ul class="dropdown-menu" aria-labelledby="download">
            <li><a href="user_account.php">Modifier les infos</a></li>
            <li><a href="logout.php">Deconnexion</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
<br>
<br>
<br>