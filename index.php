<?php
// Ottieni la lista dei file e delle cartelle nella directory corrente
$files = scandir('.');

// Filtra i risultati per rimuovere '.' e '..'
$files = array_diff($files, array('.', '..'));

// Inizializza il conteggio delle cartelle
$dir_count = 0;

// Inizia l'output HTML
echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<title>Esplora File</title>';
echo '<style>';
echo 'body { background-color: #121212; color: #ffffff; font-family: Arial, sans-serif; }';
echo 'a { color: #1e90ff; text-decoration: none; }';
echo 'a:hover { text-decoration: underline; }';
echo 'ul { list-style-type: none; padding: 0; }';
echo 'li { margin: 5px 0; }';
echo '.icon { margin-right: 10px; }';
echo '</style>';
echo '</head>';
echo '<body>';
echo '<h1>Esplora File</h1>';
echo '<ul>';

// Mostra ogni file e cartella come link
foreach ($files as $file) {
    $mod_time = date("d-m-Y H:i:s", filemtime($file));
    if (is_dir($file)) {
        // Incrementa il conteggio delle cartelle
        $dir_count++;
        // Se è una cartella, aggiungi una slash finale e un'icona
        echo '<li><span class="icon">📁</span><a href="'.$file.'/">'.$file.'/</a> - Ultima modifica: '.$mod_time.'</li>';
    } else {
        // Aggiungi un'icona per i file
        echo '<li><span class="icon">📄</span><a href="'.$file.'">'.$file.'</a> - Ultima modifica: '.$mod_time.'</li>';
    }
}

echo '</ul>';
echo '<p>Numero totale di cartelle: '.$dir_count.'</p>';
echo '</body>';
echo '</html>';
?>