<?php
include '../koneksi.php';

$id_kategori = $_GET['id_kategori'];
$nm_kategori = $_POST['nm_kategori'];

mysqli_query($koneksi, "UPDATE kategori SET nm_kategori='$nm_kategori'WHERE id_kategori='$id_kategori'");

header("location:../../../kategori.php");