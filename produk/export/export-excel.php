<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../../login.php");
    exit();
}

// Ambil id_users dari session
$id_users = $_SESSION['id_users'];

// Koneksi ke database
include_once "../../config.php";

// Modifikasi query untuk mengambil produk sesuai dengan id_users
$query = "SELECT produk.*, kategori.nama_kategori 
          FROM produk 
          INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
          WHERE produk.id_users = '$id_users'"; // Kondisi id_users ditambahkan

$result = mysqli_query($mysqli, $query);

header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Produk.xls");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="main-content">
        <div class="bg-image"></div>
        <div class="bg-text">
        <center>
        <h1>Data Produk</h1>
            <br/><br/>
            
                <table class="index">
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>KATEGORI</th>
                        <th>GAMBAR</th>
                        <th>KETERANGAN</th>
                        <th>HARGA</th>
                        <th>JUMLAH</th>
                    </tr>
                    
                    <?php 
                    $no = 1;
                    while($produk = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$produk['nama_produk']."</td>";
                        echo "<td>".$produk['nama_kategori']."</td>";
                        echo "<td><img src='../../img/{$produk['gambar_produk']}' alt='Gambar Produk' width='100' height='100'></td>";
                        echo "<td>".$produk['keterangan_produk']."</td>";
                        echo "<td>".$produk['harga_produk']."</td>";
                        echo "<td>".$produk['stok_produk']."</td>";
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
