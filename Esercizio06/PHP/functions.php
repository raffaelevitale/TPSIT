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
?>