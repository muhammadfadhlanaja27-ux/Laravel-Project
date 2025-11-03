<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Buku Tamu</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      padding: 20px;
      max-width: 1200px;
      margin: 0 auto;
    }
    h1 { text-align: center; color: #333; }
    .search-box {
      text-align: center;
      margin: 20px 0;
    }
    .search-box input {
      padding: 8px 12px;
      width: 250px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }
    .btn {
      padding: 8px 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
      font-weight: bold;
    }
    .btn-primary { background: #3498db; color: white; }
    .btn-success { background: #27ae60; color: white; }
    .btn-secondary { background: #95a5a6; color: white; }
    .btn:hover { opacity: 0.9; }
    table {
      width: 100%;
      background: white;
      border-collapse: collapse;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: left;
    }
    th { background: #3498db; color: white; }
    tr:nth-child(even) { background: #f9f9f9; }
    tr:hover { background: #f1f1f1; }
    .foto { width: 50px; height: 50px; object-fit: cover; border-radius: 4px; }
    .text-center { text-align: center; }
    .text-danger { color: #e74c3c; }
    .info { color: #666; font-style: italic; margin: 10px 0; }
  </style>
</head>
<body>
  <h1>Daftar Buku Tamu</h1>
  
  <!-- Search Form -->
  <div class="search-box">
    <form method="GET">
      <input type="text" name="search" placeholder="Cari nama, email, atau status..." 
             value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
      <button type="submit" class="btn btn-primary">Cari</button>
      <?php if(!empty($_GET['search'])): ?>
        <a href="view-bukutamu.php" class="btn btn-secondary">Reset</a>
      <?php endif; ?>
    </form>
  </div>

  <a href="index.php" class="btn btn-success">+ Tambah Data</a>

  <?php
  include "koneksi.php";
  
  // Search query
  $search = $_GET['search'] ?? '';
  $searchSQL = '';
  
  if($search) {
    $searchEsc = mysqli_real_escape_string($con, $search);
    $searchSQL = "WHERE nama LIKE '%$searchEsc%' 
                  OR email LIKE '%$searchEsc%' 
                  OR status LIKE '%$searchEsc%' 
                  OR telp LIKE '%$searchEsc%'";
  }
  
  $query = mysqli_query($con, "SELECT * FROM tbl_tamu $searchSQL ORDER BY id_tamu DESC");
  $jumlah = mysqli_num_rows($query);
  ?>

  <?php if($search): ?>
    <p class="info text-center">
      Ditemukan <?= $jumlah ?> hasil untuk "<?= htmlspecialchars($search) ?>"
    </p>
  <?php endif; ?>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Foto</th>
        <th>Nama</th>
        <th>Telp</th>
        <th>Email</th>
        <th>Status</th>
        <th>Kelamin</th>
        <th>Hubungan</th>
        <th>Alamat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if($jumlah > 0): ?>
        <?php $no = 1; while($row = mysqli_fetch_assoc($query)): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td>
              <?php 
              $foto = !empty($row['foto']) && file_exists('uploads/'.$row['foto']) 
                      ? 'uploads/'.htmlspecialchars($row['foto']) 
                      : 'https://via.placeholder.com/50';
              ?>
              <img src="<?= $foto ?>" alt="Foto" class="foto">
            </td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['telp']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['status']) ?></td>
            <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
            <td><?= htmlspecialchars($row['hubungan']) ?></td>
            <td><?= htmlspecialchars($row['alamat']) ?></td>
            <td>
              <a href="edit-bukutamu.php?id_tamu=<?= $row['id_tamu'] ?>">Edit</a> |
              <a href="delete-bukutamu.php?id_tamu=<?= $row['id_tamu'] ?>" 
                 class="text-danger"
                 onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="10" class="text-center" style="padding: 30px; color: #999;">
            <?= $search ? "Tidak ada data untuk '$search'" : "Belum ada data. Silakan tambah data baru." ?>
          </td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</body>
</html>