<?php
// functions.php
$tutte_stazioni = ['Savona', 'Fossano', 'Cuneo', 'Savigliano', 'Racconigi', 'Carmagnola', 'Torino'];

function generaOrariPartenza($data) {
    $giorno = date('d', strtotime($data));
    $minuto = str_pad($giorno % 60, 2, '0', STR_PAD_LEFT); // Assicura minuti validi
    $orari = [];
    for ($ora = 8; $ora <= 22; $ora += 2) {
        $orari[] = sprintf('%02d:%02d', $ora, $minuto);
    }
    return $orari;
}

function getStazioni($partenza, $arrivo) {
    global $tutte_stazioni;
    $inizio = array_search($partenza, $tutte_stazioni);
    $fine = array_search($arrivo, $tutte_stazioni);

    if ($inizio === false || $fine === false || $inizio >= $fine) {
        return [];
    }
    return array_slice($tutte_stazioni, $inizio, $fine - $inizio + 1);
}

function aggiungiMinuti($orario, $minuti_da_aggiungere) {
    $timestamp = strtotime($orario);
    $nuovo_timestamp = $timestamp + ($minuti_da_aggiungere * 60);
    return date('H:i', $nuovo_timestamp);
}

function calcolaPrezzo($stazioni) {
    $numero_stazioni = count($stazioni) - 1; // Non conta la stazione di partenza
    $prezzo = 2.50 + ($numero_stazioni * 1.20);
    return $prezzo;
}

function authenticateUser($username, $password) {
    // Simulazione di autenticazione
    // Utenti di esempio
    $users = [
        'utente1' => ['password' => 'password1', 'type' => 1],
        'utente2' => ['password' => 'password2', 'type' => 2],
    ];

    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        return $users[$username]['type'];
    } else {
        return false;
    }
}

function generateDepartureTimes($date) {
    $day = (int)date('d', strtotime($date));
    $minute = str_pad($day % 60, 2, '0', STR_PAD_LEFT);
    $times = [];

    for ($hour = 8; $hour <= 22; $hour += 2) {
        $times[] = str_pad($hour, 2, '0', STR_PAD_LEFT) . ":" . $minute;
    }

    return $times;
}

function calculateArrivalTime($departureTime, $stationsCrossed) {
    $additionalMinutes = $stationsCrossed * 13;
    $departureTimestamp = strtotime($departureTime);
    $arrivalTimestamp = $departureTimestamp + ($additionalMinutes * 60);
    return date('H:i', $arrivalTimestamp);
}

function calculateTicketPrice($stationsCrossed) {
    $basePrice = 2.50;
    $variablePrice = $stationsCrossed * 1.20;
    return number_format($basePrice + $variablePrice, 2);
}

function getStations() {
    return ['Savona', 'Fossano', 'Cuneo', 'Savigliano', 'Racconigi', 'Carmagnola', 'Torino'];
}
?>