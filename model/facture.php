<?php
session_start();
class Facture {
    private $numero;
    private $date;
    private $montantTotal;
    private $etat;
    private $idC;
    private $idP;
    private $idU;

    public function __construct($date, $montantTotal, $etat, $idC, $idP) {
        $this->idU = $_SESSION['id'];
        $this->date = $date;
        $this->montantTotal = $montantTotal;
        $this->etat = $etat;
        $this->idC = $idC;
        $this->idP = $idP;
    }
    public function getDate() {
        return $this->date;
    }
    public function getMontantTotal() {
        return $this->montantTotal;
    }
    public function getEtat() {
        return $this->etat;
    }
    public function getIdC() {
        return $this->idC;
    }
    public function getIdP() {
        return $this->idP;
    }
    public function getIdU() {
        return $this->idU;
    }
    public function getNumero() {
        return $this->numero;
    }
    public function ajouterFacture() {
    try {
        $pdo = dbC_connect();
        $query = "INSERT INTO factures (date, montantTotal, etat, idC, idP, idU) VALUES (:date, :montantTotal, :etat, :idC, :idP, :idU)";
        $stmt = $pdo->prepare($query);
        $currentDateTime = (new DateTime())->format('Y-m-d');
        $stmt->bindParam(':date', $currentDateTime);
        $stmt->bindParam(':montantTotal', $this->montantTotal);
        $stmt->bindParam(':etat', $this->etat);
        $stmt->bindParam(':idC', $this->idC);
        $stmt->bindParam(':idP', $this->idP);
        $stmt->bindParam(':idU', $this->idU);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    } catch (Exception $e) {
        return false;
    }
    
}
    public function modifierFacture($date, $montantTotal, $etat, $idC, $idP) {
        $pdo = dbC_connect();
        $query = "UPDATE factures SET date=:date, montantTotal=:montantTotal, etat=:etat, idC=:idC, idP=:idP WHERE numero=:numero";
        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(':numero', $this->numero);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':montantTotal', $montantTotal);
        $stmt->bindParam(':etat', $etat);
        $stmt->bindParam(':idC', $idC);
        $stmt->bindParam(':idP', $idP);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function loadFactureByNumero($numero) {
        $pdo = dbC_connect();
        $query = "SELECT * FROM factures WHERE numero = :numero";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':numero', $numero);
        $stmt->execute();

        
        $facture = $stmt->fetch(PDO::FETCH_ASSOC);

        
        if ($facture) {
            $this->numero = $facture['numero'];
            $this->date = $facture['date'];
            $this->montantTotal = $facture['montantTotal'];
            $this->etat = $facture['etat'];
            $this->idC = $facture['idC'];
            $this->idP = $facture['idP'];
            return true;
        } else {
            return false; 
        }
    }
    public function supprimerFacture($num) {
        $pdo = dbC_connect();
        $query = "DELETE FROM factures WHERE numero = :numero";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':numero', $num);
        if ($stmt->execute()) {
            $query="UPDATE factures SET numero = numero-1 where numero > :numero";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':numero', $num);
            $stmt->execute();
            $query = "SELECT COUNT(*) as count FROM factures";
            $stmt = $pdo->query($query);    
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            if ($result->count == 0) {
                $pdo = dbC_connect();
                $query = "TRUNCATE TABLE factures";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
            }

            return true;
        } else {
            return false;
        }
    }  
}
function dbC_connect(){
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
function listeFacture(){
    if(isset($_SESSION['login'])) {
        $iduser = $_SESSION['id'];
    }
    $pdo = dbC_connect();
    $query = 'SELECT * FROM factures where idU=:idU';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':idU', $iduser);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);

}  
?>