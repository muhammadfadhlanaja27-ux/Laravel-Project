<?php
include "koneksi.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_produk = mysqli_real_escape_string($con, $_POST['nama_produk']);
    $deskripsi = mysqli_real_escape_string($con, $_POST['deskripsi']);
    $id_kategori = intval($_POST['id_kategori']);
    $kondisi = mysqli_real_escape_string($con, $_POST['kondisi']);
    $harga = intval($_POST['harga']);
    $qty = intval($_POST['qty']);
    $tipe_diskon = mysqli_real_escape_string($con, $_POST['tipe_diskon']);
    $nilai_diskon = intval($_POST['nilai_diskon']);
    
    // Hitung harga setelah diskon berdasarkan tipe
    $harga_diskon_rupiah = 0;
    $harga_akhir = $harga;
    
    if($nilai_diskon > 0) {
        if($tipe_diskon == 'Normal') {
            // Normal = potongan harga langsung dalam rupiah
            $harga_diskon_rupiah = $nilai_diskon;
            $harga_akhir = $harga - $nilai_diskon;
        } else {
            // Diskon = persen dari harga
            $harga_diskon_rupiah = ($harga * $nilai_diskon) / 100;
            $harga_akhir = $harga - $harga_diskon_rupiah;
        }
    }
    
    // Insert ke database dengan id_kategori
    $query = "INSERT INTO tbl_produk (
                nama_produk, 
                deskripsi, 
                id_kategori, 
                kondisi, 
                harga, 
                qty, 
                tipe_diskon, 
                nilai_diskon,
                harga_akhir
              ) VALUES (
                '$nama_produk',
                '$deskripsi',
                '$id_kategori',
                '$kondisi',
                '$harga',
                '$qty',
                '$tipe_diskon',
                '$nilai_diskon',
                '$harga_akhir'
              )"; 
    
    if(mysqli_query($con, $query)) {
        $pesan_diskon = '';
        if($tipe_diskon == 'Normal') {
            $pesan_diskon = "Diskon Normal: Rp " . number_format($nilai_diskon, 0, ',', '.');
        } else {
            $pesan_diskon = "Diskon: " . $nilai_diskon . "%";
        }
        
        echo "<script>
                alert('Produk berhasil ditambahkan!\\n\\nHarga Asli: Rp " . number_format($harga, 0, ',', '.') . "\\n" . $pesan_diskon . "\\nPotongan: Rp " . number_format($harga_diskon_rupiah, 0, ',', '.') . "\\nHarga Jual: Rp " . number_format($harga_akhir, 0, ',', '.') . "');
                window.location='laporan.php';
              </script>";
    } else {
        echo "<h3>Error Database:</h3>";
        echo mysqli_error($con);
        echo "<br><br><a href='produk.php'>Kembali</a>";
    }
} else {
    header("Location: produk.php");
    exit();
}
?>