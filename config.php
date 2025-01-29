<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "db_uas_naila";

// Membuat koneksi ke database
$mysqli = mysqli_connect($host, $user, $password, $database);

// Mengecek apakah koneksi berhasil
if (!$mysqli) {
    die("Koneksi gagal: " . mysqli_connect_error()); // Menampilkan pesan error jika gagal
}
?>
