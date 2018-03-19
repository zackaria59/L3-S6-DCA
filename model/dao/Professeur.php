<?php
/**
 * Created by PhpStorm.
 * User: brahi
 * Date: 03/03/2018
 * Time: 13:46
 */

class Professeur
{

    private $idProfesseur;
    private $nom;
    private $prenom;
    private $identifiant;
    private $mdp;
    private $adresseMail;

    /**
     * Etudiant constructor.
     * @param $idProfesseur
     * @param $nom
     * @param $prenom
     * @param $identifiant
     * @param $mdp
     * @param $adresseMail
     */
    public function __construct($idProfesseur, $nom, $prenom, $identifiant, $mdp, $adresseMail)
    {
        $this->idProfesseur = $idProfesseur;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->identifiant = $identifiant;
        $this->mdp = $mdp;
        $this->adresseMail = $adresseMail;
    }

    public function ajouterBDD($db){

        $req = $db->prepare("INSERT INTO professeur (nom, prenom, identifiant, mdp, adresseMail) VALUES (:nom, :prenom, :identifiant, :mdp,:adresseMail)");
        $req->execute(array(
            "nom" => $this->getNom(),
            "prenom" => $this->getPrenom(),
            "identifiant" => $this->getIdentifiant(),
            "mdp" => $this->getMdp(),
            "adresseMail" => $this->getAdresseMail()
        ));

        $req->execute();
    }

    /**
     * @return mixed
     */
    public function getIdProfesseur()
    {
        return $this->idProfesseur;
    }

    /**
     * @param mixed $idEtudiant
     */
    public function setIdProfesseur($idProfesseur)
    {
        $this->idProfesseur= $idProfesseur;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getIdentifiant()
    {
        return $this->identifiant;
    }

    /**
     * @param mixed $identifiant
     */
    public function setIdentifiant($identifiant)
    {
        $this->identifiant = $identifiant;
    }

    /**
     * @return mixed
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * @param mixed $mdp
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    /**
     * @return mixed
     */
    public function getAdresseMail()
    {
        return $this->adresseMail;
    }

    /**
     * @param mixed $adresseMail
     */
    public function setAdresseMail($adresseMail)
    {
        $this->adresseMail = $adresseMail;
    }

}
?>