<?php
include('config.php');

if (isset($_POST['daftar'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($mysqli, $check_email);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email sudah terdaftar!');</script>";
    } else {
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if (mysqli_query($mysqli, $query)) {
            echo "<script>alert('Pendaftaran berhasil!');window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center><br><br><br><br>
<div class="kotak">
        <h2>Daftar</h2>
        <form method="POST" action="daftar.php">
            <div class="kolom">
                <label>Nama Pengguna</label>
                <input type="text" name="username" placeholder="Masukkan nama pengguna" required><br><br>
            </div>
            <div class="kolom">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email" required><br><br>
            </div>
            <div class="kolom">
                <label>Kata Sandi</label>
                <input type="password" name="password" placeholder="Masukkan kata sandi" required><br><br><br>
            </div>
            <button type="submit" name="daftar" class="btn">Daftar</button><br><br>
        </form>
        <span class="link">Sudah punya akun? <a href="login.php">Masuk</a></span>
    </div>
    </center>
</body>
</html>
