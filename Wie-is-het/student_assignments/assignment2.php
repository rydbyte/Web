<?php
    require_once __DIR__ . '/../includes/load_data.php';
    $characterDataset = load_data();

    foreach ($characterDataset["Alex"]["features"] as $key => $value)
    {
        if ($value == 1)
        {
            $value = "JA";
        }
        if ($value == 0)
        {
            $value = "NEE";
        }

        echo $key." ".$value."<br>";
    }

    // Opdracht 2: Kies één personage en toon al zijn/haar kenmerken (features).
    // Tip: Haal eerst de features op en loop er doorheen.
    // Toon per feature of het 'JA' (true) of 'NEE' (false) is.
