<?php
session_start();

define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'admin123'); // Replace with a secure password in production

function check_auth() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: index.php');
        exit;
    }
}
?>
