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

// Update query untuk menampilkan kategori sesuai dengan id_users
$result = mysqli_query($mysqli, "SELECT * FROM kategori WHERE id_users = '$id_users' ORDER BY id_kategori ASC");

header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Kategori.xls");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori - Bemira.Co</title>
</head>

<body>
    <div class="main-content">
        <div class="bg-image"></div>
        <div class="bg-text">
        <h1>Data Kategori</h1>
            <br/><br/>
            <center>
                <table class="index">
                    <tr>
                        <th>NO</th>
                        <th>NAMA KATEGORI</th>
                    </tr>
                    
                    <?php 
                    $no = 1; // Mulai nomor urut dari 1
                    while($kategori = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>".$no."</td>"; // Menampilkan nomor urut
                        echo "<td>".$kategori['nama_kategori']."</td>";
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
