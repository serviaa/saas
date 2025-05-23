<?php
session_start();
include 'koneksi.php';
$username = $_SESSION['username'] ?? '';
if (!$username) {
    header('Location: login.php');
    exit;
}
$query = "SELECT pesanan.*, menu.nama AS nama_menu, menu.harga, menu.foto FROM pesanan JOIN menu ON pesanan.menu_id = menu.id WHERE pesanan.nama_pemesan=? ORDER BY pesanan.tanggal_pesan DESC";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$total = 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Saya</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f9f9f9; margin: 0; }
        .container { max-width: 900px; margin: 40px auto; background: #fff; border-radius: 8px; box-shadow: 0 4px 8px #0001; padding: 30px; }
        h1 { text-align: center; color: #b33e5c; }
        .back-btn {
            display: inline-block;
            background: #5B3A4B;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            margin-bottom: 18px;
            transition: background 0.3s, transform 0.2s;
            box-shadow: 0 2px 8px #0001;
            cursor: pointer;
        }
        .back-btn:hover {
            background: #b33e5c;
            color: #fff;
            transform: translateY(-2px) scale(1.03);
        }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #eee; text-align: left; }
        th { background: #f7c8d0; color: #5B3A4B; }
        img { width: 50px; border-radius: 6px; }
        .status-dibuat { color: #e67e22; font-weight: bold; }
        .status-diantar { color: #2980b9; font-weight: bold; }
        .status-diterima { color: #27ae60; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pesanan Saya</h1>
        <a href="menu.php" class="back-btn">Kembali ke Menu</a>
        <table>
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Menu</th>
                    <th>Foto</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()): 
                $subtotal = $row['harga'] * $row['jumlah'];
                $total += $subtotal;
            ?>
                <tr>
                    <td><?= $row['tanggal_pesan'] ?></td>
                    <td><?= htmlspecialchars($row['nama_menu']) ?></td>
                    <td><img src="<?= $row['foto'] ?>" alt="<?= htmlspecialchars($row['nama_menu']) ?>"></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td>Rp <?= number_format($row['harga'], 2, ',', '.') ?></td>
                    <td>Rp <?= number_format($subtotal, 2, ',', '.') ?></td>
                    <td class="status-<?= strtolower($row['status']) ?>"><?= $row['status'] ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" style="text-align:right;">Total Semua</th>
                    <th colspan="2">Rp <?= number_format($total, 2, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>