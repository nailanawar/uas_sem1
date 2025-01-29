<?php
include_once("../config.php");
if (isset($_POST['update'])) {
    $id_kategori = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori'];
    $result = mysqli_query($mysqli, "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori=$id_kategori");
    header("Location: kategori.php");
}
$id_kategori = $_GET['id_kategori'];
$result = mysqli_query($mysqli, "SELECT * FROM kategori WHERE id_kategori=$id_kategori");
while ($kategori = mysqli_fetch_array($result)) {
    $nama_kategori = $kategori['nama_kategori'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<center>
        <div class="kotak">
            <a href="kategori.php"><b> Kembali </b></a>
            <br/><br/>
            
            <form name="update_user" method="post" action="editKategori.php">
            <table width="90%" border="0" align="center" class="tableAddEdit">
                    <tr>
                        <td>Nama Kategori</td>
                        <td><input type="text" name="nama_kategori" value="<?php echo $nama_kategori; ?>" class="isi"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" name="id_kategori" value="<?php echo $_GET['id_kategori']; ?>">
                            <input type="submit" name="update" value="Edit" class="buttonAdd">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        </center>
</body>
</html>



