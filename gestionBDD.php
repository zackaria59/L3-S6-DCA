<?php



function connexionDB()
{
	
	$nomServeur = "localhost";
	$nomBDD="projets6"
	$id = "root";
	$mdp = "";

try {
    $conn = new PDO("mysql:host=".$nomServeur.";dbname=".$nomServeur, $id, $mdp);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

	return conn;
}

?>