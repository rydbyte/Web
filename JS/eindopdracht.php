<?php

function fetchCountry($url) {
    $response = @file_get_contents($url);
    return $response = json_decode($response, true);
}

$query = $_GET['query'] ?? null;
$error = "";
$countryResult = "";

if (!$query) {
    $countryResult = "<p>Error: `query` parameter must be present.</p>";
}

if ($query) {
$query = strtolower($query);

if ($_GET['type'] === 'Api') {
    $data = fetchCountry("https://restcountries.com/v3.1/name/$query");

    if (!$data) {
        $data = fetchCountry("https://restcountries.com/v3.1/name/$query?fullText=true");
    }

    if (!$data) {
        $data = fetchCountry("https://restcountries.com/v3.1/capital/$query");
    }

    if (!$data) {
        $countryResult = "<p>No matching country found.</p>";
    }

    if ($data) {
        $country = $data[0];
        $name = $country["name"]["common"];
        $region = $country["region"];
        $subRegion = $country["subregion"];
        $capital = $country["capital"][0] ?? "Unknown";
        $population = $country["population"] ?? "Unknown";
        $languages = implode(", ", $country["languages"]);
        $currencyCode = array_key_first($country["currencies"]);
        $currencyName = $country["currencies"][$currencyCode]["name"];
        $flag = $country["flags"]["png"];

        $countryResult = "
            <div class='country-result'>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Region:</strong> $region</p>  
                <p><strong>Sub-Region:</strong> $subRegion</p>
                <p><strong>Capital:</strong> $capital</p>
                <p><strong>Population:</strong> $population</p>
                <p><strong>Languages:</strong> $languages</p>
                <p><strong>Currency:</strong> $currencyName ($currencyCode)</p>
                <img src='$flag' alt='$flag'>
            </div>
        ";
    }
}
}

if ($_GET['type'] === 'DataBase')
{
    $servername = "127.0.0.1";
    $username = "root";
    $password = "Tweedinosdiedansen2!";
    $dbname = "pokemon";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (is_numeric($query)) {
        $sql = "
        select * from pokemon_types join types
        on pokemon_types.type_id = types.id
        join pokemon on pokemon_types.pokemon_id = pokemon.id
        where pokemon.id = '$query'";
    }

    if (!is_numeric($query)) {
        $sql = "
        select * from pokemon_types join types
        on pokemon_types.type_id = types.id
        join pokemon on pokemon_types.pokemon_id = pokemon.id
        where pokemon.name = '$query'";
    }
    $result = $conn->query($sql);
    $hit = 0;
    $type = null;

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            if ($hit >= 1){
                $type = $type."/".ucfirst($row["t"]);
            }
            if ($hit == 0) {
                $hit = 1;
                $id = $row["id"];
                $name = ucfirst($row["name"]);
                if (!$type) {$type = ucfirst($row["t"]);}
                $height = $row["height"];
                $weight = $row["weight"];
            }
        }
        $countryResult = "
            <div class='country-result'>
                <p><strong>Id:</strong> $id</p>
                <p><strong>Name:</strong> $name</p>  
                <p><strong>Type:</strong> $type</p>
                <p><strong>Height:</strong> $height</p>
                <p><strong>Weight:</strong> $weight</p>
                <img src='https://raw.githubusercontent.com/PokeAPI/sprites/refs/heads/master/sprites/pokemon/$id.png' alt='a'>
            </div>
        ";
    }
    else {
        $countryResult = "<div>0 results</div>";
    }

    $conn->close();
}
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
<dl>
    <dt><button id="btnApi">Api</button></dt>
    <dt><button id="btnDataBase">DataBase</button></dt>
    <dt><h1 id="current">Current: </h1></dt>
</dl>
<form method="GET">
    <input type="search" id="fsearch" name="query" placeholder="Search for a Country...">
    <input type="submit" id="fbutton" value="Search">
</form>

<?= $error ?>
<?= $countryResult ?>

</body>
</html>
