 <?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$id_users = $_SESSION['id_users']; // Ambil id_users dari session

// Koneksi ke database
include_once "../config.php";

// Proses ketika form disubmit
if (isset($_POST['submit'])) {
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];
    $tanggal_transaksi = date('Y-m-d'); // Atau bisa gunakan format lain sesuai kebutuhan

    // Query untuk mengambil stok produk sebelum transaksi
    $result = mysqli_query($mysqli, "SELECT stok_produk FROM produk WHERE id_produk = '$id_produk' AND id_users = '$id_users'");
    $produk = mysqli_fetch_assoc($result);

    if ($produk['stok_produk'] >= $jumlah) {
        // Mengurangi stok produk di tabel produk
        $new_stok = $produk['stok_produk'] - $jumlah;
        $updateStokQuery = "UPDATE produk SET stok_produk = '$new_stok' WHERE id_produk = '$id_produk' AND id_users = '$id_users'";

        // Query untuk menambahkan transaksi
        $query = "INSERT INTO transaksi (id_users, id_produk, jumlah, tanggal_transaksi) 
                  VALUES ('$id_users', '$id_produk', '$jumlah', '$tanggal_transaksi')";

        if (mysqli_query($mysqli, $updateStokQuery) && mysqli_query($mysqli, $query)) {
            echo "<script>alert('Transaksi berhasil ditambahkan dan stok diperbarui!'); window.location.href='pengambilan.php';</script>";
        } else {
            echo "Error: " . mysqli_error($mysqli);
        }
    } else {
    echo "<script>alert('Stok tidak cukup untuk transaksi ini')</script>";
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Tambah Pengambilan</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <center>
        <div class="kotak">
            <a href="pengambilan.php"><b> Kembali</b></a>
            <br/><br/>
            
            <form action="tambahPengambilan.php" method="POST" name="form1">
                <table align="center" class="tableAddEdit">
                <tr>
                            <td>Produk</td>
                            <td>
                                <select name="id_produk" required class="isi">
                                    <option value="">Pilih Produk</option>
                                    <?php
                                    // Ambil daftar produk dari database
                                    $result = mysqli_query($mysqli, "SELECT * FROM produk WHERE id_users = '$id_users'");
                                    while ($produk = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$produk['id_produk']}'>{$produk['nama_produk']}</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td><input type="number" name="jumlah" required class="isi"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" name="submit" value="Tambah Transaksi" class="buttonAdd"></td>
                        </tr>
                </table>
            </form>
        </div>
        </center>
    </body>
</html>







