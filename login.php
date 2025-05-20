<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $users = json_decode(file_get_contents(__DIR__ . '/data/users.json'), true);
    $username = $_POST['username'];
    $password = $_POST['password'];

    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $username;
            header('Location: /admin/haeuser.php');
            exit;
        }
    }
    $error = "Login fehlgeschlagen";
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Login | novarix-studio Dashboard</title>
  <link rel="stylesheet" href="/style.css">
</head>
<body>
  <h2>🔐 Login</h2>
  <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
  <form method="post">
    <label>Benutzername:<br><input type="text" name="username" required></label><br><br>
    <label>Passwort:<br><input type="password" name="password" required></label><br><br>
    <button type="submit">Anmelden</button>
  </form>
</body>
</html>
