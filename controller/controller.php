<?php
echo 'bonjour';
if(isset($_GET["action"]))
{

		if($_GET["action"]=="connexion" && isset($_POST["id"]) && isset($_POST["mdp"]))
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
		else if($_GET["action"]=="etudiants")
		{
			require("../model/dao/gestionEtudiant.php");
			getTableauEtudiants();
		}
        else if($_GET["action"]=="professeurs")
        {

            require("../model/dao/gestionProfesseur.php");
            getTableauProfesseurs();
        }
        else if($_GET["action"]=="projets")
        {

            require("../model/dao/gestionProjet.php");
            getTableauProjets();
        }
        else if($_GET["action"]=="ajouteProjet")
        {

            if (isset($_POST['titre']) && isset($_POST['technologie']) && isset($_POST['description']) && isset($_POST['nbEtudiant'])) {
                print_r($_POST);
                require("../model/dao/gestionProjet.php");

                    $projet = new Projet([]);

                    $conn = new gestionBDD();
                    $db = $conn->connexionDB();
                    $gestionP = new gestionProjet($db);

                    $projet->setTitre($_POST['titre']);
                    $projet->setTechnologie($_POST['technologie']);
                    $projet->setDescription($_POST['description']);
                    $projet->setNbEtudiant($_POST['nbEtudiant']);
                    $projet->setIdProfesseur(1);
                    $projet->setUrlFichier('file');
                    $gestionP->addProjet($projet);


            }

        }
}



?>
