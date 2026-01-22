<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard POLGANMART</title>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f4f4f4;
}

/* Sidebar */
.sidebar {
    width: 220px;
    height: 100vh;
    background: #2c3e50;
    color: #fff;
    position: fixed;
    top: 0;
    left: 0;
}

.sidebar h2 {
    text-align: center;
    padding: 20px 0;
    margin: 0;
    border-bottom: 1px solid rgba(255,255,255,0.2);
}

.sidebar a {
    display: block;
    padding: 12px 20px;
    color: #fff;
    text-decoration: none;
}

.sidebar a:hover {
    background: #34495e;
}

/* Header */
.header {
    height: 60px;
    background: #fff;
    margin-left: 220px;
    padding: 10px 20px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    border-bottom: 1px solid #ddd;
}

/* Profile */
.profile-btn {
    cursor: pointer;
    padding: 8px 15px;
    border-radius: 20px;
    background: #3498db;
    color: #fff;
}

/* Dropdown */
.dropdown {
    position: relative;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background: #fff;
    min-width: 150px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    border-radius: 5px;
}

.dropdown-content a {
    display: block;
    padding: 10px;
    text-decoration: none;
    color: #333;
}

.dropdown-content a:hover {
    background: #f0f0f0;
}

/* Content */
.content {
    margin-left: 220px;
    padding: 20px;
}
</style>
</head>

<body>

<div class="sidebar">
    <h2>Dashboard</h2>
    <a href="dashboard.php">Home</a>
    <a href="dashboard.php?page=produk">List Produk</a>
    <a href="dashboard.php?page=customer">Customer</a>
    <a href="dashboard.php?page=transaksi">Transaksi</a>
    <a href="dashboard.php?page=laporan">Laporan</a>
</div>

<div class="header">
    <div class="dropdown">
        <div class="profile-btn" onclick="toggleMenu()">Profile ▾</div>
        <div class="dropdown-content" id="profileMenu">
            <a href="dashboard.php?page=profile">My Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</div>

<div class="content">
<?php
$page = $_GET['page'] ?? 'home';
$file = "pages/$page.php";

if (file_exists($file)) {
    include $file;
} else {
    echo "<h2>Welcome Dashboard</h2>";
}
?>
</div>

<script>
function toggleMenu() {
    const menu = document.getElementById("profileMenu");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
}

window.onclick = function(event) {
    if (!event.target.matches('.profile-btn')) {
        const menu = document.getElementById("profileMenu");
        if (menu) menu.style.display = "none";
    }
}
</script>

</body>
</html>
