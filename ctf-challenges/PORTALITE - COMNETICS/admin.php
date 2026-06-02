<?php
session_start();

// Hanya admin yang bisa akses halaman ini
if (!isset($_SESSION['user']) || empty($_SESSION['is_admin'])) {
    header('Location: index.php');
    exit;
}

// Ambil flag dari environment variable (di-set lewat docker-compose / env)
$flag = getenv('CTF_FLAG') ?: 'COMNETICS{sql_1nj3ct10n_b4s1c_byp4ss_2026}';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel — COMNETICS Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container admin-panel">
        <div class="logo">⚡ COMNETICS</div>
        <h1>Admin Dashboard</h1>
        <p>Halo, <strong><?= htmlspecialchars($_SESSION['user']) ?></strong>! Kamu berhasil masuk ke panel admin.</p>

        <div class="info-box">
            <h3>📋 Info Event</h3>
            <ul>
                <li>Nama Event: COMNETICS 2026</li>
                <li>Total Peserta Terdaftar: 247</li>
                <li>Status: 🟢 Active</li>
            </ul>
        </div>

        <div class="flag-box">
            <h2>🚩 Selamat! Kamu Berhasil!</h2>
            <p>Flag-mu adalah:</p>
            <code><?= htmlspecialchars($flag) ?></code>
            <p class="flag-note">
                Submit flag ini ke platform CTF untuk mendapatkan poin.
                Pelajari writeup setelah event selesai untuk memahami teknik yang kamu gunakan!
            </p>
        </div>

        <p><a href="logout.php" class="logout-link">🚪 Logout</a></p>

        <p class="footer-note">© 2026 COMNETICS — Internal Use Only</p>
    </div>
</body>
</html>
