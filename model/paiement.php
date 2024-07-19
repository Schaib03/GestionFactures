<?php
class Paiement {
    private $idP;
    private $date;
    private $montant;
    private $idU;
    public function __construct($date, $montant, $idU) {
        $this->date = $date;
        $this->montant = $montant;
        $this->idU = $idU;
    }
    public function getDate() {
        return $this->date;
    }
    public function getMontant() {
        return $this->montant;
    }
    public function getIdU() {
        return $this->idU;
    }
    public function ajouterPaiement() {
        $pdo = db_connect();
        $query = "INSERT INTO paiements (date, montant, idU) VALUES (:date, :montant, :idU)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':montant', $this->montant);
        $stmt->bindParam(':idU', $this->idU);
        $stmt->execute();
    }
    public function listePaiement() {
        $pdo = db_connect();
        $query = "SELECT * FROM paiements";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $paiement = $stmt->fetchAll();
        return $paiement;
    }
    public function supprimerPaiement($id) {
        $pdo = db_connect();
        $query = "DELETE FROM paiements WHERE idP = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    public function modifierPaiement($id, $date, $montant, $idU) {
        $pdo = db_connect();
        $query = "UPDATE paiements SET date=:date, montant=:montant, idU=:idU WHERE idP=:id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':montant', $montant);
        $stmt->bindParam(':idU', $idU);
        $stmt->execute();
    }
    public function loadPaiementById($id) {
        $pdo = db_connect();
        $query = "SELECT * FROM paiements WHERE idP = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $paiement = $stmt->fetch(PDO::FETCH_OBJ);
        return $paiement;
    }
}