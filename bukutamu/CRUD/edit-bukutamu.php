<?php
include "koneksi.php";
$id_tamu = $_GET['id_tamu'];

// Pastikan koneksi menggunakan variabel yang benar
$query = mysqli_query($con, "SELECT * FROM tbl_tamu WHERE id_tamu = '$id_tamu'");
$row = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if(!$row) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='view-bukutamu.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Buku Tamu</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f6f8;
      padding: 40px;
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }

    form {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      max-width: 500px;
      margin: auto;
    }

    label {
      display: block;
      margin-top: 15px;
      margin-bottom: 5px;
      font-weight: bold;
      color: #333;
    }

    input[type="text"],
    input[type="email"],
    input[type="file"],
    select,
    textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    textarea {
      resize: vertical;
      height: 80px;
    }

    .radio-group,
    .checkbox-group {
      margin-top: 10px;
      margin-bottom: 10px;
    }

    .radio-group label,
    .checkbox-group label {
      display: inline-block;
      margin-right: 15px;
      margin-top: 5px;
      font-weight: normal;
    }

    input[type="radio"],
    input[type="checkbox"] {
      margin-right: 5px;
      width: auto;
    }

    .foto-preview {
      margin-top: 10px;
      margin-bottom: 15px;
      text-align: center;
    }

    .foto-preview img {
      max-width: 200px;
      max-height: 200px;
      border-radius: 5px;
      border: 2px solid #ddd;
    }

    .foto-info {
      background-color: #e8f4f8;
      padding: 10px;
      border-radius: 5px;
      margin-top: 10px;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      margin-top: 20px;
      padding: 12px;
      width: 100%;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
      font-size: 16px;
    }

    input[type="submit"]:hover {
      background-color: #2980b9;
    }

    .btn-kembali {
      display: block;
      margin-top: 10px;
      padding: 12px;
      width: 100%;
      background-color: #95a5a6;
      color: white;
      text-align: center;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
      box-sizing: border-box;
      font-size: 16px;
    }

    .btn-kembali:hover {
      background-color: #7f8c8d;
    }

    small {
      color: #666;
      font-size: 12px;
      display: block;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <h2>Edit Data Buku Tamu</h2>

  <form action="update-bukutamu.php" method="POST" enctype="multipart/form-data">
    <label>Nama</label>
    <input type="text" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" required />

    <label>No Telp</label>
    <input type="text" name="telp" value="<?php echo htmlspecialchars($row['telp']); ?>" required />

    <label>Email</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required />

    <label>Status</label>
    <select name="status" required>
      <option value="">-- Pilih Status --</option>
      <option value="Siswa" <?php if($row['status'] == "Siswa") echo "selected"; ?>>Siswa</option>
      <option value="Guru" <?php if($row['status'] == "Guru") echo "selected"; ?>>Guru</option>
      <option value="Alumni" <?php if($row['status'] == "Alumni") echo "selected"; ?>>Alumni</option>
      <option value="Pegawai" <?php if($row['status'] == "Pegawai") echo "selected"; ?>>Pegawai</option>
    </select>

    <label>Jenis Kelamin</label>
    <div class="radio-group">
      <label>
        <input type="radio" name="jenis_kelamin" value="Laki-laki" 
               <?php if($row['jenis_kelamin'] == "Laki-laki") echo "checked"; ?> required>
        Laki-laki
      </label>
      <label>
        <input type="radio" name="jenis_kelamin" value="Perempuan" 
               <?php if($row['jenis_kelamin'] == "Perempuan") echo "checked"; ?> required>
        Perempuan
      </label>
    </div>

    <label>Hubungan</label>
    <div class="checkbox-group">
      <?php 
      // Pecah string hubungan menjadi array
      $hubungan_array = !empty($row['hubungan']) ? explode(", ", $row['hubungan']) : array(); 
      ?>
      <label>
        <input type="checkbox" name="hubungan[]" value="Teman SD" 
               <?php if(in_array("Teman SD", $hubungan_array)) echo "checked"; ?>>
        Teman SD
      </label>
      <label>
        <input type="checkbox" name="hubungan[]" value="Teman SMP" 
               <?php if(in_array("Teman SMP", $hubungan_array)) echo "checked"; ?>>
        Teman SMP
      </label>
      <label>
        <input type="checkbox" name="hubungan[]" value="Teman SMK" 
               <?php if(in_array("Teman SMK", $hubungan_array)) echo "checked"; ?>>
        Teman SMK
      </label>
      <label>
        <input type="checkbox" name="hubungan[]" value="Lainnya" 
               <?php if(in_array("Lainnya", $hubungan_array)) echo "checked"; ?>>
        Lainnya
      </label>
    </div>

    <label>Foto Saat Ini</label>
    <div class="foto-preview">
      <?php if(!empty($row['foto']) && file_exists('uploads/' . $row['foto'])): ?>
        <img src="uploads/<?php echo htmlspecialchars($row['foto']); ?>" alt="Foto Tamu">
        <div class="foto-info">
          <strong>File:</strong> <?php echo htmlspecialchars($row['foto']); ?>
        </div>
        <input type="hidden" name="foto_lama" value="<?php echo htmlspecialchars($row['foto']); ?>">
      <?php else: ?>
        <p style="color: #999; font-style: italic;">Belum ada foto</p>
        <input type="hidden" name="foto_lama" value="">
      <?php endif; ?>
    </div>

    <label>Ganti Foto (Upload Foto Baru)</label>
    <input type="file" name="foto" accept="image/*">
    <small>* Upload foto baru untuk mengganti foto lama. Foto lama akan otomatis dihapus.</small>
    <small>* Kosongkan jika tidak ingin mengubah foto.</small>
    <small>* Format: JPG, JPEG, PNG, GIF | Maksimal: 2MB</small>

    <label>Alamat</label>
    <textarea name="alamat" required><?php echo htmlspecialchars($row['alamat']); ?></textarea>

    <input type="hidden" name="id_tamu" value="<?php echo $row['id_tamu']; ?>" />
    
    <input type="submit" value="Update Data" />
    
    <a href="view-bukutamu.php" class="btn-kembali"> Kembali ke Daftar</a>
  </form>
</body>
</html>