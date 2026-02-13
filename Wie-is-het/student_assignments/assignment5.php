<?php
    require_once __DIR__ . '/../includes/load_data.php';
    $characterDataset = load_data();

    foreach ($characterDataset as $key => $value)
    {
        if ($key === "_feature_order") {
            continue;
        }
        $img = "../images/{$key}.png";
        echo $key. "<br>". "<img alt='s' src=$img ><br>";

    }

    // Opdracht 5: Toon alle personages met hun afbeelding.
    // Tip: De images staan in de map '../images/' en hebben de naam van het personage + '.png'.
    // Gebruik HTML om de lijst en images weer te geven.
