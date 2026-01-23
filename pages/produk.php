<?php
include 'koneksi.php';

/* PROSES UPDATE DATA */
if (isset($_POST['update'])) {
    $id       = $_POST['id'];
    $kode     = $_POST['kode'];
    $nama     = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga    = $_POST['harga'];
    $stok     = $_POST['stok'];
    $satuan   = $_POST['satuan'];

    mysqli_query($conn, "UPDATE barang SET
        kode_barang='$kode',
        nama_barang='$nama',
        kategori='$kategori',
        harga='$harga',
        stok='$stok',
        satuan='$satuan'
        WHERE id_barang='$id'
    ");

    echo "<script>
            alert('Produk berhasil diupdate');
            window.location='dashboard.php?page=produk';
          </script>";
}

/* AMBIL DATA */
$data = mysqli_query($conn, "SELECT * FROM barang");
?>

<style>
.card {
    background: white;
    padding: 20px;
    border-radius: 6px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}
.btn {
    padding: 8px 12px;
    text-decoration: none;
    border-radius: 4px;
    color: white;
    font-size: 14px;
}
.btn-tambah { background: #cc72b8; }
.btn-edit { background: #2980b9; }
.btn-hapus { background: #c0392b; }

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

<?php
/* JIKA KLIK EDIT */
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $ambil = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id'");
    $edit = mysqli_fetch_assoc($ambil);
?>
<div class="form-box">
    <h3>Edit Produk</h3>
    <form method="post">
        <input type="hidden" name="id" value="<?= $edit['id_barang']; ?>">

        <label>Kode Produk</label><br>
        <input type="text" name="kode" value="<?= $edit['kode_barang']; ?>" required><br><br>

        <label>Nama Produk</label><br>
        <input type="text" name="nama" value="<?= $edit['nama_barang']; ?>" required><br><br>

        <label>Kategori</label><br>
        <input type="text" name="kategori" value="<?= $edit['kategori']; ?>" required><br><br>

        <label>Harga</label><br>
        <input type="number" name="harga" value="<?= $edit['harga']; ?>" required><br><br>

        <label>Stok</label><br>
        <input type="number" name="stok" value="<?= $edit['stok']; ?>" required><br><br>

        <label>Satuan</label><br>
        <input type="text" name="satuan" value="<?= $edit['satuan']; ?>" required><br><br>

        <button type="submit" name="update" class="btn btn-edit">Update</button>
        <a href="dashboard.php?page=produk" class="btn btn-hapus">Batal</a>
    </form>
</div>
<?php }
?>
    <!-- FORM TAMBAH PRODUK (MUNCUL JIKA KLIK TAMBAH) -->
    <?php if (isset($_GET['tambah'])) { ?>
    <div class="form-box">
        <h3>Tambah Produk</h3>
        <form method="post">
            <label>Kode Produk</label><br>
            <input type="text" name="kode" required><br><br>

            <label>Nama Produk</label><br>
            <input type="text" name="nama" required><br><br>

            <label>Kategori</label><br>
            <input type="text" name="kategori" required><br><br>

            <label>Harga</label><br>
            <input type="number" name="harga" required><br><br>

            <label>Stok</label><br>
            <input type="number" name="stok" required><br><br>

            <label>Satuan</label><br>
            <input type="text" name="satuan" required><br><br>

            <button type="submit" name="simpan" class="btn btn-tambah">Simpan</button>
            <a href="dashboard.php?page=produk" class="btn btn-hapus">Batal</a>
        </form>
    </div>
    <?php } ?>

    <!-- HEADER LIST -->
    <div class="card-header">
        <h3>List Produk</h3>
        <a href="dashboard.php?page=produk&tambah=1" class="btn btn-tambah">+ Tambah Produk</a>
    </div>

    <!-- TABEL DATA -->
    <table>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Satuan</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($data)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['kode_barang']; ?></td>
            <td><?= $row['nama_barang']; ?></td>
            <td><?= $row['kategori']; ?></td>
            <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
            <td><?= $row['stok']; ?></td>
            <td><?= $row['satuan']; ?></td>
            <td>
                <a href="dashboard.php?page=produk&edit=<?= $row['id_barang']; ?>" class="btn btn-edit">Edit</a>
                <a href="dashboard.php?page=hapus&id=<?= $row['id_barang']; ?>" class="btn btn-hapus" onclick="return confirm('Yakin hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
