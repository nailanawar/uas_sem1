
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
    <link rel="stylesheet" href="sidebar.css">
    <nav class="navbar">
    <div class="logo">
        <i class="bx bx-menu" id="sidebarBtn"></i>
    </div>
</nav>

<div class="sidebar">
    <div class="sidebar-header">
    <i class='bx bxl-bing' style="font-size: 30px; margin-left: 10px;"></i>
        <span class="header-name">Bemira.Co</span>
    </div>
    <div class="sidebar-content">
        <ul class="lists">
            <li class="list">
                <a href="/UAS_Web1_NailaNawarHaura_24110002/dashboard.php" class="nav-link">
                    <i class="bx bx-home-alt icon"></i>
                    <span class="link">Data</span>
                </a>
            </li>
            <li class="list">
                <a href="/UAS_Web1_NailaNawarHaura_24110002/kategori/kategori.php" class="nav-link">
                    <i class='bx bx-spreadsheet icon'></i>
                    <span class="link">Kategori</span>
                </a>
            </li>
            <li class="list">
                <a href="/UAS_Web1_NailaNawarHaura_24110002/produk/produk.php" class="nav-link">
                    <i class='bx bx-package icon'></i>
                    <span class="link">Produk</span>
                </a>
            </li>
            <li class="list">
                <a href="/UAS_Web1_NailaNawarHaura_24110002/pengambilan/pengambilan.php" class="nav-link">
                    <i class='bx bx-archive-out icon'></i>
                    <span class="link">Pengambilan</span>
                </a>
            </li>
            <li class="list"><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <a href="daftar.php" class="nav-link">
                    <i class='bx bx-log-out icon'></i>
                    <span class="link">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<script>
document.getElementById('sidebarBtn').addEventListener('click', function() {
    document.querySelector('.sidebar').classList.toggle('close');
    document.querySelector('.navbar').classList.toggle('sidebar-close');
    document.querySelector('.main-content').classList.toggle('sidebar-close');
});
</script>