<?php
class Client {
    private $idClient;
    private $nom;
    private $adresse;
    private $email;
    private $telephone;
    private $idUser;
    public function __construct($nom, $adresse, $email,$telephone) {
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
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->email = $email;
        $this->telephone = $telephone;
    }
    public function getNom() {
        return $this->nom;
    }
    public function getAdresse() {
        return $this->adresse;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getTelephone() {
        return $this->telephone;
    }
    public function ajouterClient() {
        $pdo = db_connect();
        $query = "INSERT INTO client (nom, adresse, email, telephone, idUser) VALUES (:nom, :adresse, :email, :telephone, :idUser)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':adresse', $this->adresse);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':telephone', $this->telephone);
        $stmt->bindParam(':idUser',$this->idUser);

        if($stmt->execute()) {
            return true;
        } else {
            echo "Error adding client";
            return false;
        }
    }
    
    public function supprimerClient($num) {
        $pdo = db_connect();
        $query = "DELETE FROM client WHERE idClient = :idClient";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':idClient', $num);
        if ($stmt->execute()) {
            $query="UPDATE client SET idClient = idClient-1 where idClient > :idClient";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':idClient', $num);
            $stmt->execute();
            $query = "SELECT COUNT(*) as count FROM client";
            $stmt = $pdo->query($query);    
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            if ($result->count == 0) {
                $pdo = db_connect();
                $query = "TRUNCATE TABLE client";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
            }

            return true;
        } else {
            echo("Error deleting client");            
            return false;
        }
    }
    public function modifierClient($id, $nom, $adresse, $email, $telephone) {
        $pdo = db_connect();
        $query = "UPDATE client SET nom=:nom, adresse=:adresse, email=:email, telephone=:telephone WHERE idClient=:id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->execute();
    }
    public function loadClientById($id) {
        $pdo = db_connect();
        $query = "SELECT * FROM client WHERE idClient = :idClient";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':idClient', $id);
        $stmt->execute();
        $client = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($client) {
            $this->idClient = $client['idClient'];
            $this->nom = $client['nom'];
            $this->adresse = $client['adresse'];
            $this->email = $client['email'];
            $this->telephone = $client['telephone'];
            return true;
        } else {
            return false; 
        }
    }
    

}
function db_connect(){
    $host = 'db';
    $db   = 'appwebfactures';
    $user = 'appuser';
    $pass = 'apppassword';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }}
 function listeClient() { 
    if(isset($_SESSION['login'])) {
        $iduser = $_SESSION['id'];
    }
    $pdo = db_connect();
    $query = "SELECT * FROM client where idUser = :idUser";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':idUser', $iduser);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
function listeClientByID($id) {
    $pdo = db_connect();
    $query = "SELECT * FROM client WHERE idClient = :idClient";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':idClient', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
}
?>