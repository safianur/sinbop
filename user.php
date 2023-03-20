<?php 
session_start();

if(!isset($_SESSION['username'])){
	header("Location: index.php");
}

include 'assets/php/koneksi.php';
include 'sub/header.php';

$no = 1;
$data = mysqli_query($koneksi, "SELECT * FROM user");

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
					<h1 style="text-align: center">Daftar Pengguna Akun</h1>
				</div>
			<div class="card-body">
				<table class="table table-bordered zero-configuration" >
					<thead>
					<tr>
						<th>No</th>
						<th>Username</th>
					<?php if($_SESSION['level_user'] == "Admin") { ?>
						<td style="text-align: center"><i class="ft-settings spinner"></i></td>
					<?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($data as $d) :?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $d['username']; ?></td>
						<?php if($_SESSION['level_user'] == "Admin") { ?>
							<td>
								<button class="btn btn-success btn-sm  btn-bg-gradient-x-blue-green box-shadow-2 gaji-edit"
									data-toggle="modal" data-target="#ubah<?= $d['id_user']?>">
									<i class="ft-edit"></i>Edit</button>
								<button class="btn btn-danger btn-sm  btn-bg-gradient-x-red-pink box-shadow-2" 
									data-toggle="modal" data-target="#hapus<?= $d['id_user']?>" >
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

<!-- Modal ubah -->
<?php foreach ($data as $d) : ?>
	<div class="modal fade text-left" id="ubah<?= $d['id_user']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModalLabel35"> Ubah Data Kategori</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="assets/php/user/aksi-ubah.php" method="post">
					<input type="hidden" name="id-user" value="<?= $d['id_user']?>">
					<div class="modal-body" id="updateformuser">
						<fieldset class="form-group floating-label-form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" name="username" value="<?= $d['username'] ?>" id="username" placeholder="username" autocomplete="off" required>
							<label for="password">Password</label>
							<input type="text" class="form-control" name="password" value="<?= $d['password'] ?>" id="password" placeholder="password" autocomplete="off" required>
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
	<div class="modal fade text-left" id="hapus<?= $d['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModalLabel35"> Yakin Ingin Menghapus User : <?= $d['username'] ?> ?</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-footer">
					<input type="reset" class="btn btn-secondary btn-bg-gradient-x-blue-cyan" data-dismiss="modal" value="Tutup">
					<div name="hapususer">
						<a href="assets/php/user/aksi-hapus.php?id-user=<?= $d['id_user']; ?>"
							class="btn btn-danger">Hapus</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>

<?php include 'sub/footer.php'; ?>