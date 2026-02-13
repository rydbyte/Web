<?php
    require_once __DIR__ . '/../includes/load_data.php';
    $characterDataset = load_data();

    foreach ($characterDataset as $character => $value)
    {
        if ($character !== "_feature_order")
        {
            echo $character."<br>";
        }
    }

    // Opdracht 1: Toon alle namen van de personages uit de dataset.
    // Tip: Gebruik een foreach-loop.
    // Let op: '_feature_order' is geen personage.
