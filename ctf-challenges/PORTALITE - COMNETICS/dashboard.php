<?php
require_once 'init.php';

$flag = getenv('CTF_FLAG') ?: 'FLAG{comnetics_b4s1c_byp4ss2026}';

if (!isset($_COOKIE['portal_session'])) {
    header('Location: index.php');
    exit;
}

$cookie = base64_decode($_COOKIE['portal_session']);
// VULN: SQLi via cookie — sengaja untuk CTF
$query = "SELECT id, username, is_admin FROM users WHERE $cookie";
$result = @$db->query($query);
$row = $result ? $result->fetchArray(SQLITE3_ASSOC) : null;

if (!$row) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard — COMNETICS Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container admin-panel">
        <div class="logo">⚡ COMNETICS</div>
        <h1>Dashboard</h1>
        <p>Halo, <strong><?= htmlspecialchars($row['username']) ?></strong>!</p>

        <div class="info-box">
            <h3>📋 Menu</h3>
            <ul>
                <li>Nama Event: COMNETICS 2026</li>
                <li>Status: 🟢 Active</li>
            </ul>
        </div>

        <?php if ($row['is_admin'] == 1): ?>
        <div class="flag-box">
            <h2>🚩 Selamat! Kamu Berhasil!</h2>
            <p>Flag-mu adalah:</p>
            <code><?= htmlspecialchars($flag) ?></code>
        </div>
        <?php else: ?>
        <div class="info-box">
            <h3>⚠️ Akses Terbatas</h3>
            <p>Kamu login sebagai guest. Hanya admin yang bisa melihat konten.</p>
        </div>
        <?php endif; ?>

        <p><a href="logout.php" class="logout-link">🚪 Logout</a></p>
        <p class="footer-note">© 2026 COMNETICS — Internal Use Only</p>
    </div>
</body>
</html>
