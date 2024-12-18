<?php
session_start();
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userType = authenticateUser($username, $password);
    if ($userType) {
        $_SESSION['userType'] = $userType;
        $_SESSION['username'] = $username;
    } else {
        header('Location: index.php');
        exit();
    }
} else {
    if (!isset($_SESSION['userType'])) {
        header('Location: index.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Home - Servizio Treni</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="text-center mb-0">
                    <i class="fas fa-user-circle"></i> 
                    Benvenuto, <?php echo htmlspecialchars($_SESSION['username']); ?>!
                </h2>
            </div>
            <div class="card-body">
                <div class="row justify-content-center g-4">
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <i class="fas fa-search fa-3x mb-3 text-primary"></i>
                                <h3>Consulta Orari</h3>
                                <p class="text-muted">Verifica gli orari dei treni e i prezzi dei biglietti</p>
                                <a href="departure_times.php" class="btn btn-primary w-100">
                                    <i class="fas fa-clock"></i> Consulta Partenze
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <?php if ($_SESSION['userType'] == 2): ?>
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <i class="fas fa-ticket-alt fa-3x mb-3 text-success"></i>
                                <h3>Prenota Biglietti</h3>
                                <p class="text-muted">Acquista i biglietti per il tuo viaggio</p>
                                <a href="departure_times.php" class="btn btn-success w-100">
                                    <i class="fas fa-shopping-cart"></i> Prenota Ora
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="text-center mt-4">
                    <a href="logout.php" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>