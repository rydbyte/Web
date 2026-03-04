<?php

function fetchCountry($url) {
    $response = @file_get_contents($url);
    return $response ? json_decode($response, true) : null;
}

$query = $_GET['query'] ?? null;

if (!$query) {
    die("Error: `query` parameter must be present.");
}

$query = strtolower($query);

$data = fetchCountry("https://restcountries.com/v3.1/name/$query");

if (!$data) {
    $data = fetchCountry("https://restcountries.com/v3.1/name/$query?fullText=true");
}

if (!$data) {
    $data = fetchCountry("https://restcountries.com/v3.1/capital/$query");
}

if (!$data) {
    die("No matching country found.");
}

$country = $data[0];

$name = $country["name"]["common"];
$region = $country["region"];
$capital = $country["capital"][0] ?? "Unknown";
$languages = implode(", ", $country["languages"]);
$currencyCode = array_key_first($country["currencies"]);
$currencyName = $country["currencies"][$currencyCode]["name"];

$countryResult = "
            <div class='country-result'>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Region:</strong> $region</p>
                <p><strong>Capital:</strong> $capital</p>
                <p><strong>Languages:</strong> $languages</p>
                <p><strong>Currency:</strong> $currencyName ($currencyCode)</p>
            </div>
        ";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Country Search</title>
    <link rel="stylesheet" href="eindopdracht.css">
</head>
<body>

<script src="eindopdracht.js"></script>

<form method="GET">
    <input type="search" id="fsearch" name="query" placeholder="Search for a country...">
    <input type="submit" id="fbutton" value="Search">
</form>

<?= $countryResult ?>

</body>
</html>
