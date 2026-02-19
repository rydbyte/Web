<?php
    require_once __DIR__ . '/../includes/load_data.php';
    $characterDataset = load_data();

    $rad = array_rand($characterDataset);

        $img = "../images/{$rad}.png";
        echo $rad. "<br>". "<img alt='s' src=$img ><br>";



    // Opdracht 6: Kies een willekeurig personage en toon zijn/haar afbeelding.
    // Tip: Gebruik de array_rand() functie om een willekeurige key uit de array te halen.
