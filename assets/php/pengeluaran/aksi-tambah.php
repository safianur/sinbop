<?php
include '../koneksi.php';

// $bln = date("m-y");
$bln = 01;
$id_kategori = $_POST['kategori'];
$tanggal = $_POST['tanggal'];
$nm_pembelanja = $_POST['nm_pembelanja'];
$item_belanja = $_POST['item_belanja'];
$jumlah = $_POST['jumlah'];
// var_dump("INSERT INTO pengeluaran VALUES ('', '$id_kategori','$tanggal','$nm_pembelanja', '$item_belanja','$jumlah')"); die;

// $kat = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM pengeluaran WHERE MONTH(tanggal) = '".$bln."'"));
// $kat = mysqli_num_rows(mysqli_query($koneksi,"SELECT nm_kategori, DATE_FORMAT(tanggal, '%m-%Y') as tanggal, 
// SUM(jumlah) as jumlah FROM pengeluaran JOIN kategori ON kategori.id_kategori=pengeluaran.id_kategori 
// WHERE MONTH(tanggal) = '".$bln."' GROUP BY nm_kategori, MONTH(tanggal), YEAR(tanggal) DESC"));
// $jml_kategori = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM kategori"));
// var_dump ($kat != $jml_kategori);die;

// if($kat != $jml_kategori){
//     $tampil = mysqli_query($koneksi, "INSERT INTO pengeluaran VALUES 
//         ('', '$id_kategori','$tanggal','$nm_pembelanja', '$item_belanja', 0)");
// }else{
    // $tambah = 
    mysqli_query($koneksi, "INSERT INTO pengeluaran VALUES 
        ('', '$id_kategori','$tanggal','$nm_pembelanja', '$item_belanja','$jumlah')");
// }
// var_dump($d); die;
header("location:../../../pengeluaran.php");