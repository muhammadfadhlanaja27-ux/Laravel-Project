<?php
include 'koneksi.php';

$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];

$sql = "INSERT INTO siswa (nama, kelas, jurusan) VALUES ('$nama', '$kelas', '$jurusan')";

if ($conn->query($sql)) {
  echo json_encode(["status" => "success"]);
} else {
  echo json_encode(["status" => "error"]);
}