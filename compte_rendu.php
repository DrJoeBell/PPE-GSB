<?php 
session_start();
include("lib/database_connexion.php");
include("partials/header.php");
include("lib/function.php");
include("partials/navbar.php");


if (isset($_POST["search"]))
{
    $mot = $_POST["search"];

  if ($mot !="")
  {
    $query= "select * from rapport where BILAN like '%$mot%'";
    $result = $bdd->query($query);
    echo "<div class='row-fluid'>";
    $query= "select * from rapport where BILAN like '%".$_POST["search"]."%'";
    $result = $bdd->query($query);
    echo "<div class='row-fluid'>";
    echo "<div class='span4'>
    			<table style='margin:20'class='table table-bordered table-hover'>
    				<thead>
    					<tr>
    						<th>Date</th>
    						<th>Bilan</th>
    						<th>Accès</th>
    					</tr>
    				</thead>
    				<tbody>";
    while($value =$result->fetch())
    {
      echo "
      			<tr>
      				<td>".$value['DATERAPPORT']."</td>
      				<td>".$value['BILAN']."</td>
      				<td><a class='btn' href='afficher_compte_rendu.php?id=".$value['ID']."'>Détails &raquo;</a></td>
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
    <h4 style="margin:20 0 0 -10"><i class="icon-plus-sign-alt"></i>Rechercher parmi les comptes-rendu</h4>
    <hr>
    <div class="clearfix">
        <form method="POST" action="compte_rendu.php">
            <fieldset>
                <label>Rechercher dans les bilans:</label>
                <input type="text" class="input-medium search-query" placeholder="Rechercher..." name="search"  size="80" autofocus>
                <br/>
                <br/>
                <button type="submit" class="btn">Recherche</button>
            </fieldset>
        </form>
    </div>
<?php
}
include("partials/footer.php");
?>