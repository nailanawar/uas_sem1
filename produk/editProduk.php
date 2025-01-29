<?php
include_once("../config.php");
if (isset($_POST['update'])) {
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $id_kategori = $_POST['id_kategori'];

    $gambar_produk = $_FILES['gambar_produk'];
    $tmp = $_FILES['gambar_produk']['tmp_name'];

    $keterangan_produk = $_POST['keterangan_produk'];
    $harga_produk = $_POST['harga_produk'];
    $stok_produk = $_POST['stok_produk'];

    // Tentukan lokasi penyimpanan gambar
    $path = '../img/' . $gambar_produk;

    // Cek apakah gambar berhasil dipindahkan
    if (move_uploaded_file($tmp, $path)) {
        // Query untuk memasukkan data produk
        $query = "UPDATE produk SET id_produk='$id_produk', nama_produk='$nama_produk', id_kategori='$id_kategori', gambar_produk='$gambar_produk', keterangan_produk='$keterangan_produk', harga_produk='$harga_produk', stok_produk='$stok_produk' WHERE id_produk=$id_produk";

        // Cek query berhasil atau tidak
        if (mysqli_query($mysqli, $query)) {
            echo "Data berhasil ditambahkan!";
        } else {
            echo "Error: " . mysqli_error($mysqli);
        }
    } else {
        echo "Gagal memindahkan file ke: " . $path;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<center>
        <div class="kotak">
            <a href="produk.php"><b> Kembali </b></a>
            <br/><br/>
            
            <form name="update_user" method="post" action="editProduk.php">
            <table width="90%" border="0" align="center" class="tableAddEdit">
            <tr>
                        <td>Nama</td>
                        <td><input type="text" name="nama_produk" class="isi" value="<?php echo $nama_produk; ?>"></td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>
                            <select name="id_kategori" class="isi">
                                <?php
        // Ambil kategori dari database
        $kategori = mysqli_query($mysqli, "SELECT * FROM kategori");

        // Iterasi semua kategori dan tambahkan sebagai pilihan
        while ($row = mysqli_fetch_assoc($kategori)) {

            // Cek apakah kategori saat ini adalah kategori yang dipilih

            $selected = ($row['id_kategori'] == $id_kategori) ? 'selected' : '';
            echo "<option value='{$row['id_kategori']}' $selected>{$row['nama_kategori']}</option>";
        }
        ?>
    </select>
</td>

                    </tr>
                    <tr>
                        <td>Gambar</td>
                        <td><input type="file" name="gambar_produk" class="isi" value="<?php echo $gambar_produk; ?>"></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td><input type="text" name="keterangan_produk" class="isi" value="<?php echo $keterangan_produk; ?>"></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td><input type="number" name="harga_produk" class="isi" value="<?php echo $harga_produk; ?>"></td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td><input type="number" name="stok_produk" class="isi" value="<?php echo $stok_produk; ?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" name="id_produk" value="<?php echo $_GET['id_produk']; ?>">
                            <input type="submit" name="update" value="Edit" class="buttonAdd">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        </center>
</body>
</html>

