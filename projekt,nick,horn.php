<?php

$geheimeZahl = rand(1, 100); // generate secret number

// UDF
function abstand($eingabe, $geheimeZahl) {
    return abs(intval($eingabe) - $geheimeZahl);
}

// ask number of players
echo "Wie viele Spieler? ";
$anzahl = intval(trim(fgets(STDIN)));

$besteDistanz = 1000;
$gewinner = "";

// loop
for ($i = 1; $i <= $anzahl; $i++) {
    echo "Name Spieler $i: ";
    $name = trim(fgets(STDIN));


    do {
        echo "Zahl von $name (1-100): ";
        $eingabe = trim(fgets(STDIN));

        //Regex check
        if (!preg_match("/^[0-9]+$/", $eingabe)) {
            echo "Bitte nur Zahlen eingeben\n";
            $zahl = null;
        } else {
            $zahl = intval($eingabe);
        }
    } while ($zahl === null);

    // calculation
    $distanz = abstand($zahl, $geheimeZahl);

    if ($distanz < $besteDistanz) {
        $besteDistanz = $distanz;
        $gewinner = $name;
    }
}
// winner output
echo "\nDie geheime Zahl war: $geheimeZahl\n";
echo "Gewinner: $gewinner\n";

// save result in gewinner.txt
file_put_contents("gewinner.txt", "Gewinner: $gewinner, Zahl: $geheimeZahl\n", FILE_APPEND);

?>
