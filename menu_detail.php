<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM menu WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $menu = $result->fetch_assoc();

    if (!$menu) {
        echo "Menu tidak ditemukan.";
        exit;
    }
} else {
    echo "ID menu tidak diberikan.";
    exit;
}

$pesan_sukses = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pesan'])) {
    $nama_pemesan = $_SESSION['username'] ?? '';
    $jumlah = (int)$_POST['jumlah'];
    $catatan = $_POST['catatan'];

    $stmt = $koneksi->prepare("INSERT INTO pesanan (menu_id, nama_pemesan, jumlah, catatan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isis", $id, $nama_pemesan, $jumlah, $catatan);
    if ($stmt->execute()) {
        $pesan_sukses = "Pesanan berhasil dikirim!";
    } else {
        $pesan_sukses = "Pesanan gagal, silakan coba lagi.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Menu - <?= htmlspecialchars($menu['nama']) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff8fa;
            color: #5B3A4B;
            padding: 20px;
        }
        .menu-detail {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid #f7c8d0;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        .menu-detail img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .menu-detail h2 {
            font-size: 24px;
            color: #8B5060;
            margin-bottom: 10px;
        }
        .menu-detail p {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .menu-detail .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #5B3A4B;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            border: none;
            font-size: 16px;
            font-weight: 600;
            margin-right: 10px;
            margin-top: 10px;
            transition: background 0.3s, transform 0.2s;
            box-shadow: 0 2px 8px #0001;
            cursor: pointer;
        }
        .menu-detail .btn:hover {
            background-color: #b33e5c;
            color: #fff;
            transform: translateY(-2px) scale(1.03);
        }
        .order-form {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #f7c8d0;
        }
        .order-form label {
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }
        .order-form input, .order-form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: inherit;
        }
        .order-form-buttons {
            display: flex;
            gap: 10px;
        }
        .success-msg {
            color: #388e3c;
            margin-bottom: 15px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="menu-detail">
        <img src="<?= htmlspecialchars($menu['foto']) ?>" alt="<?= htmlspecialchars($menu['nama']) ?>">
        <h2><?= htmlspecialchars($menu['nama']) ?></h2>
        <p><strong>Harga:</strong> Rp <?= number_format($menu['harga'], 2, ',', '.') ?></p>
        <p><strong>Deskripsi:</strong> <?= htmlspecialchars($menu['deskripsi']) ?></p>
        <p><strong>Ingredients:</strong> <?= htmlspecialchars($menu['ingredients']) ?></p>
        <a href="menu.php" class="btn">Kembali</a>

        <form class="order-form" method="post" id="orderForm">
            <h3>Pesan Menu Ini</h3>
            <?php if ($pesan_sukses): ?>
                <div class="success-msg"><?= $pesan_sukses ?></div>
            <?php endif; ?>
            <label for="nama_pemesan">Nama Pemesan:</label>
            <input type="text" id="nama_pemesan" name="nama_pemesan" value="<?= htmlspecialchars($_SESSION['username'] ?? '') ?>" readonly required>            <label for="jumlah">Jumlah:</label>
            <input type="number" id="jumlah" name="jumlah" min="1" value="1" required>
            <label for="catatan">Catatan:</label>
            <textarea id="catatan" name="catatan" rows="2" placeholder="(Opsional)"></textarea>
            <div class="order-form-buttons">
                <button type="submit" name="pesan" class="btn">Pesan</button>
            </div>
        </form>
    </div>
</body>
</html>