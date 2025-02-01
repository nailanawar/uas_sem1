<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

include_once("../config.php");

$id_users = $_SESSION['id_users'];
$id_produk = $_GET['id_produk'] ?? '';

$result = mysqli_query($mysqli, "SELECT * FROM produk WHERE id_produk='$id_produk' AND id_users='$id_users'");
$produk = mysqli_fetch_assoc($result) or die("Produk tidak ditemukan.");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $id_kategori = $_POST['id_kategori'];
    $keterangan_produk = $_POST['keterangan_produk'];
    $harga_produk = $_POST['harga_produk'];
    $stok_produk = $_POST['stok_produk'];
    
    // Cek jika ada file gambar baru
    if (!empty($_FILES['gambar_produk']['name'])) {
        $gambar_produk = $_FILES['gambar_produk']['name'];
        move_uploaded_file($_FILES['gambar_produk']['tmp_name'], "../img/$gambar_produk");
        $update_gambar = ", gambar_produk='$gambar_produk'";
    } else {
        $update_gambar = "";
    }

    $query = "UPDATE produk SET nama_produk='$nama_produk', id_kategori='$id_kategori', 
              keterangan_produk='$keterangan_produk', harga_produk='$harga_produk', 
              stok_produk='$stok_produk' $update_gambar 
              WHERE id_produk='$id_produk' AND id_users='$id_users'";
    
    if (mysqli_query($mysqli, $query)) {
        echo "<script>alert('Produk berhasil diperbarui!'); window.location.href='produk.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui produk')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<center>
<div class="kotak" style="margin-top: 70px;">
        <a href="produk.php">Kembali</a>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Nama</td>
                    <td>
                        <input type="text" name="nama_produk" value="<?= $produk['nama_produk']; ?>" class="isi">
                    </td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td>
                        <select name="id_kategori" class="isi">
                            <?php
                            $kategori_query = mysqli_query($mysqli, "SELECT * FROM kategori WHERE id_users = '$id_users'");
                            while ($row = mysqli_fetch_assoc($kategori_query)) {
                                $selected = ($row['id_kategori'] == $produk['id_kategori']) ? 'selected' : '';
                                echo "<option value='{$row['id_kategori']}' $selected>{$row['nama_kategori']}</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Gambar</td>
                    <td>
                        <input type="file" name="gambar_produk" id="gambar_produk" hidden>
                        <br><img src="../img/<?= $produk['gambar_produk']; ?>" width="100">
                        <label for="gambar_produk">pilih gambar</label>
                    </td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>
                        <input type="text" name="keterangan_produk" value="<?= $produk['keterangan_produk']; ?>" class="isi">
                    </td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td>
                        <input type="number" name="harga_produk" value="<?= $produk['harga_produk']; ?>" class="isi">
                    </td>
                </tr>
                <tr><td>Stok</td><td><input type="number" name="stok_produk" value="<?= $produk['stok_produk']; ?>" class="isi"></td></tr>
                <tr><td></td><td><input type="submit" value="Edit" class="buttonAdd"></td></tr>
            </table>
        </form>
    </div>
    
</center>
</body>
</html>
