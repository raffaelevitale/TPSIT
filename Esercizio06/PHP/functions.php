<?php
$stazioni = ['Savona', 'Fossano', 'Cuneo', 'Savigliano', 'Racconigi', 'Carmagnola', 'Torino'];

function trovaOrariPartenze($data) {
    $giorno = date('d', strtotime($data));
    $minuti = str_pad($giorno % 60, 2, '0', STR_PAD_LEFT);
    $orari = [];
    for ($ora = 8; $ora <= 22; $ora += 2) {
        $orari[] = sprintf('%02d:%02d', $ora, $minuti);
    }
    return $orari;
}

function trovaPercorso($partenza, $arrivo) {
    global $stazioni;
    $inizio = array_search($partenza, $stazioni);
    $fine = array_search($arrivo, $stazioni);

    if ($inizio === false || $fine === false || $inizio >= $fine) {
        return [];
    }
    return array_slice($stazioni, $inizio, $fine - $inizio + 1);
}

function calcolaOrarioArrivo($orarioPartenza, $numeroStazioni) {
    $minuti = $numeroStazioni * 13;
    return date('H:i', strtotime($orarioPartenza) + ($minuti * 60));
}

function calcolaPrezzo($numeroStazioni) {
    return 2.50 + ($numeroStazioni * 1.20);
}

function autenticaUtente($username, $password) {
    $utenti = [
        'utente1' => ['password' => 'password1', 'tipo' => 1],
        'utente2' => ['password' => 'password2', 'tipo' => 2],
    ];

    if (isset($utenti[$username]) && $utenti[$username]['password'] === $password) {
        return $utenti[$username]['tipo'];
    }
    return false;
}

// Rinominare questa funzione in italiano per coerenza
function mostraStazioni() {
    global $stazioni;
    return $stazioni;
}
?>