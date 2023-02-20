<?php
include '../koneksi.php';

$id = $_GET['id-biaya'];
// var_dump("DELETE FROM biaya WHERE id_biaya = '$id'"); die;

mysqli_query($koneksi, "DELETE FROM biaya WHERE id_biaya = '$id'");

header("location:../../../biaya.php");
