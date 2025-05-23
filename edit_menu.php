<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data menu berdasarkan ID
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

// Proses update data menu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $ingredients = $_POST['ingredients'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];

    // Proses upload foto baru jika ada
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $target_dir = "assets/images/";
        $target_file = $target_dir . basename($foto);
        move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);
    } else {
        $foto = $menu['foto']; // Gunakan foto lama jika tidak ada yang diunggah
    }

    // Update data menu
    $query = "UPDATE menu SET nama = ?, ingredients = ?, deskripsi = ?, stok = ?, harga = ?, kategori = ?, foto = ? WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("sssdsisi", $nama, $ingredients, $deskripsi, $stok, $harga, $kategori, $foto, $id);

    if ($stmt->execute()) {
        header('Location: admin.php?kategori=' . $kategori);
        exit;
    } else {
        echo "Gagal mengupdate menu.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form input, form textarea, form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        form button {
            padding: 10px 20px;
            background-color: #5B3A4B;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #8B5060;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Menu</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="nama">Nama Menu:</label>
            <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($menu['nama']) ?>" required>

            <label for="ingredients">Ingredients:</label>
            <textarea id="ingredients" name="ingredients" required><?= htmlspecialchars($menu['ingredients']) ?></textarea>

            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" required><?= htmlspecialchars($menu['deskripsi']) ?></textarea>

            <label for="stok">Stok:</label>
            <input type="number" id="stok" name="stok" value="<?= $menu['stok'] ?>" required>

            <label for="harga">Harga:</label>
            <input type="number" id="harga" name="harga" value="<?= $menu['harga'] ?>" required>

            <label for="kategori">Kategori:</label>
            <select id="kategori" name="kategori" required>
                <option value="kopi" <?= $menu['kategori'] === 'kopi' ? 'selected' : '' ?>>Kopi</option>
                <option value="dessert" <?= $menu['kategori'] === 'dessert' ? 'selected' : '' ?>>Dessert</option>
                <option value="teh" <?= $menu['kategori'] === 'teh' ? 'selected' : '' ?>>Teh</option>
            </select>

            <label for="foto">Foto Menu:</label>
            <input type="file" id="foto" name="foto">

            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>