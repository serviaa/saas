<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
include 'koneksi.php';

// Update status pesanan
if (isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $stmt = $koneksi->prepare("UPDATE pesanan SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
}

// Ambil data pesanan
$query = "SELECT pesanan.*, menu.nama AS nama_menu FROM pesanan JOIN menu ON pesanan.menu_id = menu.id ORDER BY pesanan.tanggal_pesan DESC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Pesanan - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f9f9f9; margin: 0; }
        .container { max-width: 1000px; margin: 40px auto; background: #fff; border-radius: 8px; box-shadow: 0 4px 8px #0001; padding: 30px; }
        h1 { text-align: center; color: #b33e5c; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #eee; text-align: left; }
        th { background: #f7c8d0; color: #5B3A4B; }
        form { margin: 0; }
        select, button { padding: 6px 10px; border-radius: 4px; border: 1px solid #ccc; }
        button { background: #b33e5c; color: #fff; border: none; cursor: pointer; }
        button:hover { background: #8B5060; }
        .status-dibuat { color: #e67e22; font-weight: bold; }
        .status-diantar { color: #2980b9; font-weight: bold; }
        .status-diterima { color: #27ae60; font-weight: bold; }
        nav { text-align: center; margin-bottom: 20px; }
        nav a { color: #b33e5c; text-decoration: none; margin: 0 10px; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Pesanan</h1>
        <nav>
            <a href="admin.php">Kelola Menu</a> | 
            <a href="admin_pesanan.php">Kelola Pesanan</a> | 
            <a href="logout.php">Logout</a>
        </nav>
        <table>
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Menu</th>
                    <th>Nama Pemesan</th>
                    <th>Jumlah</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['tanggal_pesan'] ?></td>
                    <td><?= htmlspecialchars($row['nama_menu']) ?></td>
                    <td><?= htmlspecialchars($row['nama_pemesan']) ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td><?= htmlspecialchars($row['catatan']) ?></td>
                    <td class="status-<?= strtolower($row['status']) ?>"><?= $row['status'] ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <select name="status">
                                <option value="Dibuat" <?= $row['status']=='Dibuat'?'selected':''; ?>>Dibuat</option>
                                <option value="Diantar" <?= $row['status']=='Diantar'?'selected':''; ?>>Diantar</option>
                                <option value="Diterima" <?= $row['status']=='Diterima'?'selected':''; ?>>Diterima</option>
                            </select>
                            <button type="submit" name="update_status">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>