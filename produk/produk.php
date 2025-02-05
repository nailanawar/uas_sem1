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

// Modifikasi query untuk mengambil produk sesuai dengan id_users
$query = "SELECT produk.*, kategori.nama_kategori 
          FROM produk 
          INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
          WHERE produk.id_users = '$id_users'"; // Kondisi id_users ditambahkan

$result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - Bemira.Co</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
    <link rel="stylesheet" href="../sidebar.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="main-content">
        <div class="bg-image"></div>
        <div class="bg-text">
            <button class="buttonTambah">
                <a href="tambahProduk.php"> Tambah </a> 
            </button>
            <br/><br/>
            <center>
                <table class="index">
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>KATEGORI</th>
                        <th>GAMBAR</th>
                        <th>KETERANGAN</th>
                        <th>HARGA</th>
                        <th>JUMLAH</th>
                        <th>AKSI</th>
                    </tr>
                    
                    <?php 
                    $no = 1;
                    while($produk = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$produk['nama_produk']."</td>";
                        echo "<td>".$produk['nama_kategori']."</td>";
                        echo "<td><img src='../img/{$produk['gambar_produk']}' alt='Gambar Produk' width='100' height='100'></td>";
                        echo "<td>".$produk['keterangan_produk']."</td>";
                        echo "<td>".$produk['harga_produk']."</td>";
                        echo "<td>".$produk['stok_produk']."</td>";
                        echo "<td style='padding: 0 0 0 5px; font-size: 25px;'>
                                  <a href='editProduk.php?id_produk=$produk[id_produk]' class='buttonEditDelete'>
                                  <i class='bx bx-edit' ></i>
                                  </a> | 
                                  <a href='deleteProduk.php?id_produk=$produk[id_produk]' class='buttonEditDelete'>
                                  <i class='bx bx-trash-alt' ></i>
                                  </a>
                              </td>";
                        echo "</tr>";
                        $no++;
                    }
                    
                    include_once("../sidebar.php");
                    ?>
                </table>
            </center>
        </div>
    </div>
</body>
</html>
