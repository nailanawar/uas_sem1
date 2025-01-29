
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<center><br><br><br><br>
<div class="kotak">
        <h2>Masuk</h2>
        <form method="POST" action="login.php">
            <div class="kolom">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email" required><br><br>
            </div>
            <div class="kolom">
                <label>Kata Sandi</label>
                <input type="password" name="password" placeholder="Masukkan kata sandi" required><br><br><br>
            </div>
            <button type="submit" name="login" class="btn">Masuk</button><br><br>
        </form>
        <span class="link">Belum punya akun? <a href="daftar.php">Daftar</a></span>
    </div>
    </center>
</body>
</html>

<?php
session_start(); // Mulai session
include('config.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) > 0) {
        // Ambil data pengguna
        $user = mysqli_fetch_assoc($result);
        
        // Simpan username di session
        $_SESSION['username'] = $user['username'];
        
        // Arahinke dashboard
        echo "<script>alert('Selamat Datang');window.location.href = 'dashboard.php';</script>";
        exit();
    } else {
        echo "<script>alert('Email atau kata sandi salah!');</script>";
    }
}
?>