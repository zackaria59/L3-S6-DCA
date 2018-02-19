<?php

if(isset($_GET["action"]) && isset($_POST["id"]) && isset($_POST["mdp"]))
{
	
		if($_GET["action"]=="connexion")
		{
			require("traitementConnexion.php");
			
			if(connexion_autorise($_POST ["id"],$_POST ["mdp"]))
			{
				if($_SESSION['type']==1)
				header("Location:/projets6/admin/appAdmin.php");
				else if($_SESSION['type']==2)
				header("Location:/projets6/admin/appProfesseur.php");
				else if($_SESSION['type']==3)
				header("Location:/projets6/admin/appEtudiant.php");
			}
			else{
				header("Location:/projets6");
			}
				
		}
}


?>