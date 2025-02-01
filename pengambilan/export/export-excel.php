<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Ambil id_users dari session
$id_users = $_SESSION['id_users'];

// Koneksi ke database
include_once "../../config.php";

// Ambil data transaksi dengan join ke tabel produk agar bisa menampilkan nama produk
$query = "SELECT transaksi.id_transaksi, produk.nama_produk, transaksi.jumlah, transaksi.tanggal_transaksi FROM transaksi JOIN produk ON transaksi.id_produk = produk.id_produk WHERE transaksi.id_users = '$id_users'";


$result = mysqli_query($mysqli, $query);

header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Pengambilan.xls");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengambilan</title>
</head>
<body>
    <div class="main-content">
        <div class="bg-image"></div>
        <div class="bg-text">
        <center>
        <h1>Data Kategori</h1>
            <br/><br>
            
                <table class="index">
                    <tr>
                        <th>NO</th>
                        <th>NAMA PRODUK</th>
                        <th>JUMLAH</th>
                        <th>TANGGAL TRANSAKSI</th>
                    </tr>
                    
                    <?php 
                    $no = 1; 
                    while ($transaksi = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$transaksi['nama_produk']."</td>";
                        echo "<td>".$transaksi['jumlah']."</td>";
                        echo "<td>".$transaksi['tanggal_transaksi']."</td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </table>
            </center>
        </div>
    </div>
</body>
</html>
