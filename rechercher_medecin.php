<?php 
session_start();
include("database_connexion.php");
include("header.php");
include("function.php");
include("navbar.php");
include("side_navbar.php");
if (isset($_POST["search"]))
{
    $mot = $_POST["search"];

  if ($mot !="")
  {
    $query= "select * from medecin where NOM like '%$mot%'";
    $result = $bdd->query($query);
    echo "<div class='row-fluid'>";
    $query= "select * from medecin where PRENOM like '%$mot%'";
    $result = $bdd->query($query);
    echo "<div class='row-fluid'>";
    echo "<div class='span4'>
    			<table style='margin:20'class='table table-bordered table-hover'>
    				<thead>
    					<tr>
    						<th>Nom</th>
    						<th>Prénom</th>
    					</tr>
    				</thead>
    				<tbody>";
    while($value =$result->fetch())
    {
      echo "
      			<tr>
      				<td>".$value['NOM']."</td>
      				<td>".$value['PRENOM']."</td>
      				<td><a class='btn' href='afficher_medecin.php?id=".$value['ID']."'>Détails &raquo;</a></td>
      			</tr>
      		";
    }
    echo "</tbody></table></div></div>";
    $result->closeCursor();
    $count = $result->rowCount();
      if ($count==0)
      {
          flashMessage("alert","Aucun résultat");

      }
  }
}
else{
  ?>
<div class="span9 offset1 container">
    <div class="row-fluid">
    <h4 style="margin:20 0 0 -10"><i class="icon-plus-sign-alt"></i>Rechercher parmi les médecins</h4>
    <hr>
    <div class="clearfix">
        <form method="POST" action="rechercher_medecin.php">
            <fieldset>
                <label>Rechercher un médecin</label>
                <input type="text" class="input-medium search-query" placeholder="Rechercher..." name="search"  size="80" autofocus>
                <br/>
                <br/>
                <button type="submit" class="btn">Recherche</button>
            </fieldset>
        </form>
    </div>
<?php
}
include("footer.php");
?>