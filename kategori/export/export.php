<?php
include_once("../../config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="main-content">
    <center><br>
        <h1>DATA KATEGORI</h1>
        </center>
        <div class="bg-text">
            <button class="buttonTambah">
                <a href="export-pdf.php"> Export PDF </a> 
            </button>
            <button class="buttonExport">
                <a href="export-excel.php"> Export Excel </a>
            </button>
            <button class="buttonKembali">
                <a href="../kategori.php"> Kembali </a> 
            </button>
            <br/><br/>
            <center>
                <table class="index">
                    <tr>
                        <th>ID</th>
                        <th>NAMA KATEGORI</th>
                    </tr>
                    
                    <?php 
            $result = mysqli_query($mysqli, "SELECT * FROM kategori ORDER BY id_kategori ASC");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['id_kategori']."</td>";
                echo "<td>".$row['nama_kategori']."</td>";
                echo "</tr>";
            }
            ?>
                </table>
            </center>
        </div>
    </div>

</body>
</html>