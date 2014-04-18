<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="#">
                <?php setlocale (LC_TIME, 'fr_FR.ISO-8859-1','fra');
                echo (strftime("%A %d %B")); ?>
            </a>
            <div class="nav-collapse collapse">
                <ul class="nav" role="navigation">
                    <li>
                        <a href="index.php">
                            <img src="assets/img/glyphicons_020_home-blanc.png" width="20em"/>
                            &nbsp;Accueil
                        </a>
                    </li>
                </ul>
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="assets/img/glyphicons_003_user-blanc.png"/>
                            <?php echo $_SESSION["nom"]." ". $_SESSION["prenom"]?>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="user_account.php">
                                    <img src="assets/img/glyphicons_137_cogwheels.png" width="13em"/>
                                    &nbsp;Mon compte
                                </a>
                            </li>
                            <li>
                                <a href="logout.php">
                                    <img src="assets/img/glyphicons_063_power.png" width="10%"/>
                                    &nbsp;Déconnexion
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>