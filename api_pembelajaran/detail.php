<?php
include 'koneksi.php';
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

// Ambil id dari params (?id=1)
if (isset($data['id'])) {
    $id = $data['id'];
} else {
    $id = $_GET['id'];
}
// Query data siswa
$query = "SELECT * FROM siswa WHERE id = $id";
$result = $conn->query($query);

// Ambil hasil
$siswa = $result->fetch_assoc();

// Tampilkan sebagai JSON
echo json_encode([
    "status" => true,
    "data" => $siswa
]);

$conn->close();
