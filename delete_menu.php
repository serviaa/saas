<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data menu berdasarkan ID
    $query = "DELETE FROM menu WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: admin.php');
        exit;
    } else {
        echo "Gagal menghapus menu.";
    }
} else {
    echo "ID menu tidak diberikan.";
    exit;
}
?>