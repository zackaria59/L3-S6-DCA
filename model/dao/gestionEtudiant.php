<?php
/**
 * Created by PhpStorm.
 * User: brahi
 * Date: 03/03/2018
 * Time: 14:11
 */
require ('Etudiant.php');
require ('../bdd/gestionBDD.php');

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


    public function verifieInformationValide($email, $identifiant)
    {
        $req = $this->db->prepare('SELECT * FROM etudiant where adresseMail=:email ');
        $req->bindValue('email', $email, PDO::PARAM_STR);
        $req->execute();

        if($req->fetch())
        {
            return 2;
        }

        $req = $this->db->prepare('SELECT * FROM etudiant where identifiant=:identifiant');
        $req->bindValue('identifiant', $identifiant, PDO::PARAM_STR);
        $req->execute();

        if($req->fetch())
        {
            return 3;
        }

        return 1;
    }

    public function addEtudiant(Etudiant $etudiant)
    {
        $req = $this->getDb()->prepare("INSERT INTO etudiant (nom, prenom, identifiant, mdp, adresseMail) VALUES (:nom, :prenom, :identifiant, :mdp,:adresseMail)");
        $req->execute(array(
            "nom" => $etudiant->getNom(),
            "prenom" => $etudiant->getPrenom(),
            "identifiant" => $etudiant->getIdentifiant(),
            "mdp" => $etudiant->getMdp(),
            "adresseMail" => $etudiant->getAdresseMail()
        ));
    }


    public function deleteEtudiant(Etudiant $etudiant)
    {

        $stmt = $this->db->prepare("delete FROM etudiant WHERE id = :id");
        $stmt->bindValue('id', $etudiant->getIdEtudiant(), PDO::PARAM_STR);
        $stmt->execute();

    }

    public function  updateEtudiant(Etudiant $etudiant)
    {
        $req = $this->db->prepare('Update etudiant set nom=:nom, prenom=:prenom, adresseMail=:adresseMail, identifiant=:identifiant, mdp=:mdp where idEtudiant=:idEtudiant');

        echo $etudiant->toString();
        $req->execute(array(
            "nom" => $etudiant->getNom(),
            "prenom" => $etudiant->getPrenom(),
            "identifiant" => $etudiant->getIdentifiant(),
            "mdp" => $etudiant->getMdp(),
            "adresseMail" => $etudiant->getAdresseMail(),
            "idEtudiant" => $etudiant->getIdEtudiant()
        ));



    }

    public function getListeEtudiant()
    {
        $etudiants=[];

        $req = $this->db->query('SELECT * FROM etudiant ORDER BY nom');

        while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
        {
            $etudiants[] = new Etudiant($donnees);
        }

        return $etudiants;
    }

    public function getTabHtml($etudiants)
    {
        $html="";
        foreach ($etudiants as $etudiant){

            $id=$etudiant->getIdEtudiant();
            $ligneNom='<td><input id="nom'.$id.'" class="form-control" type="text" value="'.$etudiant->getNom().'" disabled>';
            $lignePrenom='<td><input id="prenom'.$id.'" class="form-control" type="text" value="'.$etudiant->getPrenom().'" disabled>';
            $ligneMail='<td><input id="mail'.$id.'" class="form-control" type="text" value="'.$etudiant->getAdresseMail().'" disabled>';
            $ligneIdentifiant='<td><input id="identifiant'.$id.'" class="form-control" type="text" value="'.$etudiant->getIdentifiant().'" disabled>';
            $ligneMdp='<td><input  id="mdp'.$id.'" class="form-control" type="text" value="'.$etudiant->getMdp().'" disabled>';
            $ligneModif='<td onclick="modificationEtudiant('.$id.')"><span class="glyphicon glyphicon-cog"></span></td>';

           $html.='<tr id="'.$id.'">'.$ligneNom.$lignePrenom.$ligneMail.$ligneIdentifiant.$ligneMdp.$ligneModif.'</tr>';
        }

        return $html;
    }
}

if($_GET['p']=='etudiants'){

    $conn=new gestionBDD();
    $db=$conn->connexionDB();

    $gestionE= new gestionEtudiant($db);
    $etudiants=$gestionE->getListeEtudiant();
    $html=$gestionE->getTabHtml($etudiants);

    echo $html;

}
elseif($_GET['p']=='enregistreEtudiant'){

    $etudiant=new Etudiant([]);

    $conn=new gestionBDD();
    $db=$conn->connexionDB();

    $gestionE= new gestionEtudiant($db);

    if(isset($_POST['idEtudiant']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['identifiant']) && isset($_POST['mdp']) )
    {
        $etudiant->setIdEtudiant($_POST['idEtudiant']);
        $etudiant->setNom($_POST['nom']);
        $etudiant->setPrenom($_POST['prenom']);
        $etudiant->setIdentifiant($_POST['identifiant']);
        $etudiant->setAdresseMail($_POST['mail']);
        $etudiant->setMdp($_POST['mdp']);
    }

    $gestionE->updateEtudiant($etudiant);
}
elseif($_GET['p']=='ajouteEtudiant')
{
    echo 'ok1';
    $etudiant=new Etudiant([]);

    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['identifiant']) && isset($_POST['mdp']) )
    {
        echo 'ok2';

        $conn=new gestionBDD();
        $db=$conn->connexionDB();
        $gestionE= new gestionEtudiant($db);
        $reponse=$gestionE->verifieInformationValide($_POST['mail'], $_POST['identifiant']);

        echo "reponse".$reponse;

        if($reponse==1)
        {
            echo 'ok3';

            $etudiant->setNom($_POST['nom']);
            $etudiant->setPrenom($_POST['prenom']);
            $etudiant->setIdentifiant($_POST['identifiant']);
            $etudiant->setAdresseMail($_POST['mail']);
            $etudiant->setMdp($_POST['mdp']);

            $gestionE->addEtudiant($etudiant);
        }
    }
}

?>