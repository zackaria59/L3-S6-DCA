<?php
/**
 * Created by PhpStorm.
 * User: brahi
 * Date: 03/03/2018
 * Time: 14:11
 */
require ('Professeur.php');
require ('../bdd/gestionBDD.php');

class gestionProfesseur
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
        $req = $this->db->prepare('SELECT * FROM professeur where adresseMail=:email ');
        $req->bindValue('email', $email, PDO::PARAM_STR);
        $req->execute();

        if($req->fetch())
        {
            return 2;
        }

        $req = $this->db->prepare('SELECT * FROM professeur where identifiant=:identifiant');
        $req->bindValue('identifiant', $identifiant, PDO::PARAM_STR);
        $req->execute();

        if($req->fetch())
        {
            return 3;
        }

        return 1;
    }

    public function addProfesseur(Professeur $professeur)
    {
        $req = $this->getDb()->prepare("INSERT INTO professeur (nom, prenom, identifiant, mdp, adresseMail) VALUES (:nom, :prenom, :identifiant, :mdp,:adresseMail)");
        $req->execute(array(
            "nom" => $professeur->getNom(),
            "prenom" => $professeur->getPrenom(),
            "identifiant" => $professeur->getIdentifiant(),
            "mdp" => $professeur->getMdp(),
            "adresseMail" => $professeur->getAdresseMail()
        ));
    }


    public function deleteProfesseur(Professeur $professeur)
    {

        $stmt = $this->db->prepare("delete FROM etudiant WHERE id = :id");
        $stmt->bindValue('id', $professeur->getIdProfesseur(), PDO::PARAM_STR);
        $stmt->execute();

    }

    public function  updateProfesseur(Professeur $professeur)
    {
        $req = $this->db->prepare('Update professeur set nom=:nom, prenom=:prenom, adresseMail=:adresseMail, identifiant=:identifiant, mdp=:mdp where idEtudiant=:idEtudiant');

        echo $professeur->toString();
        $req->execute(array(
            "nom" => $professeur->getNom(),
            "prenom" => $professeur->getPrenom(),
            "identifiant" => $professeur->getIdentifiant(),
            "mdp" => $professeur->getMdp(),
            "adresseMail" => $professeur->getAdresseMail(),
            "idEtudiant" => $professeur->getIdProfesseur()
        ));



    }

    public function getListeProfesseur()
    {
        $professeurs=[];

        $req = $this->db->query('SELECT * FROM professeur ORDER BY nom');

        while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
        {
            $professeurs[] = new Professeur($donnees);
        }

        return $professeurs;
    }

    public function getTabHtml($professeurs)
    {
        $html="";
        foreach ($professeurs as $professeur){

            $id=$professeur->getIdEtudiant();
            $ligneNom='<td><input id="nom'.$id.'" class="form-control" type="text" value="'.$professeur->getNom().'" disabled>';
            $lignePrenom='<td><input id="prenom'.$id.'" class="form-control" type="text" value="'.$professeur->getPrenom().'" disabled>';
            $ligneMail='<td><input id="mail'.$id.'" class="form-control" type="text" value="'.$professeur->getAdresseMail().'" disabled>';
            $ligneIdentifiant='<td><input id="identifiant'.$id.'" class="form-control" type="text" value="'.$professeur->getIdentifiant().'" disabled>';
            $ligneMdp='<td><input  id="mdp'.$id.'" class="form-control" type="text" value="'.$professeur->getMdp().'" disabled>';
            $ligneModif='<td onclick="modificationEtudiant('.$id.')"><span class="glyphicon glyphicon-cog"></span></td>';

            $html.='<tr id="'.$id.'">'.$ligneNom.$lignePrenom.$ligneMail.$ligneIdentifiant.$ligneMdp.$ligneModif.'</tr>';
        }

        return $html;
    }
}

if($_GET['p']=='professeurs'){

    $conn=new gestionBDD();
    $db=$conn->connexionDB();

    $gestionE= new gestionEtudiant($db);
    $professeurs=$gestionE->getListeEtudiant();
    $html=$gestionE->getTabHtml($professeurs);

    echo $html;

}
elseif($_GET['p']=='enregistreProfesseur'){

    $professeur=new Professeur([]);

    $conn=new gestionBDD();
    $db=$conn->connexionDB();

    $gestionE= new gestionEtudiant($db);

    if(isset($_POST['idEtudiant']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['identifiant']) && isset($_POST['mdp']) )
    {
        $professeur->setIdProfesseur($_POST['idProfesseur']);
        $professeur->setNom($_POST['nom']);
        $professeur->setPrenom($_POST['prenom']);
        $professeur->setIdentifiant($_POST['identifiant']);
        $professeur->setAdresseMail($_POST['mail']);
        $professeur->setMdp($_POST['mdp']);
    }

    $gestionE->updateEtudiant($professeur);
}
elseif($_GET['p']=='ajouteEtudiant')
{
    echo 'ok1';
    $professeur=new Professeur([]);

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

            $professeur->setNom($_POST['nom']);
            $professeur->setPrenom($_POST['prenom']);
            $professeur->setIdentifiant($_POST['identifiant']);
            $professeur->setAdresseMail($_POST['mail']);
            $professeur->setMdp($_POST['mdp']);

            $gestionE->addProfesseur($etudiant);
        }
    }
}

?>