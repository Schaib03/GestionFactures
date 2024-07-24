<?php
require_once 'controller/paiement_controller.php';
require_once 'model/paiement.php';
$pdo = dbP_connect();
$query = "SELECT * FROM paiement WHERE idPaiement = :idPaiement";
$stmt = $pdo->prepare($query);
$numero = $_GET['number'];
$stmt->bindParam(':idPaiement', $numero);
$stmt->execute();
$paiement = $stmt->fetch(PDO::FETCH_OBJ);
if ($paiement){
    $dateP=$paiement->dateP;
    $montant=$paiement->montant;
    $methode=$paiement->methode;
    deletePaiement($dateP, $montant, $methode, $numero);
}

?>