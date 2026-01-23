<?php
session_start();
include 'koneksi.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Menggunakan real_escape_string untuk mencegah SQL Injection
    $email    = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $query  = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($query); // Menggunakan gaya Object-Oriented sesuai koneksi.php kamu

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifikasi password (asumsi di database belum di-hash)
        if ($password == $row['password']) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['name']  = $row['name'];
            $_SESSION['role']  = $row['role'];

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login System</title>
    <style>
        body { font-family: Arial, sans-serif; background: #875f82; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-box { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 300px; }
        input { width: 100%; padding: 8px; margin: 10px 0; box-sizing: border-box; }
        button { width: 48%; padding: 10px; cursor: pointer; }
        .btn-login { background: #e3739a; color: white; border: none; }
    </style>
</head>
<body>

<div class="login-box">
    <h2 style="text-align:center">LOGIN</h2>

    <?php if ($error != "") : ?>
        <p style="color:red; font-size: 14px;"><?= $error; ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Email</label>
        <input type="email" name="email" placeholder="Masukkan Email" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan Password" required>

        <div style="display: flex; justify-content: space-between;">
            <button type="submit" class="btn-login">Login</button>
            <button type="reset">Batal</button>
        </div>
    </form>
</div>

</body>
</html>
