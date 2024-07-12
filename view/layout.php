<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/fontawesome/4.2.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
    <a  href="facture1.php"> <button  class="btn btn-primary">Ajouter une facture</button></a>
    <table class ="table table-bordered">
        <thead>
            <tr>
                <th scope="col">numero</th>  
                <th scope="col">date</th>
                <th scope="col">montantTotal</th>
                <th scope="col">etat</th>
                <th scope="col">idClient</th>
                <th scope="col">idPaiement</th>
                
            </tr>
        </thead>

        <tbody>
        <?php 
        require_once 'model/facture.php';
        $listeFacture = listeFacture(); 
        foreach($listeFacture as $facture): ?>    
            <tr>
                <td><?= $facture->numero ?></td>
                <td><?= $facture->date ?></td>
                <td><?= $facture->montantTotal ?></td>
                <td><?= $facture->etat ?></td>
                <td><?= $facture->idC ?></td>
                <td><?= $facture->idP ?></td>
                
                <td><button><a href="modifFact.php?numero=<?= $facture->numero ?>" action="modifFact.php" method="get">Edit</a></button>
                <button><a href="suppFact.php?numero=<?= $facture->numero ?>" action="suppFact.php" method="get">Delete</a></button></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    
</body>
</html>