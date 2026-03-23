<?php


if (isset($_GET['query'])) {
$query = strtolower($_GET['query']);

if ($_GET['type'] === 'Api') {

    $data = file_get_contents("https://restcountries.com/v3.1/name/$query");

    if (!$data) {
        $data = file_get_contents("https://restcountries.com/v3.1/name/$query?fullText=true");
    }

    if (!$data) {
        $data = file_get_contents("https://restcountries.com/v3.1/capital/$query");
    }

    if (!$data) {
        $data = null;
    }

    echo $data;
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
        where pokemon.name LIKE '$query%'";
    }
    $result = $conn->query($sql);
    $hit = 0;
    $type = null;
    $name = null;

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            if ($hit >= 1 && $row["name"] == strtolower($name)) {
                $type = $type . "/" . ucfirst($row["t"]);
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
        print_r(json_encode($data = [
            "id" => $id,
            "type" => "$type",
            "name" => "$name",
            "height" => "$height",
            "weight" =>"$weight",
            "img" => "https://raw.githubusercontent.com/PokeAPI/sprites/refs/heads/master/sprites/pokemon/other/showdown/{$id}.gif",
        ]));
    }
    else {
        echo null;
    }

    $conn->close();
}
}

?>
