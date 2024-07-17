
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/fontawesome/4.2.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<?php require_once 'model/facture.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['numero'])) {
    $num = $_GET['numero'];
}
$fac=new facture(0,0,0,0,0,0,0);  
if($fac->loadFactureByNumero($num)) {
   $d=$fac->getDate();
   $m=$fac->getMontantTotal();
   $e=$fac->getEtat();
   $iC=$fac->getIdC();
   $iP=$fac->getIdP();
 }
?>

<body>
    <form action="edit.php" method="post">
        <div class="form-group" style="display: none;">
            <label for="num">Numero</label>
            <input type  ="number" class="form-control" name="num" id="num" value="<?php echo htmlspecialchars($num); ?>" readonly>   
       
        </div>
        <div class="form-group">
            <label for="id">Numero</label>
            <input type  ="number" class="form-control" name="id" id="id" value="<?php echo htmlspecialchars($id); ?>" readonly>   </div>
        <div class="form-group">
            <label for="date">Date</label>  
            <input type="date" class="form-control" name="date" id="date" value="<?php echo htmlspecialchars($d); ?>">
        </div>
        <div class="form-group">
            <label for="montantTotal">MontantTotal</label>
            <input type="text" class="form-control" name="montantTotal" id="montantTotal" placeholder="<?php echo htmlspecialchars($m); ?>">
        </div>
        <div class="form-group">
            <label for="etat">Etat</label>
            <input type="text" class="form-control" name="etat" id="etat" placeholder="<?php echo htmlspecialchars($e); ?>">
        </div>
        <div class="form-group">
            <label for="idClient">IdClient</label>
            <input type="text" class="form-control" name="idC" id="idClient" placeholder="<?php echo htmlspecialchars($iC); ?>">
        </div>
        <div class="form-group">
            <label for="idPaiement">IdPaiement</label>
            <input type="text" class="form-control" name="idP" id="idPaiement" placeholder="<?php echo htmlspecialchars($iP); ?>">
        </div>

        <button type="submit" onclick="document.location='index.php'" class="btn btn-primary">Submit</button>
    </form>

</body>
