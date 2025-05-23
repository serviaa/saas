<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
$role = $_SESSION['role'] ?? 'user';

// Ambil data user dari database (jika ingin menampilkan info lain)
$stmt = $koneksi->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profile Saya</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #fffaf5;
            margin: 0;
            padding: 0;
        }
        .profile-container {
            max-width: 420px;
            margin: 60px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px #0001;
            padding: 36px 30px;
        }
        h2 {
            text-align: center;
            color: #b33e5c;
            margin-bottom: 30px;
        }
        .profile-info {
            margin-bottom: 24px;
        }
        .profile-info label {
            font-weight: 600;
            color: #5e2b33;
            display: block;
            margin-bottom: 4px;
        }
        .profile-info p {
            margin: 0 0 14px 0;
            color: #333;
            font-size: 16px;
        }
        .btn {
            display: inline-block;
            background: #5B3A4B;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 22px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.3s;
            cursor: pointer;
        }
        .btn:hover {
            background: #b33e5c;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 24px;
            color: #b33e5c;
            text-decoration: none;
            font-weight: 600;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>Profile Saya</h2>
        <div class="profile-info">
            <label>Username:</label>
            <p><?= htmlspecialchars($user['username']) ?></p>
            <label>Role:</label>
            <p><?= htmlspecialchars($user['role']) ?></p>
        </div>
        <a href="forgot_password.php" class="btn">Ubah Password</a>
        <a href="user.php" class="back-link">Kembali ke Beranda</a>    </div>
</body>
</html>