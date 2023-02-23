<?php
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
$sheet->setCellValue('A3', 'PT CIPTA KARYA BAGUSKANTOR INKA PERWAKILAN BANYUWANGI');
$sheet->setCellValue('A4', 'PERIODE ' . tgl_indo($dari('y')));
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
$no = 1;
$total = 0;
$biaya = 0;
$subsisa = 0;
$a = mysqli_query($koneksi, "SELECT * FROM kategori");
while ($b = mysqli_fetch_array($a)){
    $sheet->setCellValue('A' . $i, $b['nm_kategori']);
    $c = mysqli_query($koneksi, "SELECT * FROM pengeluaran $sqlperiode and id_kategori='$b[id_kategori]' ORDER BY tanggal");
    while ($lp = mysqli_fetch_array($c)){
    $sheet->setCellValue('A' . $i, $no++)
        ->setCellValue('B' . $i, $lp['nm_kegiatan'])
        ->setCellValue('C' . $i, $lp['nm_kategori'])
        ->setCellValue('D' . $i, $lp['nm_kode'])
        ->setCellValue('K' . $i, $lp['biaya_pengeluaran']);
    $total += $lp['biaya_pengeluaran'];
    $i++;
} };
$ambil = mysqli_query($koneksi,"SELECT * FROM biaya $periode");
$tampil = mysqli_fetch_array($ambil);

// set auto filter
$firstRow = 6;
$lastRow = $i - 1;
$sheet->setAutoFilter('A' . $firstRow . ':D' . $lastRow);

// make auto sum
$sheet->setCellValue('A' . $i, 'Total Belanja');
$sheet->setCellValue('K' . $i, '=SUBTOTAL(9,K7:K' . $lastRow . ')');
$sheet->getStyle('A' . $i . ':K' . $i)->getFont()->setBold(true);

// sisa
$s = $i + 1;
$sheet->setCellValue('A' . $s, 'Sisa Dana dari Keseluruhan Proyek');
$sheet->setCellValue('K' . $s, $biaya);
$sheet->getStyle('A' . $s . ':K' . $s)->getFont()->setBold(true);
// set style border
$style = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ]
];
$sheet->getStyle('A6:K' . $i)->applyFromArray($style);

// make header and auto download 
$filename = 'LPDP ' . tgl_indo($dari) . '-' . tgl_indo($sampai);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
header('Cache-Control: max-age=0');
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
