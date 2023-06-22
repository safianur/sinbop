<?php
include '../koneksi.php';

$id_user = $_POST['id-user'];
$username = $_POST['username'];
$password = $_POST['password'];
// var_dump("UPDATE user SET username='$username', password='$password' WHERE id-user='$id_user'"); die;

mysqli_query($koneksi, "UPDATE user SET username='$username', password='$password' WHERE id_user='$id_user'");
// var_dump($tampil); die;

header("location:../../../user.php");