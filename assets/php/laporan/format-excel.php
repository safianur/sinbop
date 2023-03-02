<?php
error_reporting(0);
include '../koneksi.php';
include '../../vendors/autoload.php';
$dari = $_GET['tgl-awal'];
$sampai = $_GET['tgl-akhir'];
$sqlperiode = "WHERE pengeluaran.tanggal BETWEEN '" . $dari . "' AND '" . $sampai . "'";
$periode = "WHERE biaya.tanggal BETWEEN '" . $dari . "' AND '" . $sampai . "'";

use PhpOffice\PhpSpreadsheet\Spreadsheet;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// set default style
$spreadsheet->getDefaultStyle()
    ->getFont()
    ->setName('Arial')
    ->setSize(12);

// set heading
$sheet->setCellValue('A2', 'RINCIAN PENGELUARAN BIAYA OPERASIONAL');
$sheet->setCellValue('A3', 'KANTOR INKA PERWAKILAN BANYUWANGI');
$sheet->setCellValue('A4', 'PERIODE ' . $dari = date('F Y'));
$sheet->getStyle('A1:A4')->getFont()->setBold(true);

// set thead
$sheet->setCellValue('A6', 'NO')
    ->setCellValue('B6', 'TANGGAL')
    ->setCellValue('C6', 'ITEM BELANJA')
    ->setCellValue('D6', 'JUMLAH');
$sheet->getStyle('A6:D6')->getFont()->setBold(true);
$sheet->getStyle('D')->getNumberFormat()->setFormatCode('_("$"* #,##0.00_);_("$"* \(#,##0.00\);_("$"* "-"??_);_(@_)');


// set data
$i = 7;
$q = $i + 1;
$no = 1;
$total = 0;
$biaya = 0;
$subsisa = 0;
$a = mysqli_query($koneksi, "SELECT * FROM kategori");
while ($b = mysqli_fetch_array($a)){
    $sheet->setCellValue('A' . $i, $b['nm_kategori']);
    $c = mysqli_query($koneksi, "SELECT * FROM pengeluaran $sqlperiode and id_kategori='$b[id_kategori]'
        ORDER BY tanggal");
    while ($lp = mysqli_fetch_array($c)){
    $sheet->setCellValue('A' . $q, $no++)
        ->setCellValue('B' . $q, tgl_indo($lp['tanggal']))
        ->setCellValue('C' . $q, $lp['item_belanja'])
        ->setCellValue('D' . $q, $lp['jumlah']);
    $total += $lp['jumlah'];
    $q++;
    $i++;
} };

$lastRow = $q - 1;
// make auto sum
$sheet->setCellValue('A' . $q, 'Total Pengeluaran');
$sheet->setCellValue('D' . $q, '=SUBTOTAL(9,D7:D' . $lastRow . ')');
$sheet->getStyle('A' . $q . ':D' . $q)->getFont()->setBold(true);

$t = $q + 1;
$ambil = mysqli_query($koneksi,"SELECT * FROM biaya $periode");
$tampil = mysqli_fetch_array($ambil);
// make tampil biaya
$sheet->setCellValue('A' . $t, 'BIAYA OPERASIONAL');
$sheet->setCellValue('D' . $t, $tampil['saldo_biaya']);
$sheet->getStyle('A' . $t . ':D' . $t)->getFont()->setBold(true);

// sisa
$s = $t + 1;
$sheet->setCellValue('A' . $s, 'DEVIASI SELISIH LEBIH/KURANG');
$sheet->setCellValue('D' . $s, $tampil['saldo_biaya'] - $total);
$sheet->getStyle('A' . $s . ':D' . $s)->getFont()->setBold(true);
// set style border
$style = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ]
];
$sheet->getStyle('A6:D' . $i)->applyFromArray($style);

// make header and auto download 
$filename = ' REALISASI BIOPS BULAN ' . $dari = date('F Y');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
header('Cache-Control: max-age=0');
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
