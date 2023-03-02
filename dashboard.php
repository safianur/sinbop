<?php 
session_start();

if(!isset($_SESSION['username'])){
	header("Location: index.php");
};

include 'sub/header.php';
include 'assets/php/koneksi.php';

$month = date('m');
$year = date('Y');
?>

<!-- <div class="card">
	<div class="alert alert-success alert-dismissible animated fadeInDown"
			style="position: absolute; width: 100%; z-index: 2" id="feedback"
			role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		Berhasil Login
	</div>
	<div class="alert alert-warning alert-dismissible animated fadeInDown"
			style="position: absolute; width: 100%; z-index: 2" id="feedback"
			role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		Sudah Login
	</div>
</div> -->
<!-- Content Row -->
<div class="row">
	<?php
		$ambil = mysqli_query($koneksi,"SELECT COUNT(item_belanja) as item FROM pengeluaran WHERE month(tanggal) = $month AND year(tanggal) = $year");
		$itembelanja = mysqli_fetch_array($ambil);
	?>
	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-5">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
							Jumlah Item Belanja Bulan <?= date('F') ?></div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $itembelanja['item'] ?> Item Belanja</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-calendar fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		$ambil = mysqli_query($koneksi,"SELECT * FROM biaya WHERE month(tanggal) = $month AND year(tanggal) = $year");
		$biaya = mysqli_fetch_array($ambil);
	?>
	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-5">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
							Biaya Operasional (<?= date('M') ?>)</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?= rupiah($biaya['saldo_biaya']) ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
		$ambil = mysqli_query($koneksi,"SELECT SUM(pengeluaran.jumlah) as total FROM pengeluaran
			WHERE month(tanggal) = $month AND year(tanggal) = $year");
		$pengeluaran = mysqli_fetch_array($ambil);
	?>
	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-5">
		<div class="card border-left-info shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pengeluaran (<?= date('M') ?>)
						</div>
						<div class="row no-gutters align-items-center">
							<div class="col-auto">
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= rupiah($pengeluaran['total']) ?></div>
							</div>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Pending Requests Card Example -->
	<div class="col-xl-3 col-md-6 mb-5">
		<div class="card border-left-warning shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
							Deviasa Selisih (<?= date('M') ?>)</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?= rupiah($biaya['saldo_biaya']-$pengeluaran['total']) ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-comments fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<figure class="highcharts-figure">
	<div id="pengeluaran"></div>
	<p class="highcharts-description">
	</p>
</figure>

<?php include 'sub/footer.php'; ?>