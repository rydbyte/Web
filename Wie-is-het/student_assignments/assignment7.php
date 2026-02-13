<?php
/**********************************************************
 * OPDRACHT 7 — Formulier → $_GET / $_POST (associatieve arrays)
 *
 * LEERDOEL:
 * - Begrijpen dat zowel $_GET als $_POST associatieve arrays zijn.
 * - Snappen dat keys uit name="" komen.
 * - Verschil zien: GET zichtbaar in URL, POST niet.
 **********************************************************/

require_once __DIR__ . '/../includes/assignment7_helper.php';

/**********************************************************
 * STUDENTEN-CODE — HIER MAG JE WERKEN
 **********************************************************/
$featureLabels = [
        "man"     => "Is het een man?",
        "glasses" => "Draagt hij/zij een bril?",
        "bald"    => "Is hij/zij kaal?"
];

$formFields = [
        'feature' => 'Kenmerk (select)',
        'answer'  => 'Antwoord (select)',
    // 'player_name' => 'Naam (input text)' // bonus
];

// Mode bepalen (get/post) — komt uit querystring zodat je makkelijk kan wisselen
$mode = $_GET['mode'] ?? 'post';
if ($mode !== 'get' && $mode !== 'post') {
    $mode = 'post';
}

// De "bron-array" kiezen
$data = ($mode === 'get') ? $_GET : $_POST;

// Waarden uitlezen uit de gekozen bron
$feature = $data['feature'] ?? null;
$answer  = $data['answer'] ?? null;
/******************** EINDE STUDENTEN-CODE *******************/
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Opdracht 6A – GET vs POST</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/project/css/assignment7.css">
</head>
<body>

<h1>Opdracht 7 – GET vs POST</h1>
<p class="muted">
    Zowel <code>$_GET</code> als <code>$_POST</code> zijn <strong>associatieve arrays</strong>.
    Het verschil is waar de data zichtbaar is (GET in de URL, POST niet).
</p>

<div class="card">
    <h2>0) Kies de methode</h2>
    <p class="muted">Wissel tussen GET en POST om het verschil te zien.</p>

    <div class="toggle">
        <a href="?mode=post" class="<?= $mode === 'post' ? 'active' : '' ?>">
            POST <span class="tag">in $_POST</span>
        </a>
        <a href="?mode=get" class="<?= $mode === 'get' ? 'active' : '' ?>">
            GET <span class="tag">in $_GET + URL</span>
        </a>
    </div>
</div>

