<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kafe & Dessert</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fffaf5;
      color: #333;
      line-height: 1.6;
      overflow-x: hidden;
      animation: fadeIn 1s ease-in;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
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

    .hero {
      background: url('cake1.webp') no-repeat center center/cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      text-align: center;
    }

    .hero::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.4);
    }

    .hero-content {
      position: relative;
      z-index: 2;
      max-width: 800px;
      padding: 20px;
      color: white;
      animation: fadeIn 2s ease;
    }

    .hero-content h1 {
      font-size: 3.2rem;
      font-weight: 800;
      margin-bottom: 15px;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
    }

    .hero-content p {
      font-size: 1.3rem;
      margin-bottom: 30px;
    }

    .hero-content a {
      padding: 14px 36px;
      font-size: 1rem;
      font-weight: 600;
      background-color: #eab676;
      color: white;
      text-decoration: none;
      border-radius: 30px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      transition: background 0.3s ease, transform 0.2s ease;
    }

    .hero-content a:hover {
      background-color: #d99f62;
      transform: scale(1.05);
    }

    section.content {
      padding: 100px 40px 60px;
      max-width: 1000px;
      margin: 0 auto;
    }

    section.content h2 {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 20px;
      color: #b76e79;
    }

    section.content p {
      font-size: 1.05rem;
      color: #444;
      margin-bottom: 15px;
    }

    footer {
      background-color: #fff2e6;
      text-align: center;
      padding: 25px 10px;
      font-size: 14px;
      color: #555;
      margin-top: 50px;
    }

    @media (max-width: 768px) {
      header {
        flex-direction: column;
        align-items: flex-start;
        padding: 15px 20px;
      }

      nav ul {
        flex-direction: column;
        gap: 10px;
        margin-top: 10px;
      }

      .hero-content h1 {
        font-size: 2.3rem;
      }

      .hero-content p {
        font-size: 1rem;
      }

      .hero-content a {
        padding: 12px 28px;
      }
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <h1>Kafe & Dessert</h1>
    <nav>
      <ul>
        <li><a href="user.php">Beranda</a></li>
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

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1>Temukan Cita Rasa Terbaik</h1>
      <p>Kopi & dessert pilihan, hanya untukmu 🍰☕</p>
      <a href="menu.php">Lihat Menu</a>
    </div>
  </section>

  <!-- Scrollable Content -->
  <section class="content">
    <h2>Menu Favorit</h2>
    <p>Nikmati berbagai pilihan menu terbaik kami mulai dari kopi spesial, teh premium, hingga dessert manis yang menggoda.</p>
    <p>Setiap sajian kami dibuat dengan bahan-bahan pilihan dan penuh cinta. Kamu bisa mencoba es kopi gula aren, red velvet cake, atau tiramisu homemade yang jadi favorit pelanggan kami.</p>

    <h2>Kenapa Pilih Kami?</h2>
    <p>✔️ Bahan berkualitas tinggi</p>
    <p>✔️ Rasa konsisten dan lezat</p>
    <p>✔️ Pelayanan cepat dan ramah</p>
    <p>✔️ Tempat nyaman dan Instagramable</p>

    <h2>Galeri</h2>
    <p><em>📷 Foto-foto minuman dan makanan akan tampil di sini.</em></p>

    <h2>Testimoni Pelanggan</h2>
    <p>"Kopinya enak banget! Tempatnya cozy dan cocok buat kerja." – Dina</p>
    <p>"Dessert-nya selalu fresh. Favoritku tiramisu dan cheese cake mereka." – Ardi</p>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Kafe & Dessert. Semua hak dilindungi.</p>
  </footer>
</body>
</html>
