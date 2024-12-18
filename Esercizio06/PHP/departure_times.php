<?php
session_start();
require 'functions.php';

if (!isset($_SESSION['userType'])) {
    header('Location: index.php');
    exit();
}

$stations = getStations();
$error = '';
$schedules = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $departure = $_POST['departure'] ?? '';
    $arrival = $_POST['arrival'] ?? '';
    $date = $_POST['date'] ?? '';

    if ($departure && $arrival && $date) {
        $route = getStazioni($departure, $arrival);
        if (!empty($route)) {
            $departureTimes = generateDepartureTimes($date);
            foreach ($departureTimes as $time) {
                $arrivalTime = calculateArrivalTime($time, count($route) - 1);
                $price = calculateTicketPrice(count($route) - 1);
                $schedules[] = [
                    'departure_time' => $time,
                    'arrival_time' => $arrivalTime,
                    'price' => $price
                ];
            }
        } else {
            $error = 'Percorso non valido';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Orari Partenze - Servizio Treni</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="text-center mb-0"><i class="fas fa-train"></i> Consulta Orari</h2>
            </div>
            <div class="card-body">
                <form method="post" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <select name="departure" class="form-select" required>
                                <option value="">Partenza</option>
                                <?php foreach ($stations as $station): ?>
                                    <option value="<?= htmlspecialchars($station) ?>"><?= htmlspecialchars($station) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="arrival" class="form-select" required>
                                <option value="">Arrivo</option>
                                <?php foreach ($stations as $station): ?>
                                    <option value="<?= htmlspecialchars($station) ?>"><?= htmlspecialchars($station) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="date" class="form-control" required min="<?= date('Y-m-d') ?>">
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cerca</button>
                        <a href="home.php" class="btn btn-secondary"><i class="fas fa-home"></i> Home</a>
                    </div>
                </form>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <?php if (!empty($schedules)): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Partenza</th>
                                    <th>Arrivo</th>
                                    <th>Prezzo</th>
                                    <?php if ($_SESSION['userType'] == 2): ?>
                                        <th>Azione</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($schedules as $schedule): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($schedule['departure_time']) ?></td>
                                        <td><?= htmlspecialchars($schedule['arrival_time']) ?></td>
                                        <td><?= number_format($schedule['price'], 2) ?>€</td>
                                        <?php if ($_SESSION['userType'] == 2): ?>
                                            <td>
                                                <form action="book_ticket.php" method="post">
                                                    <input type="hidden" name="departure_station" value="<?= htmlspecialchars($departure) ?>">
                                                    <input type="hidden" name="arrival_station" value="<?= htmlspecialchars($arrival) ?>">
                                                    <input type="hidden" name="departure_time" value="<?= htmlspecialchars($schedule['departure_time']) ?>">
                                                    <input type="hidden" name="arrival_time" value="<?= htmlspecialchars($schedule['arrival_time']) ?>">
                                                    <input type="hidden" name="price" value="<?= htmlspecialchars($schedule['price']) ?>">
                                                    <input type="hidden" name="date" value="<?= htmlspecialchars($date) ?>">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fas fa-ticket-alt"></i> Prenota
                                                    </button>
                                                </form>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
