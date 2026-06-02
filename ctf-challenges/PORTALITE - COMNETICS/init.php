<?php
$db_path = '/tmp/comnetics_portal.db';
$db = new SQLite3($db_path);

$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    is_admin INTEGER DEFAULT 0
)");

$count = $db->querySingle("SELECT COUNT(*) FROM users");
if ($count == 0) {
    $admin_pw = bin2hex(random_bytes(24));
    $stmt = $db->prepare("INSERT INTO users (username, password, is_admin) VALUES (:u, :p, :a)");

    $stmt->bindValue(':u', 'admin', SQLITE3_TEXT);
    $stmt->bindValue(':p', $admin_pw, SQLITE3_TEXT);
    $stmt->bindValue(':a', 1, SQLITE3_INTEGER);
    $stmt->execute();

    $stmt->bindValue(':u', 'guest', SQLITE3_TEXT);
    $stmt->bindValue(':p', 'guest123', SQLITE3_TEXT);
    $stmt->bindValue(':a', 0, SQLITE3_INTEGER);
    $stmt->execute();
}
