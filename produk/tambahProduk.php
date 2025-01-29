<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Koneksi ke database
include_once "../config.php";

if (isset($_POST['submit'])) {
    $nama_produk = $_POST['nama_produk'];
    $id_kategori = $_POST['id_kategori'];

    $gambar_produk = $_FILES['gambar_produk']['name'];
    $tmp = $_FILES['gambar_produk']['tmp_name'];

    $keterangan_produk = $_POST['keterangan_produk'];
    $harga_produk = $_POST['harga_produk'];
    $stok_produk = $_POST['stok_produk'];
    
    // Tentukan lokasi penyimpanan gambar
    $path = '../img/' . $gambar_produk;

    // Cek apakah gambar berhasil dipindahkan
    if (move_uploaded_file($tmp, $path)) {
        // Query untuk memasukkan data produk
        $query = "INSERT INTO produk(nama_produk, id_kategori, gambar_produk, keterangan_produk, harga_produk, stok_produk) 
                  VALUES('$nama_produk', '$id_kategori', '$gambar_produk', '$keterangan_produk', '$harga_produk', '$stok_produk')";

        // Cek query berhasil atau tidak
        if (mysqli_query($mysqli, $query)) {
            echo "Data berhasil ditambahkan!";
        } else {
            echo "Error: " . mysqli_error($mysqli);
        }
    } else {
        echo "Gagal memindahkan file ke: " . $path;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="../tabel.css">
</head>
<body>
    <center>
        <div class="kotak" style="margin-top: 70px;">
            <a href="produk.php"><b>Kembali</b></a>
            <br/><br/>

            <form action="tambahProduk.php" method="POST" enctype="multipart/form-data">
                <table align="center" class="tableAddEdit">
                    <tr>
                        <td>Nama</td>
                        <td><input type="text" name="nama_produk" class="isi" required></td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>
                            <select name="id_kategori" class="isi" required>
                                <?php
                                $kategori = mysqli_query($mysqli, "SELECT * FROM kategori");
                                while ($row = mysqli_fetch_assoc($kategori)) {
                                    echo "<option value='{$row['id_kategori']}'>{$row['nama_kategori']}</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Gambar</td>
                        <td><input type="file" name="gambar_produk" class="isi"></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td><input type="text" name="keterangan_produk" class="isi"></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td><input type="number" name="harga_produk" class="isi" required></td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td><input type="number" name="stok_produk" class="isi" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit" value="Tambah" class="buttonAdd"></td>
                    </tr>
                </table>
            </form>
        </div>
    </center>
</body>
</html>
