<!DOCTYPE html>
<html lang="it">

    <head>
        <title>Esercizio 04 PHP - Maggiore di 3 Numeri</title>
        <meta charset="UTF-8">
    </head>

    <body>

        <?php
           function leggiParametri($vetPar) {
                global $N1, $N2, $N3;

                if (isset($vetPar["txtN1"]) && is_numeric($vetPar["txtN1"]))
                    $N1 = intval($vetPar["txtN1"]);
                else
                    echo("Il Primo Numero non è Valido");

                if (isset($vetPar["txtN2"]) && is_numeric($vetPar["txtN2"]))
                    $N2 = intval($vetPar["txtN2"]);
                else
                    echo("Il Secondo Numero non è Valido");

                if (isset($vetPar["txtN3"]) && is_numeric($vetPar["txtN3"]))
                    $N3 = intval($vetPar["txtN3"]);
                else
                    echo("Il Terzo Numero non è Valido");
            }
            

            $N1 = 0;
            $N2 = 0;
            $N3 = 0;

            // Recupero i Parametri (Numeri da Controllare)
            if ($_SERVER["REQUEST_METHOD"] == "GET")
                leggiParametri($_GET);
            else if ($_SERVER["REQUEST_METHOD"] == "POST")
                leggiParametri($_POST);

            echo("I Numeri Inseriti sono [$N1], [$N2] e [$N3]");

            echo("</br></br>");

            if ($N1 > $N2 && $N1 > $N3)
                echo("Il Maggiore è [$N1]");
            else if ($N2 > $N3)
                echo("Il Maggiore è [$N2]");
            else
                echo("Il Maggiore è [$N3]");
            
        ?>

    </body>

</html>