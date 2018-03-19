<?php
//1' OR 1=1 #
require("bdd/gestionBDD.php");


	function connexion_autorise($id,$mdp)
	{
		$connexion=new gestionBDD();
		$db=$connexion->connexionDB();
		$autorisation=false;

		$flag=false;  // devient true si on identifie le type d'utilisateur

		// On vérifie si l'id et mdp entrée correspond à un compte 'Admin'
		$result=$db->prepare("select * from admin where id=? AND mdp=?");
		$result->execute(array($id, $mdp));
		if($row=$result->fetch())
		{
			$autorisation=true;
			session_start();
			$_SESSION['type']=1;
            $_SESSION['nom']='Administrateur';
			$flag=true;
		}

		// On vérifie si l'id et mdp entrée correspond à un compte 'Professeur'
		$result=$db->prepare("select idprofesseur from professeur where identifiant=? AND mdp=?");
		$result->execute(array($id, $mdp));
		if($row=$result->fetch() && !$flag)
		{
			$autorisation=true;
			$_SESSION['type']=2;$_SESSION['nom']=$row['nom'];$_SESSION['prenom']=$row['prenom'];$_SESSION['mail']=$row['adresseMail'];
		}

		// On vérifie si l'id et mdp entrée correspond à un compte 'Etudiant'
		$result=$db->prepare("select idetudiant from etudiant where identifiant=?' AND mdp=?");
		$result->execute(array($id, $mdp));
		if($row=$result->fetch() && !$flag)
		{
			$autorisation=true;
			$_SESSION['type']=3;$_SESSION['nom']=$row['nom'];$_SESSION['prenom']=$row['prenom'];$_SESSION['mail']=$row['adresseMail'];
		}



		return $autorisation;  // autorisation = 0 => connexion refusé
	}						   // autorisation = 1 => connexion Admin
							   // autorisation = 2 => connexion Professeur
							   // autorisation = 3 => connexion Etudiant

	?>
