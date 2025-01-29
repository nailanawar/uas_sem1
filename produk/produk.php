<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - Bemira.Co</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
                        <th>ID</th>
                        <th>NAMA</th>
                        <th>KATEGORI</th>
                        <th>GAMBAR</th>
                        <th>KETERANGAN</th>
                        <th>HARGA</th>
                        <th>JUMLAH</th>
                        <th>AKSI</th>
                    </tr>
                    
                    <?php 
                    

// Koneksi ke database
include_once "../config.php";
                    $query = "SELECT produk.*, kategori.nama_kategori FROM produk INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori";

                    $result = mysqli_query($mysqli, $query);
                    
                    while($produk = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>".$produk['id_produk']."</td>";
                        echo "<td>".$produk['nama_produk']."</td>";
                        echo "<td>".$produk['nama_kategori']."</td>";
                        echo "<td><img src='../img/{$produk['gambar_produk']}' alt='Gambar Produk' width='100' height='100'></td>";
                        echo "<td>".$produk['keterangan_produk']."</td>";
                        echo "<td>".$produk['harga_produk']."</td>";
                        echo "<td>".$produk['stok_produk']."</td>";
                        echo "<td style='padding: 0 0 0 5px;'>
                                  <a href='editProduk.php?id_produk=$produk[id_produk]' class='buttonEditDelete'>
                                      <i class='fas fa-pencil-alt'></i>
                                  </a> | 
                                  <a href='deleteProduk.php?id_produk=$produk[id_produk]' class='buttonEditDelete'>
                                  <i class='fas fa-trash-alt'></i>
                                  </a>
                              </td>";
                        echo "</tr>";
                    }
                    // Pastikan sidebar.php ditemukan
include_once "../sidebar.php";
                    ?>
                </table>
            </center>
        </div>
    </div>
</body>
</html>
