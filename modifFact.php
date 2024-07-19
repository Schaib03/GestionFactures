
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modifier Facture</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

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

<div class="row justify-content-center">

<div class="col-xl-10 col-lg-12 col-md-9">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-login-image">
                    <img src="img/logo.png" alt="logo" style="width: 400px; height: 400px; margin-left: 70px;">
                </div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Modifier Facture</h1>
                        </div>
                        <form action="editfact.php" method="post" class="user">
                        <div class="form-group" style="display: none;">
                            <label for="num">Numero</label>
                            <input type  ="number" class="form-control" name="num" id="num" value="<?php echo htmlspecialchars($num); ?>" readonly>   
                    
                        </div>
                        <div class="form-group">
                            <label for="id">Numero</label>
                            <input type ="number" class="form-control" name="id" id="id" value="<?php echo htmlspecialchars($id); ?>" readonly>   </div>
                            <div class="form-group">
                                <label for="etat">Date</label>
                              <input type="date" class="form-control" name="date" id="date" required>                            </div> 
                            <div class="form-group">
                                 <label for="montantTotal">MontantTotal</label>
                                 <input type="text" class="form-control" name="montantTotal" id="montantTotal" required>                            </div>
                            <div class="form-group"> 
                                <label for="etat">Etat</label>
                                <input type="text" class="form-control" name="etat" id="etat" required>                            </div>     
                            <div class="form-group">
                                    <label for="idClient">IdClient</label>
                                    <input type="text" class="form-control" name="idC" id="idClient" required>
                            </div>
                            <div class="form-group">
                                <label for="idPaiement">IdPaiement</label>
                                <input type="text" class="form-control" name="idP" id="idPaiement" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-user btn-block">Modifier</button>
                        </form>

                        <hr>
                        <a href="view/layout.php" class="btn btn-primary btn-user btn-block">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>

</div>
</html>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

