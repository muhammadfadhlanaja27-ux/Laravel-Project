<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "koneksi.php";

// Fungsi untuk redirect dengan pesan
function redirect($message, $url = 'view-bukutamu.php') {
    echo "<script>alert('$message'); window.location='$url';</script>";
    exit();
}

function redirectBack($message) {
    echo "<script>alert('$message'); window.history.back();</script>";
    exit();
}

// Ambil dan sanitize data POST
$id_tamu = mysqli_real_escape_string($con, $_POST['id_tamu']);
$nama = mysqli_real_escape_string($con, $_POST['nama']);
$telp = mysqli_real_escape_string($con, $_POST['telp']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$status = mysqli_real_escape_string($con, $_POST['status']);
$jenis_kelamin = mysqli_real_escape_string($con, $_POST['jenis_kelamin']);
$alamat = mysqli_real_escape_string($con, $_POST['alamat']);

// Proses hubungan (jika array)
$hubungan = isset($_POST['hubungan']) && is_array($_POST['hubungan']) 
            ? implode(", ", $_POST['hubungan']) 
            : '';

// Inisialisasi foto
$foto = $_POST['foto_lama'] ?? '';
$foto_diganti = false;

// Proses upload foto baru
if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $file = $_FILES['foto'];
    $ekstensi = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $ekstensi_allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $max_size = 2000000; // 2MB
    $folder = "uploads/";
    
    // Validasi ekstensi
    if(!in_array($ekstensi, $ekstensi_allowed)) {
        redirectBack('Format file tidak diizinkan. Hanya JPG, JPEG, PNG, GIF');
    }
    
    // Validasi ukuran
    if($file['size'] > $max_size) {
        redirectBack('Ukuran file terlalu besar. Maksimal 2MB');
    }
    
    // Buat folder jika belum ada
    if(!is_dir($folder)) {
        mkdir($folder, 0755, true);
    }
    
    // Upload file baru
    $nama_baru = uniqid() . '_' . time() . '.' . $ekstensi;
    
    if(move_uploaded_file($file['tmp_name'], $folder . $nama_baru)) {
        $foto_diganti = true;
        
        // Hapus foto lama jika ada
        if(!empty($_POST['foto_lama']) && file_exists($folder . $_POST['foto_lama'])) {
            unlink($folder . $_POST['foto_lama']);
        }
        
        $foto = $nama_baru;
    } else {
        redirectBack('Gagal mengupload foto');
    }
}

// Update database
$query = "UPDATE tbl_tamu SET 
          nama = '$nama',
          telp = '$telp',
          email = '$email',
          status = '$status',
          jenis_kelamin = '$jenis_kelamin',
          hubungan = '$hubungan',
          foto = '$foto',
          alamat = '$alamat'
          WHERE id_tamu = '$id_tamu'";

if(mysqli_query($con, $query)) {
    $message = $foto_diganti 
               ? 'Data berhasil diupdate dan foto berhasil diganti!' 
               : 'Data berhasil diupdate!';
    redirect($message);
} else {
    redirectBack('Error: ' . addslashes(mysqli_error($con)));
}
?>