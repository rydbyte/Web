<?php
    require_once __DIR__ . '/../includes/load_data.php';
    $characterDataset = load_data();

    foreach ($characterDataset as $key => $value)
    {
        if ($key === "_feature_order") {
            continue;
        }
            if ($value["features"]["woman"] === 1)
            {
                echo $key. "<br>";
            }

    }
    // Opdracht 3: Toon alle personages die een vrouw zijn.
    // Tip: Loop door alle personages en controleer de 'woman' feature.
