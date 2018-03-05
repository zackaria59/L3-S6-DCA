<?php
/**
 * Created by PhpStorm.
 * User: brahi
 * Date: 03/03/2018
 * Time: 14:11
 */

class gestionEtudiant
{

    private $db;

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * gestionEtudiant constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }


    public function addEtudiant(Etudiant $etudiant)
    {
        $req = $this->getDb()->prepare("INSERT INTO etudiant (nom, prenom, identifiant, mdp, adresseMail) VALUES (:nom, :prenom, :identifiant, :mdp,:adresseMail)");
        $req->execute(array(
            "nom" => $this->getNom(),
            "prenom" => $this->getPrenom(),
            "identifiant" => $this->getIdentifiant(),
            "mdp" => $this->getMdp(),
            "adresseMail" => $this->getAdresseMail()
        ));

        $req->execute();
    }

    public function deleteEtudiant(Etudiant $etudiant)
    {

        $stmt = $this->db->prepare("delete FROM etudiant WHERE id = :id");
        $stmt->bindValue('id', $etudiant->getIdEtudiant(), PDO::PARAM_STR);
        $stmt->execute();

    }

    public function  updateEtudiant(Etudiant $etudiant)
    {


    }

    public function getListeEtudiant()
    {
        $etudiants=[];

        $req = $this->_db->query('SELECT id, nom, forcePerso, degats, niveau, experience FROM personnages ORDER BY nom');

        while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
        {
            $etudiants[] = new Etudiant($donnees);
        }

        return $etudiants;
    }
}