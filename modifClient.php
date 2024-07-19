

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
<?php require_once 'model/client.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['num'])) {
    $num = $_GET['num'];
}
$client=new client(0,0,0,0,0);  
if($client->loadClientById($num)) {
   $no=$client->getNom();
   $ad=$client->getAdresse();
   $em=$client->getEmail();
   $te=$client->getTelephone();

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
                            <h1 class="h4 text-gray-900 mb-4">Ajouter Client</h1>
                        </div>
                        <form action="editClient.php" method="post" class="user">
                        <div class="form-group" >
                             <label for="idClient">Numero</label>
                             <input type  ="number" class="form-control" name="idClient" id="idClient" value="<?php echo htmlspecialchars($num); ?>" readonly>   
       
                        </div>
                            <div class="form-group">
                                <label for="nom">Nom</label>
                              <input type="text" class="form-control" name="nom" id="nom">                            </div> 
                            <div class="form-group">
                                 <label for="adresse">adresse</label>
                                 <input type="text" class="form-control" name="adresse" id="adresse">                            </div>
                            <div class="form-group"> 
                                <label for="email">email</label>
                                <input type="email" class="form-control" aria-describedby="emailHelp" name="email" id="email">                            </div>     
                            <div class="form-group">
                                    <label for="tel">telephone</label>
                                    <input type="telephone" class="form-control" name="tel" id="tel">
                            </div>
                        
                            
                            <button type="submit" class="btn btn-primary btn-user btn-block">Ajouter</button>
                        </form>
                        <hr>
                        <a href="view/clientLayout.php" class="btn btn-primary btn-user btn-block">Retour</a>

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
