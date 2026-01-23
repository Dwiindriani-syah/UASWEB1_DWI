<?php
include __DIR__ . '/../koneksi.php';

/* SIMPAN TRANSAKSI */
if (isset($_POST['simpan'])) {
    $tanggal = $_POST['tanggal'];
    $kode    = $_POST['kode_pelanggan'];
    $total   = $_POST['total'];

    mysqli_query($conn, "INSERT INTO transaksi
        (tanggal, kode_pelanggan, total)
        VALUES ('$tanggal','$kode','$total')");
}

/* HAPUS */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM transaksi WHERE id_transaksi='$_GET[hapus]'");
}

/* DATA */
$transaksi = mysqli_query($conn, "SELECT * FROM transaksi");
$customer  = mysqli_query($conn, "SELECT * FROM customer");
?>

<style>
.box {
    background:#fff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 2px 8px rgba(0,0,0,.1);
    margin-bottom:20px;
}
input, select, button {
    width:100%;
    padding:8px;
    margin-top:5px;
}
button {
    background:#e666a3;
    color:#fff;
    border:none;
    border-radius:5px;
}
table {
    width:100%;
    border-collapse:collapse;
}
th, td {
    border:1px solid #ddd;
    padding:10px;
    text-align:center;
}
.btn {
    padding:5px 10px;
    border-radius:5px;
    color:white;
    text-decoration:none;
}
.btn-hapus { background:#e74c3c; }
</style>

<h2>Data Transaksi</h2>

<div class="box">
<form method="POST">
    <label>Tanggal</label>
    <input type="date" name="tanggal" required>

    <label>Kode Pelanggan</label>
    <select name="kode_pelanggan" required>
        <option value="">-- Pilih Pelanggan --</option>
        <?php while($c=mysqli_fetch_assoc($customer)) { ?>
            <option value="<?= $c['kode_pelanggan'] ?>">
                <?= $c['kode_pelanggan'] ?> - <?= $c['nama_pelanggan'] ?>
            </option>
        <?php } ?>
    </select>

    <label>Total</label>
    <input type="number" name="total" required>

    <button name="simpan">Simpan</button>
</form>
</div>

<div class="box">
<table>
<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Kode Pelanggan</th>
    <th>Total</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($t=mysqli_fetch_assoc($transaksi)) { ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $t['tanggal'] ?></td>
    <td><?= $t['kode_pelanggan'] ?></td>
    <td><?= $t['total'] ?></td>
    <td>
        <a class="btn btn-hapus"
           href="dashboard.php?page=transaksi&hapus=<?= $t['id_transaksi'] ?>"
           onclick="return confirm('Hapus data?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>
</div>
