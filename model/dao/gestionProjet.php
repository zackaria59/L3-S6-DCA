<?php
/**
 * Created by PhpStorm.
 * User: brahi
 * Date: 25/03/2018
 * Time: 13:04
 */

require ('Projet.php');
require ('gestionBDD.php');
class gestionProjet
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



    public function addProjet(Projet $projet)
    {
        $req = $this->getDb()->prepare("INSERT INTO projet (titre, technologie, description, urlFichier, idProfesseur,  nbEtudiant) VALUES ( :titre, :technologie, :description, :urlFichier, :idProfesseur, :nbEtudiant)");
        $req->execute(array(
            "titre" => $projet->getTitre(),
            "technologie" => $projet->getTechnologie(),
            "description" => $projet->getDescription(),
            "urlFichier" => $projet->getUrlFichier(),
            "idProfesseur" => $projet->getIdProfesseur(),
            "nbEtudiant" => $projet->getNbEtudiant()
        ));

        move_uploaded_file($_FILES['file']['tmp_name'],"test");

    }

    public function addFileToServer($file)
    {
        $dossier = 'upload/';
        $fichier = basename($file['name']);
        $taille_maxi = 100000;
        $taille = filesize($file['tmp_name']);
        $extensions = array('.png', '.jpg', '.jpeg');
        $extension = strrchr($file['name'], '.');

        //Début des vérifications de sécurité...
        if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
        {
            $erreur = 'Vous devez uploader un fichier de type png, jpg, jpeg, txt ou doc...';
        }
        if($taille>$taille_maxi)
        {
            $erreur = 'Le fichier est trop gros...';
        }
        if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
        {
            //On formate le nom du fichier ici...
            $fichier = strtr($fichier,
                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
            if(move_uploaded_file($file['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
                echo 'Upload effectué avec succès !';
            }
            else //Sinon (la fonction renvoie FALSE).
            {
                echo 'Echec de l\'upload !';
            }
        }
        else
        {
            echo $erreur;
        }
    }

    public function deleteProjet(Projet $projet)
    {

        $stmt = $this->db->prepare("delete FROM projet WHERE id = :id");
        $stmt->bindValue('id', $projet->getIdProjet(), PDO::PARAM_STR);
        $stmt->execute();

    }

    public function  updateProjet(Projet $projet)
    {
        $req = $this->db->prepare('Update projet set titre=:titre, description=:description, urlFichier=:urlFichier, idProfesseur=:idProfesseur, nbEtudiant=:nbEtudiantwhere idProjet=:idProjet');

        $req->execute(array(
            "titre" => $projet->getTitre(),
            "description" => $projet->getDescription(),
            "urlFichier" => $projet->getUrlFichier(),
            "technologie" => $projet->getTechnologie(),
            "idProfesseur" => $projet->getIdProfesseur(),
            "nbEtudiant" => $projet->getNbEtudiant()
        ));



    }

    public function getListeProjets()
    {
        $projets=[];

        $req = $this->db->query('SELECT * FROM projet ORDER BY titre');

        while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
        {
            $projets[] = new Projet($donnees);
        }

        return $projets;
    }

    public function getNomAuteur(Projet $projet)
    {
        $req = $this->db->query('SELECT nom FROM professeur where idProfesseur='.$projet->getIdProfesseur());

        if ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {


            return $donnees['nom'];
        }

    }

    public function getTabHtml($projets)
    {
        $html="";
        foreach ($projets as $projet){

            $id=$projet->getIdProjet();
            $ligneTitre='<td><input id="titre'.$id.'" class="form-control" type="text" value="'.$projet->getTitre().'" disabled>';
            $ligneDescription='<td><input id="description'.$id.'" class="form-control" type="text" value="'.$projet->getDescription().'" disabled>';
            $ligneTechnologie='<td><input id="technologie'.$id.'" class="form-control" type="text" value="'.$projet->getTechnologie().'" disabled>';
            $ligneNbEtudiant='<td><input id="nbEtudiant'.$id.'" class="form-control" type="text" value="'.$projet->getNbEtudiant().'" disabled>';
            $ligneDate='<td><input id="date'.$id.'" class="form-control" type="text" value="'.$projet->getDateP().'" disabled>';
            $ligneNomProfesseur='<td><input  id="auteur'.$id.'" class="form-control" type="text" value="'.$this->getNomAuteur($projet).'" disabled>';
            $ligneUrlFichier='<td onclick=""><span class="glyphicon glyphicon-download-alt"></span></td>';

            $html.='<tr id="'.$id.'">'.$ligneTitre.$ligneNomProfesseur.$ligneTechnologie.$ligneNbEtudiant.$ligneDate.$ligneUrlFichier.'</tr>';
        }

        return $html;
    }
}




/*****************************************************/

function getTableauProjets()
{

    $conn = new gestionBDD();
    $db = $conn->connexionDB();

    $gestionP = new gestionProjet($db);
    $projets = $gestionP->getListeProjets();
    $html = $gestionP->getTabHtml($projets);

    echo $html;

}


if(isset($_GET["p"])) {
    if ($_GET['p'] == 'etudiants') {



    } elseif ($_GET['p'] == 'enregistreProjet') {

        $projet = new Professeur([]);

        $conn = new gestionBDD();
        $db = $conn->connexionDB();

        $gestionP = new gestionProfesseur($db);

        if (isset($_POST['idProjet']) && isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['technologie']) && isset($_POST['urlFichier']) && isset($_POST['nbEtudiant'])) {

            $projet ->setIdProjet($_POST['idProjet']);
            $projet ->setTitre($_POST['titre']);
            $projet ->setDescription($_POST['description']);
            $projet ->setTechnologie($_POST['technologie']);
            $projet ->setUrlFichier($_POST['urlFichier']);
            $projet ->setNbEtudiant($_POST['nbEtudiant']);
        }

        $gestionP->updateProjet($projet );

    }/* elseif ($_GET['p'] == 'ajouteEtudiant') {

        $etudiant = new Etudiant([]);

        if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['identifiant']) && isset($_POST['mdp'])) {

            $conn = new gestionBDD();
            $db = $conn->connexionDB();
            $gestionE = new gestionEtudiant($db);
            $reponse = $gestionE->verifieInformationValide($_POST['mail'], $_POST['identifiant']);

            echo "reponse" . $reponse;

            if ($reponse == 1) {
                echo 'ok3';

                $etudiant->setNom($_POST['nom']);
                $etudiant->setPrenom($_POST['prenom']);
                $etudiant->setIdentifiant($_POST['identifiant']);
                $etudiant->setAdresseMail($_POST['mail']);
                $etudiant->setMdp($_POST['mdp']);

                $gestionE->addEtudiant($etudiant);
            }
        }
    }*/

}