<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="tabel.css">
</head>
<body>
<div class="main-content">
<div class="bg-text">
            
            <center>
                <table class="index">
                    <tr>
                    <th>NAMA PRODUK</th>
                        <th>KATEGORI</th>
                        <th>GAMBAR</th>
                        <th>KETERANGAN</th>
                        <th>HARGA</th>
                        <th>STOK</th>
                    </tr>
                    
                    <?php
include_once "config.php";
$query = "SELECT produk.*, kategori.nama_kategori FROM produk INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori";

$result = mysqli_query($mysqli, $query);

while($dashboard = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>".$dashboard['nama_produk']."</td>";
    echo "<td>".$dashboard['nama_kategori']."</td>";
    echo "<td>".$dashboard['gambar_produk']."</td>";
    echo "<td>".$dashboard['keterangan_produk']."</td>";
    echo "<td>".$dashboard['harga_produk']."</td>";
    echo "<td>".$dashboard['stok_produk']."</td>";
    echo "</tr>";
}
include_once "sidebar.php";
?>
                </table>
            </center>
        </div>

</body>

</html>