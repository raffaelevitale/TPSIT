<?php
// Ottieni la lista dei file e delle cartelle nella directory corrente
$files = scandir('.');

// Filtra i risultati per rimuovere '.' e '..'
$files = array_diff($files, array('.', '..'));

// Inizia l'output HTML
echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<title>Elenco Directory</title>';
echo '</head>';
echo '<body>';
echo '<h1>Elenco dei file e delle cartelle</h1>';
echo '<ul>';

// Mostra ogni file e cartella come link
foreach ($files as $file) {
    if (is_dir($file)) {
        // Se è una cartella, aggiungi una slash finale
        echo '<li><a href="'.$file.'/">'.$file.'/</a></li>';
    } else {
        echo '<li><a href="'.$file.'">'.$file.'</a></li>';
    }
}

echo '</ul>';
echo '</body>';
echo '</html>';
?>