<?php
session_start();
include "koneksi.php"; // pastikan file koneksi ada

$error = "";

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if ($row = mysqli_fetch_assoc($result)) {
        if ($password == $row['password']) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['name']  = $row['name'];
            $_SESSION['role']  = $row['role'];

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Email tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-card">
    <h2>POLGAN MART</h2>

    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="post">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Masukkan email anda" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>

        <button type="submit" class="btn">Login</button>
        <button type="reset" class="btn-reset">Batal</button>
    </form>

    <div class="footer">
        <p>© 2026 POLGAN MART</p>
    </div>
</div>

</body>
</html>
<?php
include '../koneksi.php';
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
 
    .btn-tambah {
        background: #27ae60;
    }
 
    .btn-edit {
        background: #2980b9;
    }
 
    .btn-hapus {
        background: #c0392b;
    }
 
    table {
        width: 100%;
        border-collapse: collapse;
    }
 
    th,
    td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: center;
    }

    th {
        background: #f8f8f8;
    }
</style>
 
<div class="card">
    <div class="card-header">
        <h3>List Produk</h3>
       <a href="dashboard.php?page=produk">List Produk</a>

    </div>
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
                    <a href="dashboard.php?page=edit&id=<?= $row['id_barang']; ?>" class="btn 
btn-edit">Edit</a>
                    <a href="dashboard.php?page=hapus&id=<?= $row['id_barang']; ?>"
                        class="btn btn-hapus"
                        onclick="return confirm('Yakin hapus data?')">
                        Hapus
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>

