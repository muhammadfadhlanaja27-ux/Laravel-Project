<?php
session_start();
// Pastikan koneksi.php ada dan $con didefinisikan
// include "koneksi.php"; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Kategori</title>
    <style>
        /* CSS yang ditingkatkan diletakkan di bagian berikutnya */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Styling Navigasi (Sama seperti dasboard.php) */
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

        /* Kontainer Utama */
        .container {
            padding: 20px;
            max-width: 900px;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
        }
        
        h3 {
            color: #34495e;
        }

        /* Styling Form */
        .form-container {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-bottom: 30px;
            background-color: #f9f9f9;
        }

        .form-container label {
            font-weight: 600;
            margin-right: 10px;
            color: #34495e;
        }

        .form-container input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 50%; /* Dikecilkan sedikit agar tombol bisa di samping */
            margin-right: 10px;
            box-sizing: border-box;
        }
        
        .form-container button[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #3498db; /* Biru terang */
            color: white;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .form-container button[type="submit"]:hover {
            background-color: #2980b9;
        }

        /* Styling Tabel */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .data-table th, .data-table td {
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            text-align: left;
        }

        .data-table th {
            background-color: #3498db; /* Biru terang */
            color: white;
            font-weight: 600;
        }

        .data-table tr:nth-child(even) {
            background-color: #f2f2f2; /* Striped rows */
        }

        .data-table tr:hover {
            background-color: #e8f6ff;
        }

        /* Styling Error */
        .error-box {
            background-color: #fdeded;
            color: #c0392b;
            padding: 15px;
            border: 1px solid #e74c3c;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="header-nav">
    <span class="welcome-message">
        Selamat datang, <?= htmlspecialchars($_SESSION['username'] ?? 'User') ?>
    </span>
    <div class="nav-links">
        <a href="dasboard.php" class="nav-link">Home</a> <span class="separator">|</span>
        <a href="kategori.php" class="nav-link active-link">Kategori</a> <span class="separator">|</span>
        <a href="produk.php" class="nav-link">Produk</a> <span class="separator">|</span>
        <a href="laporan.php" class="nav-link">Laporan</a> <span class="separator">|</span>
        <a href="logout.php" class="nav-link">Logout</a>
    </div>
</div>

<div class="container">

<h3>Tambah Kategori Baru</h3>
<div class="form-container">
    <form action="submit_kategori.php" method="POST">
        <label for="kategori_input">Nama Kategori</label>
        <input type="text" id="kategori_input" name="kategori" required>
        <button type="submit">Tambah Kategori</button>
    </form>
</div>

<?php 
// Asumsi $con adalah koneksi database dari koneksi.php
// Pastikan file koneksi.php di-include di awal script
@include "koneksi.php"; 

if (!isset($con)) {
    echo "<div class='error-box'><strong>FATAL ERROR:</strong> Koneksi database (\$con) tidak ditemukan. Pastikan file 'koneksi.php' telah di-include dengan benar.</div>";
} else {
    // Pengambilan data tetap, karena hanya tampilan yang diubah
    $query = mysqli_query($con, "SELECT * FROM tbl_kategori ORDER BY id_kategori ASC");

    if(!$query) {
        echo "<div class='error-box'>";
        echo "<strong>ERROR Database:</strong> " . mysqli_error($con);
        echo "</div>";
    } else {
        $jumlah = mysqli_num_rows($query);
?>

<h3>Daftar Kategori (Total: <?= $jumlah ?>)</h3>

<table class="data-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Kategori</th>
            <th>Tanggal Input</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($jumlah > 0): ?>
            <?php 
            // Inisialisasi variabel nomor urut
            $no_urut = 1; 
            ?>
            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                <tr>
                    <td><?= $no_urut++ ?></td>
                    <td><?= htmlspecialchars($row['kategori']) ?></td>
                    <td><?= htmlspecialchars($row['tanggal_input']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" style="text-align: center;">Belum ada data kategori. Silakan tambahkan di atas.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php 
    }
} 
?>
</div> </body>
</html>