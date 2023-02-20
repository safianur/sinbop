<?php
include '../koneksi.php';

$id_kategori = $_POST['kategori'];
$tanggal = $_POST['tanggal'];
$nm_pembelanja = $_POST['nm_pembelanja'];
$item_belanja = $_POST['item_belanja'];
$jumlah = $_POST['jumlah'];
// var_dump("INSERT INTO pengeluaran VALUES ('', '$id_kategori','$tanggal','$nm_pembelanja', '$item_belanja','$jumlah')"); die;

mysqli_query($koneksi, "INSERT INTO pengeluaran VALUES ('', '$id_kategori','$tanggal','$nm_pembelanja', '$item_belanja','$jumlah')");
// var_dump($d); die;
header("location:../../../pengeluaran.php");