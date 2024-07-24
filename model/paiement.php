<?php
class Paiement {
    private $idPaiement;
    private $dateP;
    private $montant;
    private $methode;
    private $idUser;
    
    public function __construct($dateP, $montant, $methode) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            if(isset($_SESSION['login'])) {
                $this->idUser = $_SESSION['id'];}
            else{echo "You are not logged i wown.";
            }
        } else {
            if(isset($_SESSION['login'])) {
                $this->idUser = $_SESSION['id'];
        }}
        
        $this->dateP = $dateP;
        $this->montant = $montant;
        $this->methode = $methode;
    }
    public function getIdPaiement() {
        return $this->idPaiement;
    }
    public function getDateP() {
        return $this->dateP;
    }
    public function getMontant() {
        return $this->montant;
    }
    public function getMethode() {
        return $this->methode;
    }
    public function setIdPaiement($idPaiement) {
        $this->idPaiement = $idPaiement;
    }
    public function ajouterPaiement() {
        $pdo = dbP_connect();
        $query = "INSERT INTO paiement (dateP, montant, methode, idUser) VALUES (:dateP, :montant, :methode, :idUser)";
        $currentDateTime = (new DateTime())->format('Y-m-d');

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':dateP', $currentDateTime);
        $stmt->bindParam(':montant', $this->montant);
        $stmt->bindParam(':methode', $this->methode);
        $stmt->bindParam(':idUser', $this->idUser);
        if($stmt->execute()) {
            return true;
        } else {
            echo "Error adding paiement";
            return false;
        }
    }
    public function supprimerPaiement($num) {
        $pdo = dbP_connect();
        $query = "DELETE FROM paiement WHERE idPaiement = :idPaiement";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':idPaiement', $num);
        if ($stmt->execute()) {
            $query="UPDATE paiement SET idPaiement = idPaiement-1 where idPaiement > :idPaiement";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':idPaiement', $num);
            $stmt->execute();
            $query = "SELECT COUNT(*) as count FROM paiement";
            $stmt = $pdo->query($query);    
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            if ($result->count == 0) {
                $pdo = dbP_connect();
                $query = "TRUNCATE TABLE paiement";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
            }

            return true;
        } else {
            return false;
        }
    }
    public function modifierPaiement($id, $date, $montant, $meth) {
        $pdo = dbP_connect();
        $query = "UPDATE paiement SET dateP=:dateP, montant=:montant, methode=:methode WHERE idPaiement=:idPaiement";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':idPaiement', $id);
        $stmt->bindParam(':dateP', $date);
        $stmt->bindParam(':montant', $montant);
        $stmt->bindParam(':methode', $meth);
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error updating paiement";
            return false;
        }}
        public function loadPaiementById($id) {
            $pdo = dbP_connect();
            $query = "SELECT * FROM paiement WHERE idPaiement = :idPaiement";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':idPaiement', $id);
            $stmt->execute();
            $paiement = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($paiement) {
                $this->dateP = $paiement['dateP'];
                $this->montant = $paiement['montant'];
                $this->methode = $paiement['methode'];

                return true;
            } else {
                return false; 
            }
        }
    }
    function dbP_connect(){
        return new PDO('mysql:host=localhost;dbname=appwebFactures','root','');
    }
    function listePaiement() {
        if(isset($_SESSION['login'])) {
            $iduser = $_SESSION['id'];
        }
        $pdo = dbP_connect();
        $query = "SELECT * FROM paiement where idUser = :idUser";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':idUser', $iduser);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    function listePaiementByID($id) {
        $pdo = db_connect();
        $query = "SELECT * FROM paiement WHERE idPaiement = :idPaiement";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':idPaiement', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }