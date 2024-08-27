<?php 
require_once 'model/facture.php';
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
   $n=$fac->getNumero();
 }
?>

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
    <style>
        @keyframes bounce {
    0%, 100% {
        transform: translateY(0); /* Start and end at the original position */
    }
    50% {
        transform: translateY(100px); /* Move up 100px */
    }
}
.animated-image{
    animation: bounce 3s infinite;
}
</style>

</head>

<div class="row justify-content-center">

<div class="col-xl-10 col-lg-12 col-md-9">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-login-image">
                    <img src="img/logo.png" class ="animated-image  " alt="logo" style="width: 400px; height: 400px; margin-left: 70px;">
                </div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Modifier Facture</h1>
                        </div>
<?php
                                                try {
                            // Connexion à la base de données
                            $pdo=dbC_connect();
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // Préparation et exécution de la requête pour obtenir les idClient
                            $query = 'SELECT idClient FROM client where idUser = :idUser';
                            
                            $id=$_SESSION['id'];
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':idUser', $id, PDO::PARAM_INT);
                            $stmt->execute();

                            // Récupération des résultats
                            $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        } catch (PDOException $e) {
                            echo 'Erreur : ' . $e->getMessage();
                        }
?>
<?php
try {
    // Connexion à la base de données
    $pdp=dbC_connect();
    $pdp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation et exécution de la requête pour obtenir les idClient
    $query = 'SELECT idPaiement FROM paiement where idUser = :idUser';
    $stmtp = $pdp->prepare($query);
    $stmtp->bindParam(':idUser', $id, PDO::PARAM_INT);
    $stmtp->execute();

    // Récupération des résultats
    $paiements = $stmtp->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>

                        <form action="editfact.php" method="post" class="user">
                        <div class="form-group" style="display: none;">
                            <label for="num">Numero</label>
                            <input type  ="number" class="form-control" name="num" id="num" value="<?php echo htmlspecialchars($n); ?>" readonly>   
                    
                        </div>
                        <div class="form-group">
                            <label for="id">Numero</label>
                            <input type ="number" class="form-control" name="id" id="id" value="<?php echo htmlspecialchars($num); ?>" readonly>   </div>
                            <div class="form-group">
                                <label for="etat">Date</label>
                              <input type="date" class="form-control" name="date" id="date" value="<?php echo htmlspecialchars($d); ?>" required>                            </div> 
                            <div class="form-group">
                                 <label for="montantTotal">MontantTotal</label>
                                 <input type="number" class="form-control" step="0.001" placeholder="99.999" name="montantTotal" value="<?php echo htmlspecialchars($m); ?>" id="montantTotal" required>                            </div>
                                 <div class="form-group">
                                <label for="etat">Statut de la facture :</label>
                                <select id="etat" class="form-control" name="etat">
                                        <option value="Payée">Payée</option>
                                        <option value="Impayée">Impayée</option>
                                        <option value="Partiellement payée">Partiellement payée</option>
                                    </select>
                                </div>
                                <div class="form-group">
        <label for="idC">Id Client</label>
        <select class="form-control" name="idC" id="idC">
            <?php foreach ($clients as $client): ?>
                <option value="<?php echo htmlspecialchars($client['idClient']); ?>">
                    <?php echo htmlspecialchars($client['idClient']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="idP">Id Paiement</label>
        <select class="form-control" name="idP" id="idP">
        <option value="">Sélectionnez un ID de paiement</option>
        <?php foreach ($paiements as $paiement): ?>
            <option value="<?php echo htmlspecialchars($paiement['idPaiement']); ?>">
                <?php echo htmlspecialchars($paiement['idPaiement']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    </div>
    <script>
    document.getElementById('idP').addEventListener('change', function() {
        var selectedIndex = this.selectedIndex - 1; 
        if (selectedIndex >= 0) {
            var selectedPayment = <?php echo json_encode($paiements); ?>[selectedIndex];
            document.getElementById('mont').value = selectedPayment.montant;
        } else {
            document.getElementById('mont').value = ''; 
        }
    });
</script>
                            <script>
                                document.getElementById('etat').addEventListener('change', function() {
                                    var etatValue = this.value;
                                    var idPaiementField = document.getElementById('idPaiement');
                                    var montantTotalField = document.getElementById('montantTotal');
                                    
                                    if (etatValue === 'Impayée') {
                                        idPaiementField.value = '0';
                                        idPaiementField.readOnly = true;
                                        montantTotalField.value = '0';
                                        montantTotalField.readOnly = true;
                                    } else {
                                        idPaiementField.value = '';
                                        idPaiementField.readOnly = false;
                                        montantTotalField.value = '';
                                        montantTotalField.readOnly = false; // Clear the value if other options are selected
                                    }
                                });
                            </script>
                         
                            
                            <button type="submit" class="btn btn-primary btn-user btn-block  text-uppercase">Confirmer Modification</button>
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

