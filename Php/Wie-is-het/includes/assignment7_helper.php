<?php
/**********************************************************
 * TEACHER HELPERS — DO NOT EDIT
 * These functions are only for display + security.
 **********************************************************/

function h(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function pretty_array(string $label, array $data): string
{
    $lines = [];
    $lines[] = $label . ' = [';

    foreach ($data as $k => $v) {
        $k = (string) $k;
        $v = (string) $v;
        $v = str_replace('"', '\"', $v);

        $lines[] = '  "' . $k . '" => "' . $v . '",';
    }

    $lines[] = '];';
    return implode("\n", $lines);
}


function is_postback(): bool
{
    return ($_SERVER['REQUEST_METHOD'] ?? '') === 'POST';
}
