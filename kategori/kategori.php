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

// Update query untuk menampilkan kategori sesuai dengan id_users
$result = mysqli_query($mysqli, "SELECT * FROM kategori WHERE id_users = '$id_users' ORDER BY id_kategori ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori - Bemira.Co</title>
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
            <br/><br/>
            <center>
                <table class="index">
                    <tr>
                        <th>NO</th>
                        <th>NAMA KATEGORI</th>
                        <th>AKSI</th>
                    </tr>
                    
                    <?php 
                    $no = 1; // Mulai nomor urut dari 1
                    while($kategori = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>".$no."</td>"; // Menampilkan nomor urut
                        echo "<td>".$kategori['nama_kategori']."</td>";
                        echo "<td style='padding: 0 0 0 5px; font-size: 25px;'>
                                  <a href='editKategori.php?id_kategori=$kategori[id_kategori]' class='buttonEditDelete'>
                                  <i class='bx bx-edit' ></i>
                                  </a> | 
                                  <a href='deleteKategori.php?id_kategori=$kategori[id_kategori]' class='buttonEditDelete'>
                                  <i class='bx bx-trash-alt' ></i>
                                  </a>
                              </td>";
                        echo "</tr>";
                        $no++; // Increment nomor urut
                    }
                    ?>
                </table>
            </center>
        </div>
    </div>
</body>
</html>
