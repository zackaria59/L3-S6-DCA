<?php
/**
 * Created by PhpStorm.
 * User: brahi
 * Date: 03/03/2018
 * Time: 12:45
 */


class Projet
{
    private $idProjet;
    private $titre;
    private $description;
    private $nbEtudiant;
    private $technologie;
    private $urlFichier;
    private $idProfesseur;
    private $dateP;

    /**
     * @return mixed
     */
    public function getDateP()
    {
        return $this->dateP;
    }

    /**
     * @param mixed $date
     */
    public function setDateP($dateP)
    {
        $this->dateP = $dateP;
    }


    /**
     * @return mixed
     */
    public function getIdProjet()
    {
        return $this->idProjet;
    }

    /**
     * @param mixed $idProjet
     */
    public function setIdProjet($idProjet)
    {
        $this->idProjet = $idProjet;
    }


    /**
     * projet constructor.
     * @param $titre
     * @param $description
     * @param $nbEtudiant
     * @param $technologie
     * @param $urlFichier
     * @param $auteur
     */

    public function __construct($donnees)
    {
        if(!empty($donnees))
        {
            $this->hydrate($donnees);
        }
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);

            // Si le setter correspondant existe.
            if (method_exists($this, $method))
            {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }

    /*
    public function __construct($idProjet, $titre, $description, $nbEtudiant, $technologie, $urlFichier, $auteur, $groupe)
    {
        $this->titre = $titre;
        $this->description = $description;
        $this->nbEtudiant = $nbEtudiant;
        $this->technologie = $technologie;
        $this->urlFichier = $urlFichier;
        $this->auteur = $auteur;
        $this->groupe = $groupe;
        $this->idProjet = $idProjet;
    }
    */

    public function ajouterBDD($db){

        $req = $db->prepare("INSERT INTO projet (titre, technologie, description, urlFichier, nbEtudiant) VALUES (:titre, :technologie, :description, :urlFichier,:nbEtudiant)");
        $req->execute(array(
            "titre" => $this->getTitre(),
            "technologie" => $this->getTechnologie(),
            "description" => $this->getDescription(),
            "urlFichier" => $this->getUrlFichier(),
            "nbEtudiant" => $this->getNbEtudiant()
        ));

        $req->execute();
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        echo $titre.' ';
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
        echo $description.' ';
    }

    /**
     * @return mixed
     */
    public function getNbEtudiant()
    {
        return $this->nbEtudiant;
    }

    /**
     * @param mixed $nbEtudiant
     */
    public function setNbEtudiant($nbEtudiant)
    {
        $this->nbEtudiant = $nbEtudiant;
        echo $nbEtudiant.' ';
    }

    /**
     * @return mixed
     */
    public function getTechnologie()
    {
        return $this->technologie;
    }

    /**
     * @param mixed $technologie
     */
    public function setTechnologie($technologie)
    {
        $this->technologie = $technologie;
        echo $technologie.' ';
    }

    /**
     * @return mixed
     */
    public function getUrlFichier()
    {
        return $this->urlFichier;
    }

    /**
     * @param mixed $urlFichier
     */

    public function setUrlFichier($urlFichier)
    {
        $urlFichier = strtr($urlFichier,
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $urlFichier = preg_replace('/([^.a-z0-9]+)/i', '-', $urlFichier);
        $this->urlFichier = $urlFichier;
        echo $urlFichier.' ';
    }

    /**
     * @return mixed
     */
    public function getIdProfesseur()
    {
        return $this->idProfesseur;
    }

    /**
     * @param mixed $auteur
     */
    public function setIdProfesseur($idProfesseur)
    {
        $this->idProfesseur = $idProfesseur;
        echo $idProfesseur.' ';
    }





}