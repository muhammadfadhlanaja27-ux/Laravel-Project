<?php
include 'koneksi.php';
header("Content-Type: application/json");

// Ambil JSON dari body
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id'])) {
    echo json_encode([
        "status" => false,
        "message" => "Parameter id wajib dikirim"
    ]);
    exit;
}

$id = $data['id'];

$sql = "DELETE FROM siswa WHERE id='$id'";

if ($conn->query($sql)) {
    echo json_encode([
        "status" => true,
        "message" => "Data berhasil dihapus"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menghapus data"
    ]);
}
?>
