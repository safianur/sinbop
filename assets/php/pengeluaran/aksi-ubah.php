<?php
include '../koneksi.php';

$id_pengeluaran = $_POST['id-pengeluaran'];
$id_kategori = $_POST['kategori'];
$tanggal = $_POST['tanggal'];
$nm_pembelanja = $_POST['nm_pembelanja'];
$item_belanja = $_POST['item_belanja'];
$jumlah = $_POST['jumlah'];
// var_dump("UPDATE pengeluaran SET id_kategori='$id_kategori', tanggal='$tanggal', nm_pembelanja='$nm_pembelanja', item_belanja='$item_belanja', jumlah='$jumlah' WHERE id_pengeluaran='$id_pengeluaran'"); die;

mysqli_query($koneksi, "UPDATE pengeluaran SET id_kategori='$id_kategori', tanggal='$tanggal', nm_pembelanja='$nm_pembelanja', item_belanja='$item_belanja', jumlah='$jumlah' WHERE id_pengeluaran='$id_pengeluaran'");
// var_dump($d); die;
header("location:../../../pengeluaran.php");