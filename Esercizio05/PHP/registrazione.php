<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <title>Registrazione PHP</title>
    </head>
    <body>
        <h2>Benvenuto</h2>
        
        <h3>Questi sono i Dati inseriti / selezionati:</h3>

        <?php
            $nome = $_GET["txtNome"];
            echo("Nome: $nome <br>");

            $indirizzo = $_GET["rdbIndirizzo"];
            echo("Indirizzo: $indirizzo <br>");

            //Nel caso degli hobby, che sono più di uno, si utilizza implode per mostrare i valori
            $hobby = $_GET["chkHobbies"];
            echo("Hobby: " . implode(", ", $hobby) . "<br>");

            $citta = $_GET["lstCitta"];
            echo("Città: $citta <br>");

            $segni = $_GET["txtSegni"];
            echo("Segni particolari: $segni <br>");

            //Per la scoperta della scuola, usiamo implode per mostrare i valori selezionati
            $scoperta = $_GET["lstScoperta"];
            echo("Come hai scoperto la scuola: " . implode(", ", $scoperta));
        ?>
    </body>
</html>
