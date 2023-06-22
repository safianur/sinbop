<?php
    error_reporting(0);
    include '../koneksi.php';

    $dari = $_GET['tgl-awal'];
    $sampai = $_GET['tgl-akhir'];
    $sqlperiode = "WHERE pengeluaran.tanggal BETWEEN '" . $dari . "' AND '" . $sampai . "'";
    $periode = "WHERE biaya.tanggal BETWEEN '" . $dari . "' AND '" . $sampai . "'";

    $filename = ' BIOPS BULAN ' . date('F Y', strtotime($dari));
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=' $filename '.xls");
?>

<h1 style="font-size: 20;">
    RINCIAN PENGELUARAN BIAYA OPERASIONAL<br>
    PABRIK BANYUWANGI PT INKA (Persero)<br>
    PERIODE <?= date('F Y', strtotime($dari))?>
</h1>
<table border="1">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Item Belanja</th>
            <th>Jumlah</th>
        </tr>
        <?php
            $no = 1;
            $a = mysqli_query($koneksi, "SELECT * FROM kategori");
            while ($tampil = mysqli_fetch_array($a)){
                $kat = $tampil['id_kategori'];
                $b = mysqli_query($koneksi, "SELECT * FROM pengeluaran $sqlperiode and 
                    pengeluaran.id_kategori=$kat ORDER BY tanggal");
                if(mysqli_num_rows($b) != 0){
        ?>
        <tr>
            <td colspan="4"><?= $tampil['nm_kategori'] ?></td>
        </tr>
            <?php
                while ($ambil = mysqli_fetch_array($b)){
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= tgl_indo($ambil['tanggal']) ?></td>
                <td><?= $ambil['item_belanja'] ?></td>
                <td><?= rupiah($ambil['jumlah']) ?></td>
            </tr>
            <?php
                $total += $ambil['jumlah'];
            } } } ?>
        <tr>
            <td colspan="3" style="font-weight: bold;">Total Belanja</td>
            <td style="font-weight: bold;"><?= rupiah($total) ?></td>
        </tr>
        
        <tr>
            <td colspan="3" style="font-weight: bold;">Biaya Operasional</td>
            <?php
                    $ambil = mysqli_query($koneksi,"SELECT * FROM biaya $periode");
                    $tampil = mysqli_fetch_array($ambil);
            ?>
            <td style="font-weight: bold;"><?= rupiah($tampil['saldo_biaya']) ?></td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold;">Deviasi Selisih Lebih/Kurang</td>
            <td style="font-weight: bold;"><?= rupiah($tampil['saldo_biaya']-$total) ?></td>
        </tr>
</table>