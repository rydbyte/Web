<?php
    require_once __DIR__ . '/../includes/load_data.php';
    $characterDataset = load_data();

    foreach ($characterDataset as $key => $value)
    {
        if ($key === "_feature_order") {
            continue;
        }
        if ($value["features"]["man"] === 1 and $value["features"]["bald"] === 1 and $value["features"]["glasses"] === 1)
        {
            echo $key. "<br>";
        }

    }

    // Opdracht 4: Toon alle personages die een man zijn, kaal zijn en een bril hebben.
    // Tip: Combineer meerdere voorwaarden in je if-statement.
