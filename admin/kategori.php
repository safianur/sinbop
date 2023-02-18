<?php include '../sub/header.php'; ?>

<div class="row">
	<div class="col-md-12">
			<div class="card-header">
				<h1 style="text-align: center">Data Kategori</h1>
				<button type="button" class="btn btn-primary btn-bg-gradient-x-purple-blue box-shadow-2" 
                data-toggle="modal"><i class="ft-plus-circle"></i> Tambah Kategori
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
				
					<tr>
						<td>1</td>
						<td>PDAM, Token Listrik, & Iuran Kebersihan</td>
						<td>

							<button class="btn btn-success btn-sm  btn-bg-gradient-x-blue-green box-shadow-2 gaji-edit"
                                data-toggle="modal" data-target="#ubah" value="<?=$value['jabatan_id']?>">
                                <i class="ft-edit"></i></button>
							<button class="btn btn-danger btn-sm  btn-bg-gradient-x-red-pink box-shadow-2 gaji-hapus" 
                            data-toggle="modal" data-target="#hapus" value="<?=$value['jabatan_id']?>">
                            <i class="ft-trash"></i></button>

						</td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php include '../sub/footer.php'; ?>