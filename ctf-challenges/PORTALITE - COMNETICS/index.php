<?php
session_start();
require_once 'init.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $db->prepare("SELECT id, username, is_admin FROM users WHERE username = :u AND password = :p");
    $stmt->bindValue(':u', $username, SQLITE3_TEXT);
    $stmt->bindValue(':p', $password, SQLITE3_TEXT);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);

    if ($row) {
        $cookie_data = base64_encode("username='" . $row['username'] . "'");
        setcookie("portal_session", $cookie_data, time() + 3600, "/");
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Username atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>COMNETICS Internal Portal</title>
    <link rel="stylesheet" href="style.css">
    <!--
        TODO: login masi blm diberesin, ntar ya
        btw backup lama kayaknya masi ada di root deh, sapa yg mau bersihin?
    -->
</head>
<body>
    <div class="container">
        <div class="logo">⚡ COMNETICS</div>
        <h1>Internal Portal</h1>
        <p class="subtitle">Sistem Manajemen Event COMNETICS 2026</p>

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" autocomplete="off">
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>

            <button type="submit">Masuk</button>
        </form>

        <p class="footer-note">© 2026 COMNETICS — Internal Use Only</p>
    </div>
</body>
</html>
