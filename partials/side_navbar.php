    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span2">
                <div style="margin-top:20" class="well sidebar-nav">
                    <ul class="nav nav-list">
                        <li class="nav-header">Comptes-rendus</li>
                        <li>
                            <a href="compte_rendu.php">
                                <img src="assets/img/glyphicons_027_search.png" width="12em"/>
                                &nbsp;Rechercher
                            </a>
                        </li>
                        <li>
                            <a href="ajouter_compte_rendu.php">
                                <img src="assets/img/plus.png" width="12em"/>
                                &nbsp;Ajouter
                            </a>
                        </li>
                        <li>
                            <a href="afficher_compte_rendu.php?id=all">
                                <img src="assets/img/glyphicons_325_wallet.png" width="12em"/>
                                &nbsp;Afficher&nbsp;<span class="badge"><?php echo nombre_compte_rendu(); ?></span>
                            </a>
                        </li>

            <!--  concernant les médecins  -->
                        <li class="nav-header">Practiciens</li>
                        <li>
                            <a href="rechercher_medecin.php">
                                <img src="assets/img/glyphicons_027_search.png" width="12em"/>
                                &nbsp;Rechercher
                            </a>
                        </li>
                        <li>
                            <a href="ajouter_medecin.php">
                                <img src="assets/img/plus.png" width="12em"/>
                                &nbsp;Ajouter
                            </a>
                        </li>
                        <li>
                            <a href="afficher_medecin.php?id=all">
                                <img src="assets/img/glyphicons_025_binoculars.png" width="12em"/>
                                &nbsp;Afficher&nbsp;<span class="badge"><?php echo nombre_medecin(); ?></span>
                            </a>
                        </li>
                    </ul>
                </div><!--/.well -->
            </div><!--/span-->