<?php
include '../koneksi.php';

$id = $_GET['id-kategori'];

mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori = '$id'");

header("location:../../../kategori.php");
