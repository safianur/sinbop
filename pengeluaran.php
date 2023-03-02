<?php
session_start();

if(!isset($_SESSION['username'])){
	header("Location: index.php");
}

include 'assets/php/koneksi.php';
include 'sub/header.php';

$no = 1;
$data = mysqli_query($koneksi, "SELECT * FROM pengeluaran JOIN kategori ON kategori.id_kategori=pengeluaran.id_kategori");
?>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<!-- <div class="alert alert-success alert-dismissible animated fadeInDown" id="feedback" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				Data berhasil ditambahkan
			</div>
			<div class="alert alert-success alert-dismissible animated fadeInDown" id="feedback" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				Data berhasil diupdate
			</div>
			<div class="alert alert-success alert-dismissible animated fadeInDown" id="feedback" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				Data berhasil dihapus
			</div> -->
			<div class="card-header">
				<h1 style="text-align: center">Rincian Pengeluaran Biaya Operasional</h1>
			<?php if($_SESSION['level_user'] == "Admin") { ?>
				<button type="button" class="btn btn-primary btn-bg-gradient-x-purple-blue box-shadow-2" 
                	data-toggle="modal" data-target="#tambah"><i class="ft-plus-circle"></i> Tambah Nota
				</button>
			<?php } ?>
			</div>
			<div class="card-body">
				<table class="table table-bordered zero-configuration" width="100%" cellspacing="0">
					<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Nama Pembelanja</th>
						<th>Kategori</th>
						<th>Item Belanja</th>
						<th>Jumlah</th>
					<?php if($_SESSION['level_user'] == "Admin") { ?>
						<td style="text-align: center"><i class="ft-settings spinner"></i></td>
					<?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($data as $d) : ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= tgl_indo($d['tanggal']) ?></td>
							<td><?=  $d['nm_pembelanja'] ?></td>
							<td><?=  $d['nm_kategori'] ?></td>
							<td><?=  $d['item_belanja'] ?></td>
							<td><?= rupiah ($d['jumlah']) ?></td>
						<?php if($_SESSION['level_user'] == "Admin") { ?>
							<td>

								<button class="btn btn-success btn-sm  btn-bg-gradient-x-blue-green box-shadow-2 gaji-edit"
									data-toggle="modal" data-target="#ubah<?=$d['id_pengeluaran']?>" value="">
									<i class="ft-edit"></i>Edit</button>
								<button class="btn btn-danger btn-sm  btn-bg-gradient-x-red-pink box-shadow-2 gaji-hapus" 
								data-toggle="modal" data-target="#hapus<?=$d['id_pengeluaran']?>" value="">
								<i class="ft-trash"></i>Hapus</button>
							</td>
						<?php } ?>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal tambah -->
<div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel35"> Tambah Rincian Pengeluaran</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="assets/php/pengeluaran/aksi-tambah.php" method="post">
				<div class="modal-body">
                    <fieldset class="form-group floating-label-form-group">
						<label for="kategori">Kategori</label>
						<select name="kategori" id="kategori" class="form-control">
							<option>Pilih Kategori</option>
							<?php
                                $k = mysqli_query($koneksi,"SELECT * FROM kategori");
								while ($ambil = mysqli_fetch_array($k)){
							?>
							<option value="<?= $ambil['id_kategori'] ?>"><?= $ambil['nm_kategori'] ?></option>
							<?php } ?>
						</select>
					</fieldset>
                    <fieldset class="form-group floating-label-form-group">
                        <label for="tgl">Tanggal</label>
                        <div class='input-group'>
                            <input type="date" class="form-control" name="tanggal" id="tgl" placeholder="Tanggal Lahir"
                                autocomplete="off" required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <span class="ft-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </fieldset>
					<fieldset class="form-group floating-label-form-group">
						<label for="pembelanja">Nama Pembelanja</label>
						<input type="text" class="form-control" name="nm_pembelanja" id="pembelanja" placeholder="nama pembelanja" autocomplete="off" required>
					</fieldset>
					<fieldset class="form-group floating-label-form-group">
						<label for="item">Item Belanja</label>
						<input type="text" class="form-control" name="item_belanja" id="item" placeholder="item belanja" autocomplete="off" required>
					</fieldset>
					<fieldset class="form-group floating-label-form-group">
						<label for="jumlah">Jumlah</label>
						<input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="jumlah" autocomplete="off" required>
					</fieldset>
				</div>
				<div class="modal-footer">
					<input type="reset" class="btn btn-secondary btn-bg-gradient-x-red-pink" data-dismiss="modal" value="Tutup">
					<input type="submit" class="btn btn-primary btn-bg-gradient-x-blue-cyan" name="simpan" value="Simpan">
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal ubah -->
<?php foreach ($data as $d) : ?>
	<div class="modal fade text-left" id="ubah<?=$d['id_pengeluaran']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModalLabel35"> Update Rincian Pengeluaran</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="assets/php/pengeluaran/aksi-ubah.php" method="post">
					<input type="hidden" name="id-pengeluaran" value="<?= $d['id_pengeluaran']?>">
					<div class="modal-body">
						<fieldset class="form-group floating-label-form-group">
							<label for="kategori">Kategori</label>
							<!-- <input type="text" class="form-control" name="kategori" id="kategori" placeholder="kategori" autocomplete="off" required> -->
							<select name="kategori" id="kategori" class="form-control">
								<option>Pilih Kategori</option>
								<?php
                                $k = mysqli_query($koneksi,"SELECT * FROM kategori");
								while ($ambil = mysqli_fetch_array($k)){
								?>
								<option value="<?= $ambil['id_kategori'] ?>" <?php
                                                                                if ($ambil['id_kategori'] == $d['id_kategori']) {
                                                                                    echo "selected";
                                                                                }
                                                                                ?>><?= $ambil['nm_kategori'] ?></option>
								<?php } ?>
							</select>
						</fieldset>
						<fieldset class="form-group floating-label-form-group">
							<label for="tgl">Tanggal</label>
							<div class='input-group'>
								<input type="date" class="form-control" name="tanggal" id="tgl" placeholder="Tanggal Lahir"
									value="<?= $d['tanggal'] ?>" autocomplete="off" required>
								<div class="input-group-append">
									<span class="input-group-text">
										<span class="ft-calendar"></span>
									</span>
								</div>
							</div>
						</fieldset>
						<fieldset class="form-group floating-label-form-group">
							<label for="pembelanja">Nama Pembelanja</label>
							<input type="text" class="form-control" name="nm_pembelanja" id="pembelanja"
								placeholder="nama pembelanja" value="<?= $d['nm_pembelanja'] ?>" autocomplete="off" required>
						</fieldset>
						<fieldset class="form-group floating-label-form-group">
							<label for="item">Item Belanja</label>
							<input type="text" class="form-control" name="item_belanja" id="item" placeholder="item belanja"
								value="<?= $d['item_belanja'] ?>" autocomplete="off" required>
						</fieldset>
						<fieldset class="form-group floating-label-form-group">
							<label for="jumlah">Jumlah</label>
							<input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="jumlah"
								value="<?= $d['jumlah'] ?>" autocomplete="off" required>
						</fieldset>
					</div>
					<div class="modal-footer">
						<input type="reset" class="btn btn-secondary btn-bg-gradient-x-red-pink" data-dismiss="modal" value="Tutup">
						<input type="submit" class="btn btn-primary btn-bg-gradient-x-blue-cyan" name="simpan" value="Simpan">
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach ?>

<!-- Modal hapus --> 
<?php foreach ($data as $d) : ?>
	<div class="modal fade text-left" id="hapus<?=$d['id_pengeluaran']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModalLabel35"> Yakin Ingin Mengahapus Pengeluaran Biaya : <?= $d['item_belanja'] ?> ?</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-footer">
					<input type="reset" class="btn btn-secondary btn-bg-gradient-x-blue-cyan" data-dismiss="modal" value="Tutup">
					<div name="hapuspengeluaran">
						<a href="assets/php/pengeluaran/aksi-hapus.php?id-pengeluaran=<?= $d['id_pengeluaran']; ?>"
							class="btn btn-danger">Hapus</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>

<?php include 'sub/footer.php'; ?>