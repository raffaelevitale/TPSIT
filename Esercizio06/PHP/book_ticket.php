<?php
session_start();
require 'functions.php';

if (!isset($_SESSION['userType']) || $_SESSION['userType'] != 2) {
    header('Location: index.php');
    exit();
}

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $departure_station = $_POST['departure_station'] ?? '';
    $arrival_station = $_POST['arrival_station'] ?? '';
    $departure_time = $_POST['departure_time'] ?? '';
    $arrival_time = $_POST['arrival_time'] ?? '';
    $date = $_POST['date'] ?? '';
    $price = $_POST['price'] ?? '';

    if ($departure_station && $arrival_station && $departure_time && $arrival_time && $date && $price) {
        // Qui potresti aggiungere la logica per salvare la prenotazione in un database
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Prenota Biglietto - Servizio Treni</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="text-center mb-0">
                    <i class="fas fa-ticket-alt"></i> Biglietto del Treno
                </h2>
            </div>
            <div class="card-body">
                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <h4 class="alert-heading">
                            <i class="fas fa-check-circle"></i> Prenotazione Confermata!
                        </h4>
                        <hr>
                        <div class="ticket-card">
                            <div class="ticket-header bg-primary text-white p-3 rounded-top">
                                <h5 class="mb-0"><i class="fas fa-train"></i> Dettagli del Viaggio</h5>
                            </div>
                            <div class="ticket-body border p-4 rounded-bottom">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="text-muted">Data del Viaggio</label>
                                            <p class="h5"><?= htmlspecialchars(date('d/m/Y', strtotime($date))) ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted">Stazione di Partenza</label>
                                            <p class="h5"><?= htmlspecialchars($departure_station) ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted">Orario di Partenza</label>
                                            <p class="h5"><?= htmlspecialchars($departure_time) ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="text-muted">Stazione di Arrivo</label>
                                            <p class="h5"><?= htmlspecialchars($arrival_station) ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted">Orario di Arrivo</label>
                                            <p class="h5"><?= htmlspecialchars($arrival_time) ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted">Prezzo</label>
                                            <p class="h4 text-success">€<?= htmlspecialchars(number_format($price, 2)) ?></p>
                                        </div> <!-- Chiusura corretta del div.mb-3 -->
                                    </div>
                                </div> <!-- Chiusura corretta del div.row -->
                                <div class="text-center mt-3">
                                    <div class="barcode">
                                        <i class="fas fa-barcode fa-2x"></i>
                                        <small class="d-block text-muted mt-2">Biglietto #<?= rand(10000, 99999) ?></small>
                                    </div>
                                </div>
                            </div> <!-- Chiusura corretta del div.ticket-body -->
                        </div> <!-- Chiusura corretta del div.ticket-card -->
                    </div>
                <?php endif; ?>

                <div class="text-center mt-4">
                    <a href="departure_times.php" class="btn btn-primary me-2">
                        <i class="fas fa-search"></i> Cerca altri orari
                    </a>
                    <a href="home.php" class="btn btn-secondary">
                        <i class="fas fa-home"></i> Torna alla Home
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
    .ticket-card {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    .ticket-card:hover {
        transform: translateY(-5px);
    }
    .barcode {
        border-top: 1px dashed #dee2e6;
        padding-top: 20px;
        margin-top: 20px;
    }
    </style>
</body>
</html>
