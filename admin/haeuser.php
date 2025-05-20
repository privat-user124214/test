<?php
require_once '../auth.php';
check_login();

$filename = '../data/haeuser.json';
$haeuser = json_decode(file_get_contents($filename), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    foreach ($haeuser as &$haus) {
        if ($haus['id'] == $id) {
            $haus['verkauft'] = $_POST['action'] === 'verkaufen';
            break;
        }
    }
    file_put_contents($filename, json_encode($haeuser, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    header("Location: haeuser.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Hausverwaltung </title>
  <link rel="stylesheet" href="/style.css">
  <style>
    body { color: #fff; padding: 2rem; background-color: #121212; }
    table { width: 100%; background: #1e1e2f; border-radius: 1rem; padding: 1rem; }
    th, td { padding: 0.5rem; text-align: left; }
    form { display: inline; }
    button { padding: 0.3rem 1rem; border-radius: 0.5rem; }
    .verkauft { color: #ff4c4c; }
    .verfuegbar { color: #4cff4c; }
  </style>
</head>
<body>
  <h2>🏠 Hausverwaltung</h2>
  <p>Angemeldet als: <?= htmlspecialchars($_SESSION['user']) ?> | <a href="/admin/logout.php">Logout</a></p>
  <table>
    <tr>
      <th>Ort</th>
      <th>Hausnummer</th>
      <th>Preis</th>
      <th>Status</th>
      <th>Aktion</th>
    </tr>
    <?php foreach ($haeuser as $haus): ?>
      <tr>
        <td><?= htmlspecialchars($haus['ort']) ?></td>
        <td><?= $haus['hausnummer'] ?></td>
        <td><?= number_format($haus['preis'], 0, ',', '.') ?> €</td>
        <td class="<?= $haus['verkauft'] ? 'verkauft' : 'verfuegbar' ?>">
          <?= $haus['verkauft'] ? 'Verkauft' : 'Verfügbar' ?>
        </td>
        <td>
          <form method="post">
            <input type="hidden" name="id" value="<?= $haus['id'] ?>">
            <input type="hidden" name="action" value="<?= $haus['verkauft'] ? 'freigeben' : 'verkaufen' ?>">
            <button type="submit">
              <?= $haus['verkauft'] ? '❌ Freigeben' : '✅ Verkaufen' ?>
            </button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
