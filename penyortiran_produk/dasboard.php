<?php
session_start();

// Menggunakan variabel untuk mempermudah styling dan navigasi
$username = htmlspecialchars($_SESSION['username'] ?? 'User');
$nav_items = [
    'dasboard.php' => 'Home',
    'kategori.php' => 'Kategori',
    'produk.php' => 'Produk',
    'laporan.php' => 'Laporan',
    'logout.php' => 'Logout'
];

// Menandai halaman aktif
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            color: #333;
        }
        
        /* Styling Navigasi */
        .header-nav {
            background-color: #34495e; /* Biru gelap/Navy */
            color: white;
            padding: 15px 30px;
            font-family: Arial, sans-serif;
            border-radius: 0 0 8px 8px; /* Hanya di bawah */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-message {
            font-size: 1.2em; 
            font-weight: bold; 
        }

        .nav-link {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .nav-link:hover {
            background-color: #2c3e50;
        }

        .active-link {
            background-color: #2c3e50;
            font-weight: bold;
        }

        .separator {
            color: #7f8c8d;
            margin: 0 5px;
        }
        
        .content-container {
            padding: 20px;
            max-width: 900px;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
        }

        h1 {
            color: #34495e;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        .card {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 6px;
            margin-top: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="header-nav">
    <span class="welcome-message">
        Selamat datang, <?= $username ?>
    </span>
    <div class="nav-links">
        <?php foreach ($nav_items as $url => $label): ?>
            <a href="<?= $url ?>" class="nav-link <?= ($url == $current_page) ? 'active-link' : '' ?>">
                <?= $label ?>
            </a>
            <?php if ($url !== 'logout.php'): ?>
                <span class="separator">|</span>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<div class="content-container">
    <h1>Dashboard Utama</h1>
    <p>Ini adalah halaman utama (dashboard) sistem manajemen Anda. Pilih menu di atas untuk mulai bekerja.</p>

    <div class="card">
        <h2>Informasi Cepat</h2>
        <p>Anda dapat mengelola Kategori, Produk, dan melihat Laporan Penjualan/Inventori melalui menu navigasi di atas.</p>
        <p style="color: #3498db; font-weight: bold;">Sistem siap digunakan.</p>
    </div>
</div>

</body>
</html>