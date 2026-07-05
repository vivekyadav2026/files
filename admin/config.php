<?php
session_start();

$credsFile = __DIR__ . '/../data/admin_credentials.json';
if (!file_exists($credsFile)) {
    if (!file_exists(dirname($credsFile))) {
        mkdir(dirname($credsFile), 0777, true);
    }
    $defaultCreds = [
        'username' => 'admin',
        'password_hash' => password_hash('admin123', PASSWORD_DEFAULT)
    ];
    file_put_contents($credsFile, json_encode($defaultCreds, JSON_PRETTY_PRINT));
}

$creds = json_decode(file_get_contents($credsFile), true);
define('ADMIN_USER', $creds['username'] ?? 'admin');
define('ADMIN_PASS_HASH', $creds['password_hash'] ?? '');

function check_auth() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: index.php');
        exit;
    }
}
?>
