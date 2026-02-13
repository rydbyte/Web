<?php
/**
 * Laadt het Wie-is-het JSON bestand en geeft de data terug als array
 * Gebruiksvoorbeeld:
 *   $characterDataset = load_data();
 */

    function load_data() {
        $file = __DIR__ . '/../data/charactersData.json';

        if (!file_exists($file)) {
            die("Fout: JSON bestand niet gevonden!\n");
        }

        $json = file_get_contents($file);
        if ($json === false) {
            die("Fout: kon JSON bestand niet lezen!\n");
        }

        $data = json_decode($json, true);
        if ($data === null) {
            die("Fout: JSON kon niet geparsed worden!\n");
        }

        return $data;
    }