<?php
error_reporting(0);
// memanggil library FPDF
require_once '../../vendors/autoload.php';
include '../koneksi.php';
$dari = $_GET['tgl-awal'];
$sampai = $_GET['tgl-akhir'];
$sqlperiode = "WHERE pengeluaran.tanggal BETWEEN '" . $dari . "' AND '" . $sampai . "'";
$periode = "WHERE biaya.tanggal BETWEEN '" . $dari . "' AND '" . $sampai . "'";


// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

// Write some HTML code:
$html = '

<!DOCTYPE html>
<html>
<head>Rincian Biaya Operasional</head>
<style>
body {
    margin: 0;
    font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #000;
    text-align: left;
    background-color: #fff;
  }
  .table {
    width: 100%;
    margin-bottom: 1rem;
    color: #000;
  }
  
  .table th,
  .table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #e3e6f0;
  }
  
  .table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #e3e6f0;
  }
  
  .table tbody + tbody {
    border-top: 2px solid #e3e6f0;
  }
  
  .table-sm th,
  .table-sm td {
    padding: 0.3rem;
  }
  
  .table-bordered {
    border: 1px solid #e3e6f0;
  }
  
  .table-bordered th,
  .table-bordered td {
    border: 1px solid #e3e6f0;
  }
  
  .table-bordered thead th,
  .table-bordered thead td {
    border-bottom-width: 2px;
  }
  
</style>
<body>
    <div style="text-align: center">
        <h3>RINCIAN PENGELUARAN BIAYA OPERASIONAL</h3>
        <h3>KANTOR INKA PERWAKILAN BANYUWANGI</h3>
        <h5>Periode ' . $dari = date('F Y') . '</h5>
    </div>
    <hr>';
    $html.=
    '<table class="table table-bordered" width="100%" cellspacing="0">
      <thead>
          <tr class="thead">
              <th style="text-transform: uppercase;">No</th>
              <th style="text-transform: uppercase;">TANGGAL</th>
              <th style="text-transform: uppercase;">ITEM BELANJA</th>
              <th style="text-transform: uppercase;">JUMLAH</th>
          </tr>
      </thead>
      <tbody>';
            $no = 1;
            $a = mysqli_query($koneksi, "SELECT * FROM kategori");
            while ($b = mysqli_fetch_array($a)){
            $html .= 
                '<tr>
                    <td colspan="4">' . $b['nm_kategori'] . '</td>
                </tr>';
            $c = mysqli_query($koneksi, "SELECT * FROM pengeluaran $sqlperiode and id_kategori='$b[id_kategori]' 
              ORDER BY tanggal");
            while ($lp = mysqli_fetch_array($c)){ 
            $html .=
                '<tr>
                    <td>' . $no++ . '</td>
                    <td>' . tgl_indo($lp['tanggal']) . '</td>
                    <td>' . $lp['item_belanja'] . '</td>
                    <td>' . rupiah($lp['jumlah']) . '</td>
                </tr>';
            $total += $lp['jumlah'];
            } }
            $html .=
                '<tr>
                    <td colspan="3" style="text-align: right; font-weight: bold; text-transform: uppercase;">TOTAL BELANJA</td>
                    <td style="font-weight: bold;">' . rupiah($total) . '</td>
                </tr>';
                    $ambil = mysqli_query($koneksi,"SELECT * FROM biaya $periode");
                    $tampil = mysqli_fetch_array($ambil);
                $html.=
                '<tr>
                    <td colspan="3" style="text-align: right; font-weight: bold; text-transform: uppercase;">BIAYA OPERASIONAL</td>
                    <td style="font-weight: bold;">' . rupiah($tampil['saldo_biaya']) . '</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right; font-weight: bold; text-transform: uppercase;">DEVIASI SELISIH LEBIH/KURANG</td>
                    <td style="font-weight: bold;">' . rupiah($tampil['saldo_biaya']-$total) . '</td>
                </tr>
        </tbody>
    </table>';
$html .= '</body>
</html>
';

$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output();
 
?>