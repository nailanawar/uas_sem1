<?php
include_once("../config.php");
if (isset($_GET['id_transaksi'])) {
    $id_transaksi = $_GET['id_transaksi'];
    $result = mysqli_query($mysqli, "DELETE FROM transaksi WHERE id_transaksi=$id_transaksi");
    header("Location: pengambilan.php");
} 
else {
    echo "ID tidak ditemukan.";
}
?>