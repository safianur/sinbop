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
    KANTOR INKA PERWAKILAN BANYUWANGI<br>
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
                $a = mysqli_query($koneksi, "SELECT * FROM kategori JOIN pengeluaran ON 
                pengeluaran.id_kategori=kategori.id_kategori $sqlperiode and 
                kategori.id_kategori=pengeluaran.id_kategori ORDER BY tanggal");
                while ($tampil = mysqli_fetch_array($a)){
        ?>
            <tr>
                <td colspan="4"><?= $tampil['nm_kategori'] ?></td>
            </tr>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= tgl_indo($tampil['tanggal']) ?></td>
                    <td><?= $tampil['item_belanja'] ?></td>
                    <td><?= rupiah($tampil['jumlah']) ?></td>
                </tr>
            <?php
                $total += $tampil['jumlah'];
            } ?>
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