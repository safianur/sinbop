<?php
include '../koneksi.php';

$id = $_GET['id-pengeluaran'];
// var_dump("DELETE FROM pengeluaran WHERE id_pengeluaran = '$id'"); die;

mysqli_query($koneksi, "DELETE FROM pengeluaran WHERE id_pengeluaran = '$id'");

header("location:../../../pengeluaran.php");
