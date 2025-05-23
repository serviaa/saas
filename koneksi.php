<?php
$host = 'localhost'; // Server database
$username = 'root';  // Username database
$password = '12345';      // Password database
$database = 'kafe'; // Nama database

// Membuat koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
