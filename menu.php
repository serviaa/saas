<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Menu - Kafe & Dessert</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fff8fa;
      color: #5B3A4B;
    }
    header {
      position: fixed;
      top: 0;
      width: 100%;
      background: #fffdf9;
      padding: 18px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
      z-index: 100;
    }
    header h1 {
      font-size: 26px;
      font-weight: 800;
      color: #b76e79;
    }
    nav ul {
      list-style: none;
      display: flex;
      gap: 25px;
    }
    nav ul li a {
      text-decoration: none;
      color: #5a5a5a;
      font-weight: 500;
      transition: all 0.3s ease;
      position: relative;
    }
    nav ul li a::after {
      content: "";
      position: absolute;
      width: 0%;
      height: 2px;
      bottom: -4px;
      left: 0;
      background-color: #b76e79;
      transition: 0.3s;
    }
    nav ul li a:hover {
      color: #b76e79;
    }
    nav ul li a:hover::after {
      width: 100%;
    }
    /* Dropdown Profile */
    nav ul {
      list-style: none;
      display: flex;
      gap: 25px;
      position: relative;
    }

    nav ul li.dropdown {
      position: relative;
    }

    nav ul li .dropbtn {
      cursor: pointer;
      display: inline-block;
    }

    nav ul li .dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      background-color: #fff;
      min-width: 140px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.10);
      border-radius: 8px;
      z-index: 999;
      margin-top: 8px;
      padding: 0;
    }

    nav ul li .dropdown-content a {
      color: #5a5a5a;
      padding: 12px 18px;
      text-decoration: none;
      display: block;
      border-radius: 8px;
      transition: background 0.2s;
    }

    nav ul li .dropdown-content a:hover {
      background-color: #f7c8d0;
      color: #b33e5c;
    }

    nav ul li.dropdown:hover .dropdown-content,
    nav ul li.dropdown:focus-within .dropdown-content {
      display: block;
    }
    .container {
      max-width: 960px;
      margin: 100px auto 40px;
      padding: 20px;
    }
    .menu-title {
      font-size: 24px;
      margin-bottom: 20px;
      color: #8B5060;
      text-align: center;
    }
    .kategori-nav {
      text-align: center;
      margin-bottom: 30px;
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
    .search-bar {
      display: flex;
      justify-content: center;
      margin-bottom: 30px;
      align-items: center;
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
      margin-right: 10px;
    }
    .search-bar button:hover {
      background: #8B5060;
    }
    .status-btn {
      background-color: #5B3A4B;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 10px 18px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      transition: background 0.3s;
      display: inline-block;
    }
    .status-btn:hover {
      background-color: #b33e5c;
      color: #fff;
    }
    .menu-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
    }
    .menu-card {
      background-color: #fff;
      border: 1px solid #f7c8d0;
      border-radius: 12px;
      padding: 16px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
      text-align: center;
      transition: transform 0.3s;
    }
    .menu-card:hover {
      transform: translateY(-5px);
    }
    .menu-card img {
      width: auto;
      height: 200px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    .menu-card h3 {
      font-size: 18px;
      color: #5B3A4B;
      margin-bottom: 8px;
    }
    .menu-card p {
      font-size: 16px;
      color: #8B5060;
      margin-bottom: 12px;
    }
    .detail-btn {
      background-color: #5B3A4B;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 10px 18px;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      margin-bottom: 8px;
      margin-top: 5px;
      transition: background 0.3s, transform 0.2s;
      box-shadow: 0 2px 8px #0001;
      text-decoration: none;
      display: inline-block;
      box-sizing: border-box;
      min-width: 150px;
      text-align: center;
    }
    .detail-btn:hover {
      background-color: #b33e5c;
      color: #fff;
      transform: translateY(-2px) scale(1.03);
    }
    footer {
      background-color: #fff0f3;
      padding: 20px;
      text-align: center;
      color: #5B3A4B;
      margin-top: 50px;
    }
  </style>
</head>
<body>
  <header>
    <h1>Kafe & Dessert</h1>
    <nav>
      <ul>
        <li><a href="index.php">Beranda</a></li>
        <li><a href="menu.php">Menu</a></li>
        <li><a href="tentang.php">Tentang</a></li>
        <li class="dropdown">
          <a href="#" class="dropbtn">Profile &#x25BC;</a>
          <div class="dropdown-content">
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
          </div>
        </li>
      </ul>
    </nav>
  </header>
  <div class="container">
    <div class="kategori-nav">
      <?php
      $kategori = $_GET['kategori'] ?? 'kopi';
      $kategori_aktif = ['kopi' => '', 'dessert' => '', 'teh' => ''];
      $kategori_aktif[$kategori] = 'active';
      ?>
      <a href="menu.php?kategori=kopi" class="<?= $kategori_aktif['kopi'] ?>">Menu Kopi</a>
      <a href="menu.php?kategori=dessert" class="<?= $kategori_aktif['dessert'] ?>">Menu Dessert</a>
      <a href="menu.php?kategori=teh" class="<?= $kategori_aktif['teh'] ?>">Menu Teh</a>
    </div>
    <div class="search-bar">
      <input type="text" id="searchInput" placeholder="Cari menu...">
      <button type="button" onclick="searchMenu()">Cari</button>
      <a href="pesanan_user.php" class="status-btn">Lihat Status Pesanan</a>
    </div>

    <h2 class="menu-title">Daftar Menu</h2>
    <div class="menu-grid">
      <?php
      include 'koneksi.php';
      $stmt = $koneksi->prepare("SELECT * FROM menu WHERE kategori = ?");
      $stmt->bind_param("s", $kategori);
      $stmt->execute();
      $result = $stmt->get_result();
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='menu-card'>";
        echo "<img src='{$row['foto']}' alt='".htmlspecialchars($row['nama'])."'>";
        echo "<h3>".htmlspecialchars($row['nama'])."</h3>";
        echo "<p>Rp " . number_format($row['harga'], 2, ',', '.') . "</p>";
        echo "<a href='menu_detail.php?id={$row['id']}' class='detail-btn'>Lihat Detail</a>";
        echo "</div>";
      }
      ?>
    </div>
  </div>
  <footer>
    <p>&copy; 2025 Kafe & Dessert. Semua Hak Dilindungi.</p>
  </footer>
  <script>
    function searchMenu() {
      const input = document.getElementById('searchInput').value.toLowerCase();
      const cards = document.querySelectorAll('.menu-card');
      cards.forEach(card => {
        const name = card.querySelector('h3').textContent.toLowerCase();
        if (name.includes(input)) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    }
    document.getElementById('searchInput').addEventListener('keyup', searchMenu);
  </script>
</body>
</html>