<?php
$host     = "localhost";
$username = "root";
$password = "";
$dbname   = "db_penjualan2";

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// echo "Koneksi berhasil";
?>
