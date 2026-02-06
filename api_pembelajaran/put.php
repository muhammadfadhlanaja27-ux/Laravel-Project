<?php
include 'koneksi.php';
header("Content-Type: application/json");

// Ambil JSON dari body
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id']) || !isset($data['nama'])) {
    echo json_encode([
        "status" => false,
        "message" => "Parameter id dan nama wajib dikirim"
    ]);
    exit;
}

$id = $data['id'];
$nama = $data['nama'];

$sql = "UPDATE siswa SET nama='$nama' WHERE id='$id'";

if ($conn->query($sql)) { 
    echo json_encode(["status" => true, "message" => "Data berhasil diupdate"]);
} else {
    echo json_encode(["status" => false, "message" => "Gagal update"]);
}
?>