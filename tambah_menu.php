<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

include 'koneksi.php';

// Ambil kategori dari parameter GET (default: 'kopi')
$kategori = $_GET['kategori'] ?? 'kopi';

// Query untuk mengambil data menu berdasarkan kategori
$query = "SELECT * FROM menu WHERE kategori = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("s", $kategori);
$stmt->execute();
$result = $stmt->get_result();

// Proses penambahan menu baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi']; 
    $ingredients = $_POST['ingredients'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];

    // Proses upload foto
    $foto = $_FILES['foto']['name'];
    $target_dir = "assets/images/";
    $target_file = $target_dir . basename($foto);
    move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);

    // Insert data menu baru
    $query = "INSERT INTO menu (nama, ingredients, stok, harga, kategori, foto) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("sssdss", $nama, $ingredients, $stok, $harga, $kategori, $foto);
    if ($stmt->execute()) {
        header('Location: admin.php?kategori=' . $kategori);
        exit;
    } else {
        echo "Gagal menambahkan menu.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #5B3A4B;
            color: white;
            padding: 20px;
            text-align: center;
        }

        nav {
            margin-top: 10px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 960px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .kategori-nav {
            text-align: center;
            margin-bottom: 20px;
        }

        .kategori-nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #5B3A4B;
            background-color: #f7c8d0;
            padding: 8px 16px;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .kategori-nav a:hover,
        .kategori-nav a.active {
            background-color: #e29aa6;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f7c8d0;
            color: #5B3A4B;
        }

        table img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }

        .btn {
            padding: 6px 12px;
            background-color: #5B3A4B;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #8B5060;
        }

        .btn-danger {
            background-color: #e74c3c;
        }

        .btn-danger:hover {
            background-color: #c0392b;
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
    <header>
        <h1>Kelola Menu</h1>
        <nav>
            <a href="admin.php" class="back-link">Kembali</a> 
        </nav>
    </header>

    <div class="container">

        <h2>Tambah Menu Baru</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="nama">Nama Menu:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="ingredients">Ingredients:</label>
            <textarea id="ingredients" name="ingredients" required></textarea>

            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" required></textarea>

            <label for="stok">Stok:</label>
            <input type="number" id="stok" name="stok" required>

            <label for="harga">Harga:</label>
            <input type="number" id="harga" name="harga" required>

            <label for="kategori">Kategori:</label>
            <select id="kategori" name="kategori" required>
                <option value="kopi" <?= $kategori === 'kopi' ? 'selected' : '' ?>>Kopi</option>
                <option value="dessert" <?= $kategori === 'dessert' ? 'selected' : '' ?>>Dessert</option>
                <option value="teh" <?= $kategori === 'teh' ? 'selected' : '' ?>>Teh</option>
            </select>

            <label for="foto">Foto Menu:</label>
            <input type="file" id="foto" name="foto" required>

            <button type="submit">Tambah Menu</button>
        </form>
    </div>
</body>
</html>