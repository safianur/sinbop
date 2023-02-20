<?php 
include 'assets/php/koneksi.php';
include 'sub/header.php';

$no = 1;
$data = mysqli_query($koneksi, "SELECT * FROM biaya");
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
				<h1 style="text-align: center">Saldo Biaya Operasional</h1>
				<button type="button" class="btn btn-primary btn-bg-gradient-x-purple-blue box-shadow-2" 
                	data-toggle="modal" data-target="#tambah"><i class="ft-plus-circle"></i> Tambah Saldo
				</button>
			</div>
			<div class="card-body">
				<table class="table table-bordered zero-configuration" >
					<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Saldo Biaya Operasional</th>
						<td style="text-align: center"><i class="ft-settings spinner"></i></td>
					</tr>
					</thead>
					<tbody>
					<?php foreach($data as $d) : ?>
					<tr>
						<td><?= $no++ ?></td>
                        <td><?= tgl_indo ($d['tanggal']) ?></td>
						<td><?= rupiah ($d['saldo_biaya']) ?></td>
						<td>

							<button class="btn btn-success btn-sm  btn-bg-gradient-x-blue-green box-shadow-2 gaji-edit"
                                data-toggle="modal" data-target="#ubah<?=$d['id_biaya']?>" value="">
                                <i class="ft-edit"></i>Edit</button>
							<button class="btn btn-danger btn-sm  btn-bg-gradient-x-red-pink box-shadow-2 gaji-hapus" 
                            data-toggle="modal" data-target="#hapus<?=$d['id_biaya']?>" value="">
                            <i class="ft-trash"></i>Hapus</button>

						</td>
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
				<h3 class="modal-title" id="myModalLabel35"> Tambah Saldo Biaya Operasional</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="assets/php/biaya/aksi-tambah.php" method="post">
				<div class="modal-body">
					<fieldset class="form-group floating-label-form-group">
						<label for="tgl">Tanggal</label>
						<div class='input-group'>
							<input type="date" class="form-control" name="tanggal" id="tgl" placeholder="Tanggal"
								autocomplete="off" required>
							<div class="input-group-append">
								<span class="input-group-text">
									<span class="ft-calendar"></span>
								</span>
							</div>
						</div>
					</fieldset>
					<fieldset class="form-group floating-label-form-group">
						<label for="saldo">Biaya Operasional</label>
						<input type="text" class="form-control" name="saldo_biaya" id="biaya" placeholder="saldo biaya operasional" autocomplete="off" required>
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
	<div class="modal fade text-left" id="ubah<?=$d['id_biaya']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModalLabel35"> Update Saldo Biaya Operasional</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="assets/php/biaya/aksi-ubah.php" method="post">
					<input type="hidden" name="id-biaya" value="<?= $d['id_biaya']?>">
					<div class="modal-body">
						<input type="hidden" name="id-kategori" value="<?= $d['id_biaya']?>">
						<fieldset class="form-group floating-label-form-group">
							<label for="tgl">Tanggal</label>
							<div class='input-group'>
								<input type="date" class="form-control" name="tanggal" value="<?= $d['tanggal'] ?>"
									id="tgl" placeholder="Tanggal" autocomplete="off" required>
								<div class="input-group-append">
									<span class="input-group-text">
										<span class="ft-calendar"></span>
									</span>
								</div>
							</div>
						</fieldset>
						<fieldset class="form-group floating-label-form-group">
							<label for="saldo">Biaya Operasional</label>
							<input type="text" class="form-control" name="saldo_biaya" value="<?= $d['saldo_biaya'] ?>"
								id="biaya" placeholder="saldo biaya operasional" autocomplete="off" required>
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
	<div class="modal fade text-left" id="hapus<?=$d['id_biaya']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModalLabel35"> 
						Yakin Ingin Menghapus Saldo Biaya Operasional Tanggal : <?= tgl_indo ($d['tanggal']) ?> ?</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
					<div class="modal-footer">
						<input type="reset" class="btn btn-secondary btn-bg-gradient-x-blue-cyan" data-dismiss="modal" value="Tutup">
						<div id="hapusbiaya">
						<a href="assets/php/biaya/aksi-hapus.php?id-biaya=<?= $d['id_biaya']; ?>"
							class="btn btn-danger">Hapus</a>
						</div>
					</div>
			</div>
		</div>
	</div>
<?php endforeach ?>

<?php include 'sub/footer.php'; ?>