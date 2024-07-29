<?php
// Start the session at the very beginning


// Require necessary files
require_once __DIR__.'/../model/utilisateur.php';
session_start();
// Ensure user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Create an instance of utilisateur and fetch user data
$utilisateur = new utilisateur("", "", "");
$idU = $_SESSION['id'];

// Assuming selectById returns an utilisateur object or null
$utilisateur = $utilisateur->selectById($idU);

if ($utilisateur) {
    $nom = $utilisateur->getNom();
} else {
    // Handle case where user is not found
    echo "User not found.";
    exit();
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

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @keyframes example {
            0% {transform: translateX(0);}
            50% {transform: translateX(100px);}
            100% {transform: translateX(0);}
        }
        @keyframes example1 {
            0% {transform: translateX(0);}
            50% {transform: translateX(-50px);}
            100% {transform: translateX(0);}
        }
             .animated-image {
            animation: example1 2s infinite;
        }
        
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="userLayout.php">
                <div class="sidebar-brand-icon ">
                <img src="../img/logo.png"  class="animated-image image-fluid" width="120" height="120" alt="Logo">                </div>
            </a>

           
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="userLayout.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>


      

           

        

            <!-- Heading -->
            <div class="sidebar-heading">
                Tables
            </div>

        

            <!-- Nav Item - Factures -->
            <li class="nav-item">
                <a class="nav-link" href="layout.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Table des factures</span></a>
            </li>

            <!-- Nav Item - Clients -->
            <li class="nav-item">
                <a class="nav-link" href="clientLayout.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Table des clients</span></a>
            </li>
            <!-- Nav Item - Paiements -->
            <li class="nav-item">
                <a class="nav-link" href="paiementLayout.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Table des paiements</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card mb-4 d-lg-flex">
                <p class="text-center mb-4"> Know more about <strong>SQLI</strong> </p>
                <a class="btn btn-success btn-sm" href="https://www.sqli.com/ma-fr/agences/oujda">Learn more</a>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                       
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $nom ?></span>
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <button class="btn btn-warning" style="font-size: 25px;" type="button" disabled>
                    <span class="spinner-grow " role="status" aria-hidden="true"></span>
                    <span class="visually-hidden "  >Dashboard</span>
                    </button>
                     
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <?php
                       try {
                        $pdo = dbU_connect();
                        
                        $req = $pdo->prepare("SELECT COUNT(numero) AS paid_count FROM factures WHERE etat = :etat AND idU= :idU");
                        $idU = $_SESSION['id'];
                        $etat = "Payée";
                        $req->bindValue(':etat', $etat, PDO::PARAM_STR);
                        $req->bindValue(':idU', $idU, PDO::PARAM_STR);
                        $req->execute();
                        
                        $res = $req->fetch();
                        $paidCount = $res['paid_count'];
                        echo"<script> var paidCount = $paidCount;</script>";
                        
                    } catch (PDOException $e) {
                        echo "Database error: " . $e->getMessage();
                    }
                       try {
                        $pdo = dbU_connect();
                        
                        $req = $pdo->prepare("SELECT COUNT(idPaiement) AS paid_count FROM paiement WHERE idUser= :idUser");
                        $idUser = $_SESSION['id'];
                        $req->bindValue(':idUser', $idUser, PDO::PARAM_STR);
                        $req->execute();
                        
                        $res = $req->fetch();
                        $paid_count = $res['paid_count'];
                        
                    } catch (PDOException $e) {
                        echo "Database error: " . $e->getMessage();
                    }
                        ?>
                        <!-- Factures Card  -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Nombre de paiements effectués</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $paid_count ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-regular fa-file-circle-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                       try {
                        $pdo = dbU_connect();
                        
                        $req = $pdo->prepare("SELECT COUNT(numero) AS impaid_count FROM factures WHERE etat = :etat  AND idU = :idU");
                        $idU = $_SESSION['id'];
                        $etat = "Impayée";
                        $req->bindValue(':etat', $etat, PDO::PARAM_STR);
                        $req->bindValue(':idU', $idU, PDO::PARAM_STR);
                        $req->execute();
                        
                        $res = $req->fetch();
                        $impaidCount = $res['impaid_count'];
                        echo"<script> var impaidCount = $impaidCount;</script>";
                        
                    } catch (PDOException $e) {
                        echo "Database error: " . $e->getMessage();
                    }
                       try {
                        $pdo = dbU_connect();
                        
                        $req = $pdo->prepare("SELECT COUNT(numero) AS factCount FROM factures WHERE idU = :idU");
                        $idU = $_SESSION['id'];
                        $req->bindValue(':idU', $idU, PDO::PARAM_STR);
                        $req->execute();
                        
                        $res = $req->fetch();
                        $factCount = $res['factCount'];
                        
                    } catch (PDOException $e) {
                        echo "Database error: " . $e->getMessage();
                    }
                        ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Nombre de factures</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $factCount ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fa-solid  fa-2x text-gray-300 fa-file-invoice-dollar"></i>                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                       try {
                        $pdo = dbU_connect();
                        
                        $req = $pdo->prepare("SELECT COUNT(numero) AS Partipaid_count FROM factures WHERE etat = :etat");
                        $etat = "Partiellement payée";
                        $req->bindValue(':etat', $etat, PDO::PARAM_STR);
                        $req->execute();
                        
                        $res = $req->fetch();
                        $PartipaidCount = $res['Partipaid_count'];
                        echo "<script> var PartipaidCount = $PartipaidCount;</script>";
                        
                    } catch (PDOException $e) {
                        echo "Database error: " . $e->getMessage();
                    }
                       try {
                        $pdo = dbU_connect();
                        
                        $req = $pdo->prepare("SELECT SUM(montant) AS somme FROM paiement WHERE idUser = :idUser ");
                        $idU = $_SESSION['id'];
                        $req->bindValue(':idUser', $idU, PDO::PARAM_STR);
                        $req->execute();
                        
                        $res = $req->fetch();
                        $somme = $res['somme'];
                        
                        
                    } catch (PDOException $e) {
                        echo "Database error: " . $e->getMessage();
                    }
                        ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total des gains
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                                                </div>
                                                <div class="col">
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $somme ?> DH</div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-regular fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                       try {
                        $pdo = dbU_connect();
                        
                        $req = $pdo->prepare("SELECT COUNT(idClient) AS clientsCount FROM client where idUser = :idUser");
                        $iduser = $_SESSION['id'];
                        $req->bindValue(':idUser', $iduser, PDO::PARAM_STR);
                        $req->execute();
                        
                        $res = $req->fetch();
                        $clientsCount = $res['clientsCount'];
                        
                    } catch (PDOException $e) {
                        echo "Database error: " . $e->getMessage();
                    }
                        ?>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Nombre de clients</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $clientsCount ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Feedback</h6>
                                    
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                <div class="card-body text-center">
                        <img src="../img/logo.png" alt="Profile Picture" class="animated-image" width="100" height="100">
                        <h5 class="card-title">CHAIB Saad</h5>
                        <p class="card-text">We need your feedback</p>
                        <a href="mailto:saadchaib03@gmail.com" class="btn btn-danger mb-2">
                            <i class="fas fa-envelope"></i> Gmail
                        </a>
                        <a href="https://www.facebook.com/" class="btn btn-primary mb-2">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                        <a href="https://www.github.com/Schaib03" class="btn btn-info mb-2">
                            <i class="fab fa-github"></i> GitHub
                        </a>
                        <a href="https://www.linkedin.com/in/saad-chaib-0916831b0/" class="btn btn-secondary mb-2">
                            <i class="fab fa-linkedin-in"></i> LinkedIn
                        </a>
                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                                   
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                        <canvas id="myChart" height="300"></canvas>
                                    
                                   
                                </div>
                            </div>
                        </div>
                    </div>

                   
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; CHAIB Saad & Sqli 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
var xValues = ["Factures payées", "Factures impayées", "Factures partiellement payées"];
var yValues = [paidCount,impaidCount, PartipaidCount];
var barColors = [
  "#4e73df",
  "#1cc88a",
  "#36b9cc",
 
];

new Chart("myChart", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    
  }
});
</script>

</body>

</html>