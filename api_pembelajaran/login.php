<?php
include 'koneksi.php';
header("Content-Type: application/json");

// Ambil data JSON dari body
$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

if ($email == '' || $password == '') {
    echo json_encode([
        "status" => false,
        "message" => "Email dan password wajib diisi"
    ]);
    exit;
}

// Cari user berdasarkan email
$query = $conn->query("SELECT * FROM users WHERE email='$email'");

if ($query->num_rows == 0) {
    echo json_encode([
        "status" => false,
        "message" => "Email tidak terdaftar"
    ]);
    exit;
}

$user = $query->fetch_assoc();

// Verifikasi password
if (password_verify($password, $user['password'])) {
    echo json_encode([
        "status" => true,
        "message" => "Login berhasil",
        "data" => [
            "id" => $user['id'],
            "nama" => $user['nama'],
            "email" => $user['email']
        ]
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Password salah"
    ]);
}