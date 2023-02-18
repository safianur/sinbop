<?php
include '../koneksi.php';

$nm_kategori = $_POST['nm_kategori'];
// var_dump ($nm_kategori); die;
// var_dump ("INSERT INTO kategori VALUES ('','$nm_kategori')"); die;

mysqli_query($koneksi, "INSERT INTO kategori VALUES ('','$nm_kategori')");

header("location:../../../kategori.php");