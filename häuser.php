<?php
$haeuser = json_decode(file_get_contents(__DIR__ . '/data/haeuser.json'), true);
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>🏠 Häuserliste | Novarix Studio</title>
  <link rel="stylesheet" href="/style.css">
  <style>
    body {
      background-color: #121212;
      color: #fff;
      font-family: Arial, sans-serif;
      padding: 2rem;
    }
    h1 {
      color: #a080f9;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
      background-color: #1e1e2f;
      border-radius: 12px;
      overflow: hidden;
    }
    th, td {
      padding: 1rem;
      text-align: left;
    }
    th {
      background-color: #2c2c3f;
    }
    tr:nth-child(even) {
      background-color: #292940;
    }
    .verkauft {
      color: #ff4c4c;
      font-weight: bold;
    }
    .verfuegbar {
      color: #4cff4c;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h1>🏡 Häuserübersicht</h1>
  <p>Hier findest du alle verfügbaren und verkauften Häuser im System.</p>

  <table>
    <tr>
      <th>Ort</th>
      <th>Hausnummer</th>
      <th>Preis</th>
      <th>Status</th>
    </tr>
    <?php foreach ($haeuser as $haus): ?>
      <tr>
        <td><?= htmlspecialchars($haus['ort']) ?></td>
        <td><?= $haus['hausnummer'] ?></td>
        <td><?= number_format($haus['preis'], 0, ',', '.') ?> €</td>
        <td class="<?= $haus['verkauft'] ? 'verkauft' : 'verfuegbar' ?>">
          <?= $haus['verkauft'] ? 'Verkauft' : 'Verfügbar' ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
