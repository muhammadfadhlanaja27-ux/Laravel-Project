<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Form Buku Tamu</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f6f8;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px 0;
      overflow-y: auto;
      overflow-x: hidden;
    }

    body::-webkit-scrollbar {
      display: none;
    }

    body {
      -ms-overflow-style: none;
      /* Untuk IE dan Edge */
      scrollbar-width: none;
      /* Untuk Firefox */
    }

    .form-container {
      background-color: #fff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      width: 400px;
      margin: 20px 0;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    label {
      display: block;
      margin-top: 15px;
      margin-bottom: 5px;
      font-weight: bold;
      color: #555;
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
      resize: vertical;
      box-sizing: border-box;
    }

    textarea {
      height: 80px;
    }

    .radio-group,
    .checkbox-group {
      margin-top: 10px;
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

    button {
      width: 100%;
      padding: 10px;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
      margin-top: 20px;
    }

    button:hover {
      background-color: #2980b9;
    }

    .btn-kembali {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #95a5a6;
      color: white;
      text-align: center;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
      margin-top: 10px;
      box-sizing: border-box;
    }

    .btn-kembali:hover {
      background-color: #7f8c8d;
    }

    small {
      color: #666;
      font-size: 12px;
    }
  </style>
</head>

<body>
  <div class="form-container">
    <h2>Form Buku Tamu</h2>
    <form action="submit-bukutamu.php" method="POST" enctype="multipart/form-data">
      <label>Nama</label>
      <input type="text" name="nama" required>

      <label>No Telp</label>
      <input type="text" name="telp" required>

      <label>Email</label>
      <input type="email" name="email" required>

      <label>Status</label>
      <select name="status" required>
        <option value="">-- Pilih Status --</option>
        <option value="Siswa">Siswa</option>
        <option value="Alumni">Alumni</option>
        <option value="Guru">Guru</option>
        <option value="Pegawai">Pegawai</option>
      </select>

      <label>Jenis Kelamin</label>
      <div class="radio-group">
        <label>
          <input type="radio" name="jenis_kelamin" value="Laki-laki" required>
          Laki-laki
        </label>
        <label>
          <input type="radio" name="jenis_kelamin" value="Perempuan" required>
          Perempuan
        </label>
      </div>

      <label>Hubungan</label>
      <div class="checkbox-group">
        <label>
          <input type="checkbox" name="hubungan[]" value="Teman SD">
          Teman SD
        </label>
        <label>
          <input type="checkbox" name="hubungan[]" value="Teman SMP">
          Teman SMP
        </label>
        <label>
          <input type="checkbox" name="hubungan[]" value="Teman SMK">
          Teman SMK
        </label>
        <label>
          <input type="checkbox" name="hubungan[]" value="Lainnya">
          Lainnya
        </label>
      </div>

      <label>Upload Foto</label>
      <input type="file" name="foto" accept="image/*" enchapt="multipart/form-data">
      <small>*Format: JPG, JPEG, PNG, GIF. Maksimal 200MB</small>

      <label>Alamat</label>
      <textarea name="alamat" required></textarea>

      <button type="submit">Submit</button>
      <a href="view-bukutamu.php" class="btn-kembali">Kembali ke Daftar</a>
    </form>
  </div>
</body>

</html>