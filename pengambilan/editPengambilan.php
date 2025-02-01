<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Ambil id_users dari session
$id_users = $_SESSION['id_users'];

// Koneksi ke database
include_once "../config.php";

// Ambil id_transaksi yang akan diedit
if (isset($_GET['id_transaksi'])) {
    $id_transaksi = $_GET['id_transaksi'];

    // Query untuk mengambil data transaksi berdasarkan id_transaksi
    $result = mysqli_query($mysqli, "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi' AND id_users = '$id_users'");
    $transaksi = mysqli_fetch_assoc($result);

    // Jika data transaksi tidak ditemukan, redirect ke halaman transaksi
    if (!$transaksi) {
        header("Location: pengambilan.php");
        exit();
    }
} else {
    // Jika id_transaksi tidak ada di URL, redirect ke halaman transaksi
    header("Location: pengambilan.php");
    exit();
}

// Proses ketika form disubmit
if (isset($_POST['submit'])) {
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];
    $tanggal_transaksi = date('Y-m-d');

    // Ambil data produk berdasarkan id_produk yang dipilih
    $result_produk = mysqli_query($mysqli, "SELECT * FROM produk WHERE id_produk = '$id_produk' AND id_users = '$id_users'");
    $produk = mysqli_fetch_assoc($result_produk);

    if (!$produk) {
        echo "<script>alert('Produk tidak ditemukan'); window.location.href='pengambilan.php';</script>";
        exit();
    }

    if ($produk['stok_produk'] >= $jumlah) {
        // Mengurangi stok produk di tabel produk
        $new_stok = $produk['stok_produk'] - $jumlah;
        $updateStokQuery = "UPDATE produk SET stok_produk = '$new_stok' WHERE id_produk = '$id_produk' AND id_users = '$id_users'";
        
        // Update transaksi
        $query = "UPDATE transaksi SET id_produk = '$id_produk', jumlah = '$jumlah', tanggal_transaksi = '$tanggal_transaksi' 
                  WHERE id_transaksi = '$id_transaksi' AND id_users = '$id_users'";
        
        if (mysqli_query($mysqli, $updateStokQuery) && mysqli_query($mysqli, $query)) {
            echo "<script>alert('Transaksi berhasil diperbarui dan stok dikurangi!'); window.location.href='pengambilan.php';</script>";
        } else {
            echo "Error: " . mysqli_error($mysqli);
        }
    } else {
        echo "<script>alert('Stok tidak cukup untuk transaksi ini');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengambilan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<center>
    <div class="kotak">
        <a href="pengambilan.php"><b> Kembali </b></a>
        <br/><br/>
        
        <form method="POST" action="editPengambilan.php?id_transaksi=<?php echo $id_transaksi; ?>">
            <table width="90%" border="0" align="center" class="tableAddEdit">
                <tr>
                    <td>Produk</td>
                    <td>
                        <select name="id_produk" class="isi">
                            <option value="">Pilih Produk</option>
                            <?php
                            // Ambil daftar produk dari database
                            $result = mysqli_query($mysqli, "SELECT * FROM produk WHERE id_users = '$id_users'");
                            while ($produk = mysqli_fetch_assoc($result)) {
                                $selected = ($produk['id_produk'] == $transaksi['id_produk']) ? 'selected' : '';
                                echo "<option value='{$produk['id_produk']}' $selected>{$produk['nama_produk']}</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td>
                        <input type="number" name="jumlah" value="<?php echo $transaksi['jumlah']; ?>" class="isi">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Update Transaksi" class="buttonAdd">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</center>
</body>
</html>
