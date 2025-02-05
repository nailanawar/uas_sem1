<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Ambil id_users dari session
$id_users = $_SESSION['id_users'];

// Pastikan sidebar.php ditemukan
include_once "../sidebar.php";

// Koneksi ke database
include_once "../config.php";

// Ambil data transaksi dengan join ke tabel produk agar bisa menampilkan nama produk
$query = "SELECT transaksi.id_transaksi, produk.nama_produk, transaksi.jumlah, transaksi.tanggal_transaksi FROM transaksi JOIN produk ON transaksi.id_produk = produk.id_produk WHERE transaksi.id_users = '$id_users'";


$result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengambilan - Bemira.Co</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../sidebar.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-content">
        <div class="bg-image"></div>
        <div class="bg-text">
        <button class="buttonTambah">
                <a href="tambahPengambilan.php"> Tambah </a> 
            </button>
            <br/><br>
            <center>
                <table class="index">
                    <tr>
                        <th>NO</th>
                        <th>NAMA PRODUK</th>
                        <th>JUMLAH</th>
                        <th>TANGGAL TRANSAKSI</th>
                        <th>AKSI</th>
                    </tr>
                    
                    <?php 
                    $no = 1; 
                    while ($transaksi = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$transaksi['nama_produk']."</td>";
                        echo "<td>".$transaksi['jumlah']."</td>";
                        echo "<td>".$transaksi['tanggal_transaksi']."</td>";
                        echo "<td style='padding: 0 0 0 5px; font-size: 25px;'>
                                  <a href='editPengambilan.php?id_transaksi=$transaksi[id_transaksi]' class='buttonEditDelete'>
                                  <i class='bx bx-edit' ></i>
                                  </a> | 
                                  <a href='deletePengambilan.php?id_transaksi=$transaksi[id_transaksi]' class='buttonEditDelete'>
                                  <i class='bx bx-trash-alt' ></i>
                                  </a>
                              </td>";
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
