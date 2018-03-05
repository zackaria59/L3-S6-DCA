<?php

if(isset($_GET["action"]) && isset($_POST["id"]) && isset($_POST["mdp"]))
{

		if($_GET["action"]=="connexion")
		{
			require("../model/traitementConnexion.php");

			if(connexion_autorise($_POST ["id"],$_POST ["mdp"]))
			{
				if($_SESSION['type']==1)
				header("Location:/L3-S6-DCA/view/admin/appAdmin.php");
				else if($_SESSION['type']==2)
				header("Location:/L3-S6-DCA/view/professeur/appProfesseur.php");
				else if($_SESSION['type']==3)
				header("Location:/L3-S6-DCA/view/etudiant/appEtudiant.php");
			}
			else{
				header("Location:/L3-S6-DCA");
			}

		}
}


?>
