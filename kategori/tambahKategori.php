<!DOCTYPE html>
<html>
    <head>
        <title>Tambah Kategori</title>
        <link rel="stylesheet" href="../tabel.css">
    </head>
    <body>
        <center>
        <div class="kotak">
            <a href="kategori.php"><b> Kembali</b></a>
            <br/><br/>
            
            <form action="tambahKategori.php" method="POST" name="form1">
                <table align="center" class="tableAddEdit">
                    <tr>
                        <td>Nama Kategori</td>
                        <td><input type="text" name="nama_kategori" class="isi"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit" value="Tambah" class="buttonAdd"></td>
                    </tr>
                </table>
            </form>

<?php

if (isset($_POST['submit'])) {
    $nama_kategori = $_POST['nama_kategori'];
    include_once("../config.php");
    $result = mysqli_query($mysqli, "INSERT INTO kategori(nama_kategori) VALUES('$nama_kategori')");
    if ($result) {
        echo "<script>alert('Kategori berhasil ditambahkan!'); window.location.href='kategori.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan kategori')</script>";
    }
}
?>
        </div>
        </center>
    </body>
</html>