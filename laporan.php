<?php 
error_reporting(0);
include 'assets/php/koneksi.php';
include 'sub/header.php';

$dari = '';
$sampai = '';
$sqlperiode = '';

if (!empty($_POST['dari']) && !empty($_POST['sampai'])) {
    $dari       = isset($_POST['dari']) ? $_POST['dari'] : date('Y-m') . "-01";
    $sampai     = isset($_POST['sampai']) ? $_POST['sampai'] : date('Y-m-d');
    $sqlperiode = "WHERE pengeluaran.tanggal BETWEEN '" . $dari . "' AND '" . $sampai . "'";
    $periode = "WHERE biaya.tanggal BETWEEN '" . $dari . "' AND '" . $sampai . "'";
}
?>

<style type="text/css">
	.kotak {
		padding: 5px;
	}

	@page {
		size: A4;
		margin: 0;
	}

	@media print {
		body * {
			visibility: hidden;
		}

		.kotak, .kotak * {
			visibility: visible;
		}

		.kotak {
			z-index: 2;
			position: absolute;
			width: 100%;
			top: 0;
			left: 0;
		}
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="card box-shadow-2">
			<div class="card-header">
				<h1 style="text-align: center">Laporan Rincian Pengeluaran Biaya Operasional</h1>
			</div>
			<div class="card-body">
				<div>
					<fieldset class="form-group floating-label-form-group">
						<div class="row mt-2">
							<div class="col-sm-8 mb-1">
								<form action="" method="post" class="form-group row">
									<div class="col-3">
										<label for="dari">Dari</label>	
										<input type="date" class="form-control" id="dari" name="dari">
									</div>
									<div class="col-3">
										<label for="sampai">Sampai</label>
										<input type="date" class="form-control" id="sampai" name="sampai">
									</div>
									<div class="col-2">
										<label for="laporan" style="color: white">asdasd</label>
										<button class="btn btn-primary btn-block btn-bg-gradient-x-blue-cyan" name="lihat">Lihat</button>
									</div>
								</form>
							</div>
							<div class="col-sm-4 mb-2"><br>
								<a href="assets/php/laporan/format-excel.php?tgl-awal=<?= $dari ?>&tgl-akhir=<?= $sampai ?>" class="btn btn-success mr-2" style="float:right" target="_blank"><i class="fa-solid fa-file-excel"></i></a>
								<a href="assets/php/laporan/format-pdf.php?tgl-awal=<?= $dari ?>&tgl-akhir=<?= $sampai ?>" class="btn btn-danger mr-2" style="float:right" target="_blank"><i class="fa-solid fa-file-pdf"></i></a>
							</div>
						</div>
					</fieldset>
				</div>
				<hr>
				<div class="card-body" id="tampil">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Item Belanja</th>
								<th>Jumlah</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if (!empty($_POST['dari']) && !empty($_POST['sampai'])) {
									$no = 1;
									$a = mysqli_query($koneksi, "SELECT * FROM kategori");
									while ($b = mysqli_fetch_array($a)){
							?>
								<tr>
									<td colspan="4"><?= $b['nm_kategori'] ?></td>
								</tr>
								<?php
									$c = mysqli_query($koneksi, "SELECT * FROM pengeluaran $sqlperiode and id_kategori='$b[id_kategori]' ORDER BY tanggal");
									while ($lp = mysqli_fetch_array($c)){
								?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= tgl_indo($lp['tanggal']) ?></td>
										<td><?= $lp['item_belanja'] ?></td>
										<td><?= rupiah($lp['jumlah']) ?></td>
									</tr>
								<?php
									$total += $lp['jumlah'];
								} } ?>
							<tr>
								<td colspan="3" class="font-weight-bold text-uppercase">Total Belanja</td>
								<td class="font-weight-bold"><?= rupiah($total) ?></td>
							</tr>
							
							<tr>
								<td colspan="3" class="font-weight-bold text-uppercase">Biaya Operasional</td>
								<?php
										$ambil = mysqli_query($koneksi,"SELECT * FROM biaya $periode");
										$tampil = mysqli_fetch_array($ambil);
								?>
								<td class="font-weight-bold"><?= rupiah($tampil['saldo_biaya']) ?></td>
							</tr>
							<tr>
								<td colspan="3" class="font-weight-bold text-uppercase">Deviasi Selisih Lebih/Kurang</td>
								<td class="font-weight-bold"><?= rupiah($tampil['saldo_biaya']-$total) ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'sub/footer.php'; ?>