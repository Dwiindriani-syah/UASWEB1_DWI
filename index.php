<?php
session_start();
include 'koneksi.php';

$error = "";

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $query  = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {

        // JIKA PASSWORD DI DATABASE TIDAK DI-HASH
        if ($password == $row['password']) {

        // JIKA PASSWORD DI-HASH, PAKAI INI:
        // if (password_verify($password, $row['password'])) {

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
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>LOGIN</h2>

<?php if ($error != "") : ?>
    <p style="color:red"><?= $error; ?></p>
<?php endif; ?>

<form method="post">
    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
    <button type="reset">Batal</button>
</form>

</body>
</html>
