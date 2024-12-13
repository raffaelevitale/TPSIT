<?php
// home.php
session_start();
if (!isset($_SESSION['user_type'])) {
    header('Location: index.php');
    exit();
}
require 'functions.php';

$user_type = $_SESSION['user_type'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data'];
    $partenza = $_POST['partenza'];
    $arrivo = $_POST['arrivo'];

    $orari = generaOrariPartenza($data);
    $orario_partenza = $orari[0]; // Primo orario disponibile

    $stazioni = getStazioni($partenza, $arrivo);
    $durata_viaggio = (count($stazioni) - 1) * 13; // Sottrai la stazione di partenza
    $orario_arrivo = aggiungiMinuti($orario_partenza, $durata_viaggio);

    $prezzo = calcolaPrezzo($stazioni);

    if ($user_type == 2 && isset($_POST['prenota'])) {
        // Logica di prenotazione (da implementare)
        $messaggio = "Biglietto prenotato con successo!";
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Benvenuto!</h1>

    <form method="post" action="">
        <label for="data">Data:</label>
        <input type="date" name="data" required><br>

        <label for="partenza">Stazione di Partenza:</label>
        <select name="partenza" required>
            <?php foreach ($tutte_stazioni as $stazione): ?>
                <option value="<?php echo $stazione; ?>"><?php echo $stazione; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="arrivo">Stazione di Arrivo:</label>
        <select name="arrivo" required>
            <?php foreach ($tutte_stazioni as $stazione): ?>
                <option value="<?php echo $stazione; ?>"><?php echo $stazione; ?></option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit">Consulta Orari</button>

        <?php if ($user_type == 2): ?>
            <button type="submit" name="prenota">Prenota Biglietto</button>
        <?php endif; ?>
    </form>

    <?php if (isset($orario_partenza)): ?>
        <h2>Dettagli del Viaggio</h2>
        <p><strong>Data:</strong> <?php echo $data; ?></p>
        <p><strong>Partenza:</strong> <?php echo $partenza; ?> alle <?php echo $orario_partenza; ?></p>
        <p><strong>Arrivo:</strong> <?php echo $arrivo; ?> alle <?php echo $orario_arrivo; ?></p>
        <p><strong>Prezzo:</strong> €<?php echo number_format($prezzo, 2); ?></p>
    <?php endif; ?>

    <?php if (isset($messaggio)): ?>
        <p class="success"><?php echo $messaggio; ?></p>
    <?php endif; ?>

    <a href="logout.php">Logout</a>
</body>
</html>