<div class="grid">
    <!-- Form kaart: glow -->
    <div class="card play-glow" id="playCard">
        <h2>1) Formulier (hier mag je spelen)</h2>

        <p class="play-hint">
            <span class="dot" aria-hidden="true"></span>
            Wissel tussen GET/POST en verstuur. Kijk rechts hoe de associatieve array verandert.
        </p>

        <form method="<?= h($mode) ?>" id="theForm">
            <!-- mode altijd meenemen zodat je in GET-mode blijft -->
            <input type="hidden" name="mode" value="<?= h($mode) ?>">

            <label for="feature">Kies een kenmerk</label>
            <select id="feature" name="feature" required>
                <option value="" disabled <?= $feature === null ? 'selected' : '' ?>>-- kies --</option>
                <?php foreach ($featureLabels as $key => $label): ?>
                    <option value="<?= h($key) ?>" <?= $feature === $key ? 'selected' : '' ?>>
                        <?= h($label) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="answer">Antwoord</label>
            <select id="answer" name="answer" required>
                <option value="yes" <?= $answer === "yes" ? 'selected' : '' ?>>Ja</option>
                <option value="no"  <?= $answer === "no"  ? 'selected' : '' ?>>Nee</option>
            </select>

            <!-- BONUS: voeg een extra input toe en zie hoe $_GET/$_POST uitbreidt
            <label for="player_name">Jouw naam (bonus)</label>
            <input id="player_name" name="player_name" type="text" placeholder="bijv. Yunus">
            -->

            <div style="margin-top: 12px;">
                <button type="submit">Verstuur (<?= strtoupper(h($mode)) ?>)</button>
            </div>
        </form>
    </div>

    <?php
    // Wanneer beschouwen we "verstuurd"?
    $hasSubmitted = ($mode === 'get') ? !empty($_GET['feature']) : is_postback();

    // Result cue class (alleen na submit)
    $resultCueClass = $hasSubmitted ? 'result-cue' : '';
    ?>

    <div class="card <?= $resultCueClass ?>" id="postCard">
        <h2>2) Wat komt er binnen?</h2>

        <?php if ($hasSubmitted): ?>
            <p class="result-hint">
                <span class="result-dot" aria-hidden="true"></span>
                Lees hier het resultaat: dit is de <?= $mode === 'get' ? '$_GET' : '$_POST' ?> associatieve array na het versturen.
            </p>
        <?php endif; ?>

        <p>
            Actieve methode: <strong><?= strtoupper(h($mode)) ?></strong><br>
            PHP array: <strong><code><?= $mode === 'get' ? '$_GET' : '$_POST' ?></code></strong>
        </p>

        <?php if ($mode === 'get'): ?>
            <p class="muted">
                <strong>GET:</strong> de waarden zijn zichtbaar in de URL (querystring).
            </p>
            <p><code><?= h($_SERVER['REQUEST_URI'] ?? '') ?></code></p>
        <?php else: ?>
            <p class="muted">
                <strong>POST:</strong> de waarden staan niet in de URL. Ze komen in de request-body binnen.
            </p>
        <?php endif; ?>

        <?php if (!$hasSubmitted): ?>
            <p>Nog niks verstuurd. Gebruik het formulier links.</p>
            <ul>
                <li><code>name="feature"</code> → <code><?= $mode === 'get' ? '$_GET' : '$_POST' ?>['feature']</code></li>
                <li><code>name="answer"</code> → <code><?= $mode === 'get' ? '$_GET' : '$_POST' ?>['answer']</code></li>
            </ul>
        <?php else: ?>
            <h3>2.1 Direct uitlezen</h3>
            <ul>
                <li><code><?= $mode === 'get' ? '$_GET' : '$_POST' ?>['feature']</code> = <code><?= h((string)($data['feature'] ?? '')) ?></code></li>
                <li><code><?= $mode === 'get' ? '$_GET' : '$_POST' ?>['answer']</code>  = <code><?= h((string)($data['answer'] ?? '')) ?></code></li>
            </ul>

            <h3>2.2 Van HTML <code>name</code> naar PHP array key</h3>

            <table style="width:100%; border-collapse:collapse;">
                <thead>
                <tr style="text-align:left;">
                    <th style="border-bottom:1px solid #ddd; padding:6px;">HTML element</th>
                    <th style="border-bottom:1px solid #ddd; padding:6px;">name=""</th>
                    <th style="border-bottom:1px solid #ddd; padding:6px;">PHP uitlezen</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($formFields as $name => $label): ?>
                    <tr>
                        <td style="padding:6px;"><?= h($label) ?></td>
                        <td style="padding:6px;"><code><?= h($name) ?></code></td>
                        <td style="padding:6px;">
                            <code><?= $mode === 'get' ? '$_GET' : '$_POST' ?>['<?= h($name) ?>']</code>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <p class="muted">
                Elke <code>name=""</code> in het formulier wordt een <strong>sleutel</strong>
                in de PHP associatieve array.
            </p>

            <h3>2.3 Volledige associatieve array</h3>
            <?php $label = ($mode === 'get') ? '$_GET' : '$_POST'; ?>
            <pre><?= h(pretty_array($label, $data)) ?></pre>

            <h3>2.4 “Wie is het?” hint (nog géén spel)</h3>
            <p>
                Vraag: <strong><?= h($featureLabels[$feature] ?? (string)$feature) ?></strong><br>
                Antwoord: <strong><?= $answer === "yes" ? "Ja" : "Nee" ?></strong>
            </p>
        <?php endif; ?>

        <hr>
        <h3>3) Opdracht</h3>
        <ol>
            <li>Wissel tussen GET en POST en leg uit wat je ziet veranderen.</li>
            <li>Leg uit waarom GET data in de URL zichtbaar is en POST niet.</li>
            <li>Bonus: voeg een extra input toe (bijv. <code>name="player_name"</code>) en kijk hoe de array uitbreidt.</li>
        </ol>
    </div>
</div>

<script>
    // Glow stopt zodra student interactie heeft met het formulier.
    (function () {
        const playCard = document.getElementById('playCard');
        const form = document.getElementById('theForm');

        const stopGlow = () => playCard.classList.add('played');

        ['input', 'change', 'click', 'keydown'].forEach(evt => {
            form.addEventListener(evt, stopGlow, { once: true });
        });
    })();

    // Na submit: scroll naar resultaat en stop de pulserende dot na 3 sec (rustiger)
    (function () {
        const didSubmit = <?= $hasSubmitted ? 'true' : 'false' ?>;
        const postCard = document.getElementById('postCard');

        if (didSubmit && postCard) {
            postCard.scrollIntoView({ behavior: 'smooth', block: 'start' });

            const dot = postCard.querySelector('.result-dot');
            if (dot) {
                setTimeout(() => dot.style.animation = 'none', 3000);
            }
        }
    })();
</script>

</body>
</html>
