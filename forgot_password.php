<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $new_password = mysqli_real_escape_string($koneksi, $_POST['new_password']);

    // Periksa apakah username terdaftar
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        // Update password baru
        $query_update = "UPDATE users SET password = '$new_password' WHERE username = '$username'";
        if (mysqli_query($koneksi, $query_update)) {
            echo "<script>alert('Password berhasil diperbarui. Silakan login.'); window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui password.');</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fffaf5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container, .login-container {
            background: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(183, 110, 121, 0.10);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #b76e79;
            font-weight: 800;

        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: 600;
            color: #5e2b33;
        }

        input[type="text"], input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            background: #fffaf5;

        }

        button, input[type="submit"] {
            padding: 12px;
            background-color: #b33e5c;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover, input[type="submit"]:hover {
            background-color: #b76e79;
        }

        p {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: #666;
        }

        p a {
            color: #b33e5c;
            text-decoration: none;
            font-weight: 600;
        }

        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Lupa Password</h2>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Password Baru:</label>
        <input type="password" name="new_password" required>
        <input type="submit" value="Reset Password">
    </form>
    <p><a href="login.php">Kembali ke Login</a></p>
</div>
</body>
</html>