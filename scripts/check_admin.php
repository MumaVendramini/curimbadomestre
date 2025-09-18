<?php
// scripts/check_admin.php
// Verifica o usuário admin na DB SQLite e testa a senha @1234abcd

$dbPath = __DIR__ . '/../database/database.sqlite';
if (!file_exists($dbPath)) {
    echo "database file not found: $dbPath\n";
    exit(1);
}

try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $stmt = $pdo->prepare('SELECT id, email, password, is_active FROM users WHERE email = ?');
    $stmt->execute(['admin@curimbadomestre.com']);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        echo "Admin user not found in DB.\n";
        exit(1);
    }

    echo "id: " . $row['id'] . "\n";
    echo "email: " . $row['email'] . "\n";
    echo "is_active: " . $row['is_active'] . "\n";
    echo "password_hash: " . $row['password'] . "\n";

    $ok = password_verify('@1234abcd', $row['password']) ? 'yes' : 'no';
    echo "password '@1234abcd' matches? " . $ok . "\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(2);
}
