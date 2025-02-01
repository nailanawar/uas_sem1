<?php
include_once("../config.php");
if (isset($_GET['id_produk'])) {
    $id_produk = $_GET['id_produk'];
    $result = mysqli_query($mysqli, "DELETE FROM produk WHERE id_produk=$id_produk");
    header("Location: produk.php");
} 
else {
    echo "ID tidak ditemukan.";
}
?>