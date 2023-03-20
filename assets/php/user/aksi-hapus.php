<?php
include '../koneksi.php';

$id = $_GET['id-user'];
// var_dump("DELETE FROM user WHERE id_user = '$id'"); die;

mysqli_query($koneksi, "DELETE FROM user WHERE id_user = '$id'");

header("location:../../../user.php");
