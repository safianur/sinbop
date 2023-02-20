<?php
include '../koneksi.php';

$id_biaya = $_POST['id-biaya'];
$tanggal = $_POST['tanggal'];
$saldo_biaya = $_POST['saldo_biaya'];
// var_dump("UPDATE biaya SET tanggal='$tanggal'WHERE id_biaya='$id_biaya'"); die;

mysqli_query($koneksi, "UPDATE biaya SET tanggal='$tanggal', saldo_biaya='$saldo_biaya' WHERE id_biaya='$id_biaya'");

header("location:../../../biaya.php");