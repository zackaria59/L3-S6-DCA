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

    private $auteur;

    /**
     * projet constructor.
     * @param $titre
     * @param $description
     * @param $nbEtudiant
     * @param $technologie
     * @param $urlFichier
     * @param $auteur
     */

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
        $this->urlFichier = $urlFichier;
    }

    /**
     * @return mixed
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param mixed $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }





}