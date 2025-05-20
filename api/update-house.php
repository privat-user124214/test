<?php
// Optionaler Schutz mit secret Token
if ($_GET['token'] !== 'dein_geheimer_token') {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$hausnummer = $_GET['hausnummer'];
$ort = $_GET['ort'];
$filename = '../data/haeuser.json';
$haeuser = json_decode(file_get_contents($filename), true);

foreach ($haeuser as &$haus) {
    if ($haus['hausnummer'] == $hausnummer && $haus['ort'] === $ort) {
        $haus['verkauft'] = true;
        file_put_contents($filename, json_encode($haeuser, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        echo json_encode(['success' => true]);
        exit;
    }
}

http_response_code(404);
echo json_encode(['error' => 'Haus nicht gefunden']);
