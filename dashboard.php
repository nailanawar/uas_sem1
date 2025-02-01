<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

include_once "config.php";
include_once "sidebar.php";

$id_users = $_SESSION['id_users'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bemira.Co</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body><br><br><br><br>
    
    <div class="main-content">
    <center>
        <br>
        <div class="header">
            <h3>Welcome, <?php echo $_SESSION['username']; ?>!</h3>
        </div>
        <br>
        
            
        <form method="post">
    <select name="export_type" class="select-option" onchange="location = this.value;">
        <option value="" disabled selected>Pilih Data</option>
        <option value="./kategori/export/export.php">Kategori</option>
        <option value="./produk/export/export.php">Produk</option>
        <option value="./pengambilan/export/export.php">Pengambilan</option>
    </select>
</form>

                
        <br><br>

        <div class="cards-container">
            <div class="card">
                <h3>Total Kategori</h3>
                <p style="color: #EB5A3C;">
                    <?php
                    $result = mysqli_query($mysqli, "SELECT COUNT(*) as total_kategori FROM kategori WHERE id_users = '$id_users'");
                    echo mysqli_fetch_assoc($result)['total_kategori'];
                    ?>
                </p>
            </div>

            <div class="card">
                <h3>Total Produk</h3>
                <p style="color: #EB5A3C;">
                    <?php
                    $result = mysqli_query($mysqli, "SELECT COUNT(*) as total_produk FROM produk WHERE id_users = '$id_users'");
                    echo mysqli_fetch_assoc($result)['total_produk'];
                    ?>
                </p>
            </div>

            <div class="card">
                <h3>Total Pengambilan</h3>
                <p style="color: #EB5A3C;">
                    <?php
                    $result = mysqli_query($mysqli, "SELECT COUNT(*) as total_pengambilan FROM transaksi WHERE id_users = '$id_users'");
                    echo mysqli_fetch_assoc($result)['total_pengambilan'];
                    ?>
                </p>
            </div>
        </div>
        </center>
    </div>
    
</body>
</html>
