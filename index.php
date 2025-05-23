<?php
session_start();

// Jika pengguna sudah login, arahkan ke halaman sesuai role
if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: user.php");
    }
    exit();
}

// Jika belum login, arahkan ke halaman login
header("Location: login.php");
exit();
?>