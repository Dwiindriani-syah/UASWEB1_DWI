<?php
include __DIR__ . '/../koneksi.php';

/* ================= SIMPAN DATA ================= */
if (isset($_POST['simpan'])) {
    $kode   = $_POST['kode'];
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp     = $_POST['hp'];
    $email  = $_POST['email'];

    mysqli_query($conn, "INSERT INTO customer VALUES (
        NULL,
        '$kode',
        '$nama',
        '$alamat',
        '$hp',
        '$email'
    )");

    echo "<script>
        alert('Customer berhasil ditambahkan');
        window.location='dashboard.php?page=customer';
    </script>";
}

/* ================= HAPUS DATA ================= */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM customer WHERE id_pelanggan='$_GET[hapus]'");

    echo "<script>
        alert('Customer berhasil dihapus');
        window.location='dashboard.php?page=customer';
    </script>";
}

/* ================= AMBIL DATA ================= */
$data = mysqli_query($conn, "SELECT * FROM customer");
?>

<style>
.card {
    background: white;
    padding: 20px;
    border-radius: 6px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.btn {
    padding: 8px 12px;
    border-radius: 4px;
    color: white;
    text-decoration: none;
    font-size: 14px;
}

.btn-tambah { background: #cc72b8; }
.btn-edit   { background: #2980b9; }
.btn-hapus  { background: #c0392b; }

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

th {
    background: #f8f8f8;
}

.form-box {
    background: #fafafa;
    padding: 15px;
    border-radius: 6px;
    margin-bottom: 20px;
}
</style>


<div class="card">

<div class="card-header">
    <h3>Data Customer</h3>
    <a href="dashboard.php?page=customer&tambah=1" class="btn btn-tambah">+ Tambah Customer</a>
</div>

<?php if (isset($_GET['tambah'])) { ?>
<div class="form-box">
<form method="post">
    Kode Pelanggan<br>
    <input type="text" name="kode" required><br><br>

    Nama Pelanggan<br>
    <input type="text" name="nama" required><br><br>

    Alamat<br>
    <textarea name="alamat" required></textarea><br><br>

    No HP<br>
    <input type="text" name="hp" required><br><br>

    Email<br>
    <input type="email" name="email" required><br><br>

    <button type="submit" name="simpan" class="btn btn-tambah">Simpan</button>
    <a href="dashboard.php?page=customer" class="btn btn-hapus">Batal</a>
</form>
</div>
<?php } ?>

<table>
<tr>
    <th>No</th>
    <th>Kode</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>No HP</th>
    <th>Email</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;
while ($row = mysqli_fetch_assoc($data)) {
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $row['kode_pelanggan']; ?></td>
    <td><?= $row['nama_pelanggan']; ?></td>
    <td><?= $row['alamat']; ?></td>
    <td><?= $row['no_hp']; ?></td>
    <td><?= $row['email']; ?></td>
    <td>
        <a href="dashboard.php?page=customer&edit=<?= $row['id_pelanggan']; ?>" class="btn btn-edit">Edit</a>
        <a href="dashboard.php?page=customer&hapus=<?= $row['id_pelanggan']; ?>"
           class="btn btn-hapus"
           onclick="return confirm('Hapus data?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>

</div>
