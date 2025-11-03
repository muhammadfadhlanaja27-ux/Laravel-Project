<?php
include "koneksi.php";
$username = $_POST['username'];
$password = md5($_POST['password']);
$query = mysqli_query($con, "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'");
$hasilquery = mysqli_num_rows($query);
if($hasilquery > 0){
    session_start();
    $data = mysqli_fetch_assoc($query);
    $_SESSION['username'] = $data['username'];
    $_SESSION['hak_akses'] = $row['hak_akses'];
    header("Location: ../CRUD/menu.php");
}else{
    header("Location: login.php");
}
?>  