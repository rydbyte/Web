# 📄 PROJECT – Wie is het?

In dit project ga je werken met personages en kenmerken uit een JSON-bestand en deze verwerken met PHP. Je leert om een lijst/verzameling/array uit te lezen, kenmerken te gebruiken en filteren op basis van voorwaarden.

Aan het einde kun je kenmerken gebruiken om nieuwe verzamelingen te maken zoals:  
*“toon alle vrouwen”* of *“toon alle kale mannen met een bril”*.

---

## 🎯 Leerdoelen

Aan het einde van deze opdrachten kun je:

✔ gegevens uit arrays ophalen en tonen  
✔ logische voorwaarden toepassen met `if`  
✔ selecties maken op basis van kenmerken  
✔ resultaten tonen op het scherm  
✔ willekeurige data kiezen  
✔ HTML formulieren verwerken in PHP  
✔ het verschil uitleggen tussen `$_GET` en `$_POST`  
✔ een eenvoudig spel bouwen met PHP en HTML formulieren  

---

## 📁 Geleverde bestanden

Deze bestanden krijg je automatisch mee:

```
/data/charactersData.json
/includes/load_data.php
/includes/assignment7_helper.php
/images/
/student_assignments/
```

Je hoeft het JSON-bestand niet zelf te maken. De data wordt geladen via:

```php
require_once __DIR__ . '/../includes/load_data.php';
$characterDataset = load_data();

// echo '<pre>';
// var_dump($characterDataset);
// echo '</pre>';
```

---

## 🔑 Belangrijk concept (voor opdracht 7 en 8)

Een HTML formulier wordt in PHP een **associatieve array**.

De **keys** in `$_GET` of `$_POST` komen direct uit de `name=""` attributen van je HTML inputs:

- `name="feature"` → `$_POST['feature']` of `$_GET['feature']`
- `name="answer"` → `$_POST['answer']` of `$_GET['answer']`

---

## 🧩 Opdrachten

### 🟦 Opdracht 1 — Toon alle personages
Toon alle personages op het scherm.

### 🟩 Opdracht 2 — Toon de lijst met features van één persoon
Toon alle kenmerken van een gekozen persoon.

### 🟥 Opdracht 3 — Toon alle vrouwen
Filter op `vrouw == 1` en toon de namen.

### 🟨 Opdracht 4 — Toon alle mannen die kaal zijn en een bril hebben
Filter op `man == 1`, `kaal == 1` en `bril == 1`.

### 🟪 Opdracht 5 — Toon alle personages met hun afbeelding
Toon een lijst van alle personages, elk met hun bijbehorende afbeelding.

### 🟧 Opdracht 6 — Toon een willekeurig personage
Kies willekeurig één personage uit de lijst en toon zijn/haar naam en afbeelding.

### 🟦 Opdracht 7 — Formulier → `$_GET` / `$_POST`
Leren hoe formulierdata als associatieve array binnenkomt.

### ⬛️ Opdracht 8 — Bouw het "Wie is het?" spel
Bouw een interactief spel met formulieren.

---

## ✔️ Resultaat

Na afloop kun je arrays uitlezen, filteren en formulierdata verwerken.


## Disclaimer

This project is an educational assignment created for learning purposes only.

"Guess Who?" and all related character images are trademarks and copyrighted
material of Hasbro, Inc.

This project is:
- non-commercial
- not affiliated with Hasbro
- not intended for redistribution of copyrighted assets

All images are used solely for educational demonstration purposes.
