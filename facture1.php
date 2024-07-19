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

</head>
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
                            <h1 class="h4 text-gray-900 mb-4">Ajouter Facture</h1>
                        </div>
                        <form action="store.php" method="post" class="user">
                            <div class="form-group">
                                <label for="etat">Date</label>
                              <input type="date" class="form-control" name="date" id="date">                            </div> 
                            <div class="form-group">
                                 <label for="montantTotal">MontantTotal</label>
                                 <input type="text" class="form-control" name="montantTotal" id="montantTotal">                            </div>
                            <div class="form-group"> 
                                <label for="etat">Etat</label>
                                <input type="text" class="form-control" name="etat" id="etat">                            </div>     
                            <div class="form-group">
                                    <label for="idClient">IdClient</label>
                                    <input type="text" class="form-control" name="idC" id="idClient">
                            </div>
                            <div class="form-group">
                                <label for="idPaiement">IdPaiement</label>
                                <input type="text" class="form-control" name="idP" id="idPaiement">
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-user btn-block">Ajouter</button>
                        </form>
                        <hr>
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

