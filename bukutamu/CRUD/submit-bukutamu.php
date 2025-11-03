<?php
include "koneksi.php";

$nama = mysqli_real_escape_string($con, $_POST['nama']);
$telp = mysqli_real_escape_string($con, $_POST['telp']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$status = mysqli_real_escape_string($con, $_POST['status']);
$jenis_kelamin = mysqli_real_escape_string($con, $_POST['jenis_kelamin']);
$alamat = mysqli_real_escape_string($con, $_POST['alamat']);

$hubungan = "";
if(isset($_POST['hubungan']) && is_array($_POST['hubungan'])) {
    $hubungan = implode(", ", $_POST['hubungan']);
}

$foto = "";
$upload_berhasil = true;
$pesan_error = "";

if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $nama_file = $_FILES['foto']['name'];
    $ukuran_file = $_FILES['foto']['size'];
    $tmp_file = $_FILES['foto']['tmp_name'];
    
    $ekstensi = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    
    $ekstensi_allowed = array('jpg', 'jpeg', 'png', 'gif');
    
    if(!in_array($ekstensi, $ekstensi_allowed)) {
        $upload_berhasil = false;
        $pesan_error = "Format file tidak diizinkan. Hanya JPG, JPEG, PNG, dan GIF.";
    }
    
    if($ukuran_file > 2000000) {
        $upload_berhasil = false;
        $pesan_error = "Ukuran file terlalu besar. Maksimal 2MB.";
    }
    
    if($upload_berhasil) {
        $nama_baru = uniqid() . '_' . time() . '.' . $ekstensi;

        $folder = "uploads/";
        
        if(!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }
        
        if(move_uploaded_file($tmp_file, $folder . $nama_baru)) {
            $foto = $nama_baru;
        } else {
            $upload_berhasil = false;
            $pesan_error = "Gagal mengupload file.";
        }
    }
}

if($upload_berhasil) {
    $query = "INSERT INTO tbl_tamu (nama, telp, email, status, jenis_kelamin, hubungan, foto, alamat, tgl_entri) 
              VALUES ('$nama', '$telp', '$email', '$status', '$jenis_kelamin', '$hubungan', '$foto', '$alamat', NOW())";
    
    if(mysqli_query($con, $query)) {
        echo "<script>
                alert('Data berhasil disimpan!');
                window.location='view-bukutamu.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Error Database: " . addslashes(mysqli_error($con)) . "');
                window.location='index.php';
              </script>";   
    }
} else {
    echo "<script>alert('$pesan_error'); window.location='index.php';</script>";
}
?>