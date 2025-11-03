<?php
session_start();
include "koneksi.php"; // Pastikan koneksi.php ada

// Ambil data kategori dari database
$query_kategori = mysqli_query($con, "SELECT * FROM tbl_kategori ORDER BY kategori ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Produk</title>
    <style>
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

        .separator {
            color: #7f8c8d;
            margin: 0 5px;
        }
        
        .container {
            padding: 20px;
            max-width: 700px;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
        }

        h2 {
            color: #34495e;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-top: 0;
        }

        /* Styling Form */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: none; /* Hilangkan border tabel */
        }
        tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        input[type="text"], input[type="number"], textarea, select {
            padding: 10px;
            width: calc(100% - 20px);
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        input:focus, textarea:focus, select:focus {
            border-color: #3498db;
            outline: none;
        }
        textarea {
            resize: vertical;
        }

        button[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #27ae60; /* Hijau */
            color: white;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.1s;
            width: 100%;
            margin-top: 15px;
        }

        button[type="submit"]:hover {
            background-color: #2ecc71;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

<div class="header-nav">
    <span class="welcome-message">
        Selamat datang, <?= htmlspecialchars($_SESSION['username']) ?>
    </span>
    <div class="nav-links">
        <a href="dasboard.php" class="nav-link">Home</a> <span class="separator">|</span>
        <a href="kategori.php" class="nav-link">Kategori</a> <span class="separator">|</span>
        <a href="produk.php" class="nav-link" style="background-color: #2c3e50;">Produk</a> <span class="separator">|</span>
        <a href="laporan.php" class="nav-link">Laporan</a> <span class="separator">|</span>
        <a href="logout.php" class="nav-link">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Input Data Produk Baru</h2>
    <form action="submit_produk.php" method="POST">
      <table>
        <tr>
          <td style="width: 30%;">Nama Produk</td>
          <td><input type="text" name="nama_produk" required></td>
        </tr>
        <tr>
          <td>Deskripsi</td>
          <td><textarea name="deskripsi" rows="4" cols="40"></textarea></td>
        </tr>
        <tr>
          <td>Kategori</td>
          <td>
            <select name="id_kategori" required>
              <option value="">Silahkan Pilih Kategori</option>
              <?php while($row = mysqli_fetch_assoc($query_kategori)): ?>
                <option value="<?= $row['id_kategori'] ?>">
                  <?= htmlspecialchars($row['kategori']) ?>
                </option>
              <?php endwhile; ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Kondisi</td>
          <td>
            <select name="kondisi" required>
              <option value="">Silahkan Pilih Kondisi</option>
              <option value="Baru">Baru</option>
              <option value="Bekas">Bekas</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Harga (Rp)</td>
          <td><input type="number" name="harga" required min="0" step="100"></td>
        </tr>
        <tr>
          <td>QTY</td>
          <td><input type="number" name="qty" required min="1" value="1"></td>
        </tr>
        <tr>
          <td>Tipe Diskon</td>
          <td>
            <select name="tipe_diskon" required>
              <option value="">Silahkan Pilih Tipe</option>
              <option value="Normal">Normal</option>
              <option value="Diskon">Diskon (%)</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Nilai Diskon</td>
          <td><input type="number" name="nilai_diskon" step="0.01" value="0" min="0"></td>
        </tr>
        <tr>
          <td colspan="2">
            <button type="submit">Simpan Produk</button>
          </td>
        </tr>
      </table>
    </form>
</div>

</body>
</html>