<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

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
                    <img src="img/logo.png" class="animated-image " alt="logo" style="width: 400px; height: 400px; margin-left: 70px;">
                </div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Ajouter Facture</h1>
                        </div>
                        <?php
try {
    // Connexion à la base de données
    $pdo=new PDO('mysql:host=localhost;dbname=appwebFactures','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation et exécution de la requête pour obtenir les idClient
    $query = 'SELECT idClient FROM client where idUser = :idUser';
    session_start();
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

<form action="store.php" method="post" class="user">
    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" class="form-control" name="date" id="date">
    </div> 
    <div class="form-group">
        <label for="montantTotal">Montant Total</label>
        <input type="number" class="form-control" step="0.001" placeholder="ex: 15.756" name="montantTotal" id="montantTotal">
    </div>
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
        <label for="idPaiement">Id Paiement</label>
        <input type="number" class="form-control" name="idP" id="idPaiement" placeholder="ex: 15">
    </div>
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
                         
                            
                            <button type="submit" class="btn btn-primary btn-user btn-block  text-uppercase">Ajouter</button>
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

