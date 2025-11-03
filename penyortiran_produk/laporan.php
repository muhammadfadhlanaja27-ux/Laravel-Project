<?php
session_start();
include "koneksi.php";

// Ambil keyword search
$search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

// Query dengan INNER JOIN dan search
$sql_where = '';
if ($search != '') {
    $sql_where = "
        WHERE p.nama_produk LIKE '%$search%' 
        OR k.kategori LIKE '%$search%'
        OR p.kondisi LIKE '%$search%'
        OR p.tipe_diskon LIKE '%$search%'
    ";
}

// Query produk dengan kategori
$query = mysqli_query($con, "
    SELECT p.*, k.kategori 
    FROM tbl_produk p
    INNER JOIN tbl_kategori k ON p.id_kategori = k.id_kategori
    $sql_where
    ORDER BY p.id_produk ASC
");

$jumlah = mysqli_num_rows($query);

// Navigasi items
$username = htmlspecialchars($_SESSION['username'] ?? 'User');
$nav_items = [
    'dasboard.php' => 'Home',
    'kategori.php' => 'Kategori',
    'produk.php' => 'Produk',
    'laporan.php' => 'Laporan',
    'logout.php' => 'Logout'
];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Produk</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .header-nav {
            background-color: #34495e;
            color: white;
            padding: 15px 30px;
            font-family: Arial, sans-serif;
            border-radius: 0 0 8px 8px;
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

        .container {
            padding: 20px;
            max-width: 1100px;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
        }

        h2 {
            color: #34495e;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        .search-form {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #f9f9f9;
        }

        input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background: #2980b9;
        }

        .reset-link {
            color: #e74c3c;
            text-decoration: none;
            margin-left: 10px;
            padding: 10px;
            border: 1px solid #e74c3c;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
            display: inline-block;
        }

        .reset-link:hover {
            background-color: #e74c3c;
            color: white;
        }

        .info {
            color: #34495e;
            font-style: italic;
            margin: 10px 0;
            padding: 10px;
            background-color: #e8f6ff;
            border-left: 4px solid #3498db;
            border-radius: 4px;
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
                <a href="<?= $url ?>" class="nav-link <?= (basename($url) == 'laporan.php') ? 'active-link' : '' ?>">
                    <?= $label ?>
                </a>
                <?php if ($url !== 'logout.php'): ?>
                    <span class="separator">|</span>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="container">
        <h2>Laporan Data Produk</h2>

        <div class="search-form">
            <form method="GET">
                <label>Cari Produk</label>
                <input type="text" name="search" placeholder="Cari nama produk, kategori, kondisi..."
                    value="<?= htmlspecialchars($search) ?>">
                <button type="submit">Cari</button>
                <?php if ($search != ''): ?>
                    <a href="laporan.php" class="reset-link">Reset Pencarian</a>
                <?php endif; ?>
            </form>
        </div>

        <?php if ($search != ''): ?>
            <p class="info">Menampilkan <?= $jumlah ?> hasil untuk pencarian: "<?= htmlspecialchars($search) ?>"</p>
        <?php endif; ?>

        <table id="tabel-data" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga Awal</th>
                    <th>Tipe Diskon</th>
                    <th>Nilai Diskon</th>
                    <th>Harga Jual Akhir</th>
                    <th>Tanggal Input</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($jumlah > 0): ?>
                    <?php $no = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                            <td><?= htmlspecialchars($row['kategori']) ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($row['tipe_diskon']) ?></td>
                            <td>
                                <?php if ($row['tipe_diskon'] == 'Normal'): ?>
                                    Rp <?= number_format($row['nilai_diskon'], 0, ',', '.') ?>
                                <?php else: ?>
                                    <?= htmlspecialchars($row['nilai_diskon']) ?>%
                                <?php endif; ?>
                            </td>
                            <td style="font-weight: bold; color: #27ae60;">Rp
                                <?= number_format($row['harga_akhir'], 0, ',', '.') ?>
                            </td>
                            <td><?= htmlspecialchars($row['tanggal_input']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center; color: #999; padding: 20px;">
                            <?php
                            if ($search != '') {
                                echo "Tidak ada data produk yang cocok dengan pencarian: <strong>" . htmlspecialchars($search) . "</strong>";
                            } else {
                                echo "Belum ada data produk dalam sistem.";
                            }
                            ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function(){
            $('#tabel-data').DataTable({
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "infoEmpty": "Tidak ada data",
                    "zeroRecords": "Tidak ditemukan data yang sesuai",
                    "paginate": {
                        "previous": "Sebelumnya",
                        "next": "Selanjutnya"
                    }
                }
            });
        });
    </script>
</body>
</html>