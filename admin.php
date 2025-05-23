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

        .search-bar {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .search-bar input {
            width: 300px;
            padding: 10px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            margin-right: 8px;
        }

        .search-bar button {
            padding: 10px 18px;
            background: #b33e5c;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .search-bar button:hover {
            background: #8B5060;
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
    </style>
</head>
<body>
    <header>
        <h1>Kelola Menu</h1>
        <nav>
            <a href="tambah_menu.php">Tambah Menu</a> |
                <a href="pesanan.php">Kelola Pesanan</a> |

            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="container">
        <div class="kategori-nav">
            <a href="admin.php?kategori=kopi" class="<?= $kategori === 'kopi' ? 'active' : '' ?>">Menu Kopi</a>
            <a href="admin.php?kategori=dessert" class="<?= $kategori === 'dessert' ? 'active' : '' ?>">Menu Dessert</a>
            <a href="admin.php?kategori=teh" class="<?= $kategori === 'teh' ? 'active' : '' ?>">Menu Teh</a>
        </div>

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Cari menu...">
            <button type="button" onclick="searchMenu()">Cari</button>
        </div>

        <h2>Daftar Menu - <?= ucfirst($kategori) ?></h2>
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama Menu</th>
                    <th>Ingredients</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr class="menu-row">
                    <td><img src="assets/images/<?= $row['foto'] ?>" alt="<?= $row['nama'] ?>"></td>
                    <td class="menu-name"><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['ingredients']) ?></td>
                    <td><?= $row['stok'] > 0 ? $row['stok'] : 'Habis' ?></td>
                    <td>Rp <?= number_format($row['harga'], 2, ',', '.') ?></td>
                    <td>
                        <a href="edit_menu.php?id=<?= $row['id'] ?>" class="btn">Edit</a>
                        <a href="delete_menu.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus menu ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>

            </tbody>
        </table>
    </div>

        <script>
        function searchMenu() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('.menu-row');
            rows.forEach(row => {
                const name = row.querySelector('.menu-name').textContent.toLowerCase();
                if (name.includes(input)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
        document.getElementById('searchInput').addEventListener('keyup', searchMenu);
        </script>

</body>
</html>