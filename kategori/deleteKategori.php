<?php
include_once("../config.php");
if (isset($_GET['id_kategori'])) {
    $id_kategori = $_GET['id_kategori'];
    $result = mysqli_query($mysqli, "DELETE FROM kategori WHERE id_kategori=$id_kategori");
    header("Location: kategori.php");
} 
else {
    echo "ID tidak ditemukan.";
}
?>