<?php
require_once 'controller/client_controller.php';
require_once 'model/client.php';
$pdo = db_connect();
$query = "SELECT * FROM client WHERE idClient = :idClient";
$stmt = $pdo->prepare($query);
$numero = $_GET['num'];
$stmt->bindParam(':idClient', $numero);
$stmt->execute();
$client = $stmt->fetch(PDO::FETCH_OBJ);
if ($client){
    $nom=$client->nom;
    $adresse=$client->adresse;
    $email=$client->email;
    $te=$client->telephone;
    deleteClient($nom, $adresse, $email, $te,$numero);
}

?>