<!DOCTYPE html>
<html lang="it">

    <head>
        <title>Esercizio 04 PHP - Maggiore di 3 Numeri</title>
        <meta charset="UTF-8">
    </head>

    <body>

        <?php
           function leggiParametri($vetPar) {
                // TO DO
            }
            

            $N1 = 0;
            $N2 = 0;
            $N3 = 0;

            // Recupero i Parametri (Numeri da Controllare)
            if ($_SERVER["REQUEST_METHOD"] == "GET")
                leggiParametri($_GET);
            else if ($_SERVER["REQUEST_METHOD"] == "POST")
                leggiParametri($_POST);

            // da finire

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