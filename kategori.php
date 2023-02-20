<?php 
include 'assets/php/koneksi.php';
include 'sub/header.php';

$no = 1;
$data = mysqli_query($koneksi, "SELECT * FROM kategori");

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
				<h1 style="text-align: center">List Kategori</h1>
				<button type="button" class="btn btn-primary btn-bg-gradient-x-purple-blue box-shadow-2"
					data-toggle="modal" data-target="#tambah"><i class="ft-plus-circle"></i> Tambah Kategori
				</button>
			</div>
			<div class="card-body">
				<table class="table table-bordered zero-configuration" >
					<thead>
					<tr>
						<th>No</th>
						<th>Nama Kategori</th>
						<td style="text-align: center"><i class="ft-settings spinner"></i></td>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($data as $d) :?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $d['nm_kategori']; ?></td>
							<td>
								<button class="btn btn-success btn-sm  btn-bg-gradient-x-blue-green box-shadow-2 gaji-edit"
									data-toggle="modal" data-target="#ubah<?= $d['id_kategori']?>">
									<i class="ft-edit"></i>Edit</button>
								<button class="btn btn-danger btn-sm  btn-bg-gradient-x-red-pink box-shadow-2" 
									data-toggle="modal" data-target="#hapus<?= $d['id_kategori']?>" >
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
				<h3 class="modal-title" id="myModalLabel35"> Tambah Data Kategori</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="assets/php/kategori/aksi-tambah.php">
				<div class="modal-body">
					<fieldset class="form-group floating-label-form-group">
						<label for="kategori">Kategori</label>
						<input type="text" class="form-control" name="nm_kategori" id="kategori" placeholder="nama kategori" autocomplete="off" required>
					</fieldset>
				</div>
				<div class="modal-footer">
					<input type="reset" class="btn btn-secondary btn-bg-gradient-x-red-pink" data-dismiss="modal" value="Tutup">
					<input type="submit" class="btn btn-primary btn-bg-gradient-x-blue-cyan" name="tambah" value="Simpan">
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal ubah -->
<?php foreach ($data as $d) : ?>
	<div class="modal fade text-left" id="ubah<?= $d['id_kategori']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModalLabel35"> Ubah Data Kategori</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="assets/php/kategori/aksi-ubah.php" method="post">
					<input type="hidden" name="id-kategori" value="<?= $d['id_kategori']?>">
					<div class="modal-body" id="updateformkategori">
						<fieldset class="form-group floating-label-form-group">
							<label for="kategori">Kategori</label>
							<input type="text" class="form-control" name="nm_kategori" value="<?= $d['nm_kategori'] ?>" id="kategori" placeholder="kategori" autocomplete="off" required>
						</fieldset>
					</div>
					<div class="modal-footer">
						<input type="reset" class="btn btn-secondary btn-bg-gradient-x-red-pink" data-dismiss="modal" value="Tutup">
						<input type="submit" class="btn btn-primary btn-bg-gradient-x-blue-cyan" name="update" value="Update">
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach ?>

<!-- Modal hapus -->
<?php foreach ($data as $d) : ?>
	<div class="modal fade text-left" id="hapus<?= $d['id_kategori'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModalLabel35"> Yakin Ingin Menghapus Kategori : <?= $d['nm_kategori'] ?> ?</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-footer">
					<input type="reset" class="btn btn-secondary btn-bg-gradient-x-blue-cyan" data-dismiss="modal" value="Tutup">
					<div name="hapuskategori">
						<a href="assets/php/kategori/aksi-hapus.php?id-kategori=<?= $d['id_kategori']; ?>"
							class="btn btn-danger">Hapus</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>

<?php include 'sub/footer.php'; ?>