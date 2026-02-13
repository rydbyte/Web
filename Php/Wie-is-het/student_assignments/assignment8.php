<?php
    session_start();
    require_once __DIR__ . '/../includes/load_data.php';
    $characterDataset = load_data();

    // Opdracht 7: Bouw het "Wie is het?" spel.
    // 1. Kies een willekeurig personage en sla dit op in de sessie.
    // 2. Maak een formulier waarmee de speler een feature kan kiezen om te vragen.
    // 3. Vergelijk de gekozen feature met die van het geheime personage.
    // 4. Geef antwoord ("Ja" of "Nee").
    // 5. Filter de lijst van overgebleven kandidaten op basis van het antwoord.
    // 6. Toon de overgebleven kandidaten.
    // 7. Voeg een reset-knop toe om een nieuw spel te starten.
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Guess Who – Board Game</title>
    <!-- je mag met AI een passende CSS thema genereren -->
</head>
<body>
    <!-- Hier komt de HTML voor je spel. Bouw de interface met de game board, de vragen en de kandidaten. -->
</body>
</html>
