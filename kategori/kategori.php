<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Pastikan sidebar.php ditemukan
include_once "../sidebar.php";

// Koneksi ke database
include_once "../config.php";

$result = mysqli_query($mysqli, "SELECT * FROM kategori ORDER BY id_kategori ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori - Bemira.Co</title>
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
                <a href="tambahKategori.php"> Tambah </a> 
            </button>
            <button class="buttonExport">
                <select name="" id="">
                    <a href="./export/export.php"><option value="kategori">kategori</option></a>
                    <a href="export.php"><option value="produk">produk</option></a>
                    <a href="export.php"><option value="pengambilan">pengambilan</option></a>
                </select>
            </button>
            <br/><br/>
            <center>
                <table class="index">
                    <tr>
                        <th>ID</th>
                        <th>NAMA KATEGORI</th>
                        <th>AKSI</th>
                    </tr>
                    
                    <?php 
                    while($kategori = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>".$kategori['id_kategori']."</td>";
                        echo "<td>".$kategori['nama_kategori']."</td>";
                        echo "<td style='padding: 0 0 0 5px;'>
                                  <a href='edit.php?id_kategori=$kategori[id_kategori]' class='buttonEditDelete'>
                                      <i class='fas fa-pencil-alt'></i>
                                  </a> | 
                                  <a href='delete.php?id_kategori=$kategori[id_kategori]' class='buttonEditDelete'>
                                  <i class='fas fa-trash-alt'></i>
                                  </a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </center>
        </div>
    </div>
</body>
</html>
