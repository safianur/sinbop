<?php
include '../koneksi.php';

$tanggal = $_POST['tanggal'];
$saldo_biaya = $_POST['saldo_biaya'];
// var_dump ($saldo_biaya); die;
var_dump ("INSERT INTO biaya VALUES ('','$tanggal','$saldo_biaya'))"); die;

mysqli_query($koneksi, "INSERT INTO biaya VALUES ('','$tanggal','$saldo_biaya')");

header("location:../../../kategori.php");