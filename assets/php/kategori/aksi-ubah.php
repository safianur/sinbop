<?php
include '../koneksi.php';

$id_kategori = $_POST['id-kategori'];
$nm_kategori = $_POST['nm_kategori'];
// var_dump("UPDATE kategori SET nm_kategori='$nm_kategori'WHERE id_kategori='$id_kategori'"); die;

mysqli_query($koneksi, "UPDATE kategori SET nm_kategori='$nm_kategori' WHERE id_kategori='$id_kategori'");

header("location:../../../kategori.php");