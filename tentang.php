<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tentang Kami - Kafe & Dessert</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fff8f9;
      color: #333;
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
    .container {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: center;
      padding: 100px 20px 60px;
      max-width: 1200px;
      margin: auto;
    }
    .text-section {
      flex: 1 1 500px;
      padding: 20px;
    }
    .text-section h1 {
      font-size: 36px;
      font-weight: 700;
      margin-bottom: 20px;
      color: #b33e5c;
    }
    .text-section p {
      font-size: 16px;
      line-height: 1.8;
      color: #5e2b33;
      margin-bottom: 30px;
    }
    .btn-black {
      display: inline-block;
      background-color: #5e2b33;
      color: white;
      padding: 12px 24px;
      text-decoration: none;
      border-radius: 6px;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }
    .btn-black:hover {
      background-color: #944556;
    }
    .image-section {
      flex: 1 1 500px;
      padding: 20px;
      text-align: center;
    }
    .image-section img {
      max-width: 400px;
      width: 100%;
      height: 280px;
      object-fit: cover;
      border-radius: 18px;
      box-shadow: 0 8px 32px 0 rgba(90, 58, 75, 0.18), 0 2px 8px 0 rgba(0,0,0,0.10);
      transition: transform 0.3s, box-shadow 0.3s;
      display: block;
      margin: 0 auto;
    }
    .image-section img:hover {
      transform: scale(1.03);
      box-shadow: 0 8px 24px #0003;
    }
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        text-align: center;
      }
      .text-section,
      .image-section {
        padding: 10px;
      }
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
<main class="container">
  <div class="text-section">
    <h1>Gebrakan Budaya Ngopi di Indonesia!</h1>
    <p>
      Ejji Coffee Corner menghadirkan konsep dan style kedai kopi ala Jepang. Kami ingin mengajak semua orang mulai dari penikmat kopi, mereka yang suka nongkrong dan ingin terlihat suka kopi, hingga yang bukan penggemar kopi untuk menikmati budaya baru ngopi yang asyik.
    </p>
  </div>
  <div class="image-section">
    <img src="cake3.jpg" alt="Ngopi Bersama">
  </div>
</main>
</body>
</html>