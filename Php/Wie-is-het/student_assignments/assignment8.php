<?php
session_start();
require_once __DIR__ . '/../includes/load_data.php';

$characterDataset = load_data();

if (!isset($_SESSION["radCharacter"]))
{

    do
    {
        $radCharacter = array_rand($characterDataset);
    }
    while ($radCharacter === "_feature_order");

    $_SESSION["attempts"] = 10;
    $_SESSION["radCharacter"] = $radCharacter;
    $_SESSION["characters"] = $characterDataset;
}

echo "Secret character: " . $_SESSION["radCharacter"] . "<br>";

if (isset($_POST["ask"]))
{

    $_SESSION["attempts"] -= 1;
    echo "Attempts: ".$_SESSION["attempts"] . "<br>";
    if ($_SESSION["attempts"] <= 0)
    {
        echo '<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Guess Who – Board Game</title>
    <link rel="stylesheet" href="../css/assignment8.css">
    <!-- je mag met AI een passende CSS thema genereren -->
</head>';
        echo "No more attempts left";
        echo '<br><label for="char">Is your character: </label>
    <form method="post">
        <select name="char" id="char">
            <option value="Alex">Alex</option>
            <option value="Alfred">Alfred</option>
            <option value="Anita">Anita</option>
            <option value="Anne">Anne</option>
            <option value="Bernard">Bernard</option>
            <option value="Bill">Bill</option>
            <option value="Charles">Charles</option>
            <option value="Claire">Claire</option>
            <option value="David">David</option>
            <option value="Eric">Eric</option>
            <option value="Frans">Frans</option>
            <option value="George">George</option>
            <option value="Herman">Herman</option>
        </select>

        <input type="submit" name="guess" value="Guess"/>
    </form>';
        return;
    }
    $feature = $_POST["feature"];
    $secret = $_SESSION["radCharacter"];
    $f = ucfirst($feature);

    if ($_SESSION["characters"][$secret]["features"][$feature] == 1)
    {

        echo "<p>$f: JA</p>";
        foreach ($_SESSION["characters"] as $key => $value)
        {
            if ($key === "_feature_order")
            {
            continue;
            }
            if (!$_SESSION["characters"][$key]["features"][$feature] == 1)
            {
                unset($_SESSION["characters"][$key]);
            }
        }

    }
    else
    {
        echo "<p>$f: NEE</p>";
        foreach ($_SESSION["characters"] as $key => $value)
        {
            if ($key === "_feature_order")
            {
                continue;
            }
            if (!$_SESSION["characters"][$key]["features"][$feature] == 0)
            {
                unset($_SESSION["characters"][$key]);
            }
        }
    }
}

if (isset($_POST["guess"]))
{
    $char = $_POST["char"];
    $secret = $_SESSION["radCharacter"];
    echo '<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Guess Who – Board Game</title>
    <link rel="stylesheet" href="../css/assignment8.css">
    <!-- je mag met AI een passende CSS thema genereren -->
</head>';

    if ($_SESSION["characters"][$secret] == $characterDataset[$char])
    {
        echo "<p>Antwoord: The character was </p>".$char;
        echo '<form method="post">
        <button type="submit" name="reset">Reset Game</button>
      </form>';
        return;
    }
    else
    {
        echo "<p>Antwoord: The character was not</p>".$char;
        echo '<form method="post">
        <button type="submit" name="reset">Reset Game</button>
      </form>';
        return;
    }
}
if (isset($_POST['reset']))
{
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
foreach ($_SESSION["characters"] as $key => $value)
{

    if ($key === "_feature_order")
    {
        continue;
    }

    $img = "../images/$key.png";
    echo "<img alt='$key' src='$img'>";
}

    // Opdracht 7: Bouw het "Wie is het?" spel.
    // 1. Kies een willekeurig personage en sla dit op in de sessie.
    // 2. Maak een formulier waarmee de speler een feature kan kiezen om te vragen.
    // 3. Vergelijk de gekozen feature met die van het geheime personage.
    // 4. Geef antwoord ("Ja" of "Nee").
    // 5. Filter de lijst van overgebleven kandidaten op basis van het antwoord.
    // 6. Toon de overgebleven kandidaten.
    // 7. Voeg een reset-knop toe om een nieuw spel te starten.
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Guess Who – Board Game</title>
    <link rel="stylesheet" href="../css/assignment8.css">
    <!-- je mag met AI een passende CSS thema genereren -->
</head>
<body>
    <!-- Hier komt de HTML voor je spel. Bouw de interface met de game board, de vragen en de kandidaten. -->
    <br><label for="feature">Feature: </label>
    <form method="post">
        <select name="feature" id="feature">
            <option value="bald">Bald</option>
            <option value="glasses">Glasses</option>
            <option value="man">Man</option>
            <option value="woman">Woman</option>
            <option value="mustache">Mustache</option>
            <option value="beard">Beard</option>
            <option value="hair_blond">Blonde Hair</option>
            <option value="hair_brown">Brown Hair</option>
            <option value="hair_black">Black Hair</option>
            <option value="hair_red">Red Hair</option>
            <option value="hair_white">White Hair</option>
            <option value="earrings">Earrings</option>
            <option value="hat">Hat</option>
        </select>

        <input type="submit" name="ask" value="Ask"/>
    </form>
    <br><label for="char">Is your character: </label>
    <form method="post">
        <select name="char" id="char">
            <option value="Alex">Alex</option>
            <option value="Alfred">Alfred</option>
            <option value="Anita">Anita</option>
            <option value="Anne">Anne</option>
            <option value="Bernard">Bernard</option>
            <option value="Bill">Bill</option>
            <option value="Charles">Charles</option>
            <option value="Claire">Claire</option>
            <option value="David">David</option>
            <option value="Eric">Eric</option>
            <option value="Frans">Frans</option>
            <option value="George">George</option>
            <option value="Herman">Herman</option>
            <option value="Joe">Joe</option>
            <option value="Maria">Maria</option>
            <option value="Max">Max</option>
            <option value="Paul">Paul</option>
            <option value="Peter">Peter</option>
            <option value="Philip">Philip</option>
            <option value="Richard">Richard</option>
            <option value="Robert">Robert</option>
            <option value="Sam">Sam</option>
            <option value="Susan">Susan</option>
            <option value="Tom">Tom</option>
            <option value="Herman">Herman</option>

        </select>

        <input type="submit" name="guess" value="Guess"/>
    </form>
    <form method="post">
        <button type="submit" name="reset">Reset Game</button>
    </form>
</body>
</html>
