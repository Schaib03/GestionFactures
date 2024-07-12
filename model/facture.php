<?php
class Facture {
    private $numero;
    private $date;
    private $montantTotal;
    private $etat;
    private $idC;
    private $idP;

    public function __construct($date, $montantTotal, $etat, $idC, $idP) {
        $this->date = $date;
        $this->montantTotal = $montantTotal;
        $this->etat = $etat;
        $this->idC = $idC;
        $this->idP = $idP;
    }
   public function ajouterFacture() {
        $pdo = db_connect();
        $query = "INSERT INTO factures (date, montantTotal, etat, idC, idP) VALUES (:date, :montantTotal, :etat, :idC, :idP)";
        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':montantTotal', $this->montantTotal);
        $stmt->bindParam(':etat', $this->etat);
        $stmt->bindParam(':idC', $this->idC);
        $stmt->bindParam(':idP', $this->idP);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function modifierFacture($date, $montantTotal, $etat, $idC, $idP) {
        $pdo = db_connect();
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
        $pdo = db_connect();
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
        $pdo = db_connect();
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
                $pdo = db_connect();
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
function db_connect(){
    return new PDO('mysql:host=localhost;dbname=appwebFactures','root','');
}
function listeFacture(){

    $pdo = db_connect();
    $query = 'SELECT * FROM factures';
    $stmt = $pdo->query($query);
    return $stmt->fetchAll(PDO::FETCH_OBJ);

}


     
?>  