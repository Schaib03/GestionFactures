<?php
require_once 'view/layout.php';
require_once 'controller/facture_controller.php';
require_once 'model/facture.php';
$pdo = db_connect();
$query = "SELECT * FROM factures WHERE numero = :numero";
$stmt = $pdo->prepare($query);
$numero = $_GET['numero'];
$stmt->bindParam(':numero', $numero);
$stmt->execute();
$facture = $stmt->fetch(PDO::FETCH_OBJ);
if ($facture){
    $date=$facture->date;
    $montantTotal=$facture->montantTotal;
    $etat=$facture->etat;
    $idC=$facture->idC;
    $idP=$facture->idP;
    $nu=$facture->numero;
    deleteFacture($date, $montantTotal, $etat, $idC, $idP,$nu);
}

?>