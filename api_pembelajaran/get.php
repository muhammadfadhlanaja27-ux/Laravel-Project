<?php
include 'koneksi.php';

$query = $conn->query("SELECT * FROM siswa");
$data = [];

while ($row = $query->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);