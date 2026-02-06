<?php
include 'koneksi.php';
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$nama     = $data['nama'] ?? '';
$email    = $data['email'] ?? '';
$password = $data['password'] ?? '';

$hash = password_hash($password, PASSWORD_DEFAULT);

// cek email
$cekEmail = $conn->query("SELECT id FROM users WHERE email='$email'");
if ($cekEmail->num_rows > 0) {
    echo json_encode([
        "status" => false,
        "message" => "Email sudah terdaftar"
    ]);
    exit;
}

// cek nama
$cekNama = $conn->query("SELECT id FROM users WHERE nama='$nama'");
if ($cekNama->num_rows > 0) {
    echo json_encode([
        "status" => false,
        "message" => "Nama sudah terdaftar"
    ]);
    exit;
}

$conn->query("INSERT INTO users (nama, email, password)
              VALUES ('$nama', '$email', '$hash')");

echo json_encode([
    "status" => true,
    "message" => "Register berhasil"
]);
