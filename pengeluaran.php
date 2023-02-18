<?php include 'sub/header.php'; ?>

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
				<h1 style="text-align: center">Data Rincian Biaya Operasional</h1>
				<button type="button" class="btn btn-primary btn-bg-gradient-x-purple-blue box-shadow-2" 
                data-toggle="modal" data-target="#tambah"><i class="ft-plus-circle"></i> Tambah Nota
				</button>
			</div>
			<div class="card-body">
				<table class="table table-bordered zero-configuration" >
					<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Item Belanja</th>
						<th>Jumlah</th>
						<td style="text-align: center"><i class="ft-settings spinner"></i></td>
					</tr>
					</thead>
					<tbody>
				
					<tr>
						<td>1</td>
                        <td>05 Feb 2023</td>
                        <td>Pertalite Motor</td>
						<td>Rp. 20.000</td>
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

<!-- Modal tambah -->
<div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel35"> Tambah Rincian Biaya Operasional</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
				<div class="modal-body">
                    <fieldset class="form-group floating-label-form-group">
						<label for="kategori">Kategori</label>
						<!-- <input type="text" class="form-control" name="kategori" id="kategori" placeholder="kategori" autocomplete="off" required> -->
						<select name="bulan" id="laporan-bulan" class="form-control">
							<option value="01">PDAM, Token Listrik, & Iuran Kebersihan</option>
							<option value="01">Pembelian Bahan Bakar Bensin</option>
						</select>
					</fieldset>
                    <fieldset class="form-group floating-label-form-group">
                        <label for="tl">Tanggal</label>
                        <div class='input-group'>
                            <input type="date" class="form-control" name="tanggal_lahir" id="tl" placeholder="Tanggal Lahir"
                                autocomplete="off" required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <span class="ft-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </fieldset><fieldset class="form-group floating-label-form-group">
						<label for="kategori">Item Belanja</label>
						<input type="text" class="form-control" name="kategori" id="kategori" placeholder="kategori" autocomplete="off" required>
					</fieldset>
					<fieldset class="form-group floating-label-form-group">
						<label for="kategori">Jumlah</label>
						<input type="text" class="form-control" name="kategori" id="kategori" placeholder="kategori" autocomplete="off" required>
					</fieldset>
				</div>
				<div class="modal-footer">
					<input type="reset" class="btn btn-secondary btn-bg-gradient-x-red-pink" data-dismiss="modal" value="Tutup">
					<input type="submit" class="btn btn-primary btn-bg-gradient-x-blue-cyan" name="simpan" value="Simpan">
				</div>
		</div>
	</div>
</div>

<!-- Modal ubah -->
<div class="modal fade text-left" id="ubah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel35"> Update Rincian Biaya Operasional</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
				<div class="modal-body">
                    <fieldset class="form-group floating-label-form-group">
						<label for="kategori">Kategori</label>
						<!-- <input type="text" class="form-control" name="kategori" id="kategori" placeholder="kategori" autocomplete="off" required> -->
						<select name="bulan" id="laporan-bulan" class="form-control">
							<option value="01">PDAM, Token Listrik, & Iuran Kebersihan</option>
							<option value="01">Pembelian Bahan Bakar Bensin</option>
						</select>
					</fieldset>
                    <fieldset class="form-group floating-label-form-group">
                        <label for="tl">Tanggal</label>
                        <div class='input-group'>
                            <input type="date" class="form-control" name="tanggal_lahir" id="tl" placeholder="Tanggal Lahir"
                                autocomplete="off" required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <span class="ft-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </fieldset><fieldset class="form-group floating-label-form-group">
						<label for="kategori">Item Belanja</label>
						<input type="text" class="form-control" name="kategori" id="kategori" placeholder="kategori" autocomplete="off" required>
					</fieldset>
					<fieldset class="form-group floating-label-form-group">
						<label for="kategori">Jumlah</label>
						<input type="text" class="form-control" name="kategori" id="kategori" placeholder="kategori" autocomplete="off" required>
					</fieldset>
				</div>
				<div class="modal-footer">
					<input type="reset" class="btn btn-secondary btn-bg-gradient-x-red-pink" data-dismiss="modal" value="Tutup">
					<input type="submit" class="btn btn-primary btn-bg-gradient-x-blue-cyan" name="simpan" value="Simpan">
				</div>
		</div>
	</div>
</div>

<!-- Modal hapus -->
<div class="modal fade text-left" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel35"> Hapus Nota Pengeluaran ?</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
				<div class="modal-footer">
					<input type="reset" class="btn btn-secondary btn-bg-gradient-x-blue-cyan" data-dismiss="modal" value="Tutup">
					<div id="hapusgaji">

					</div>
				</div>
		</div>
	</div>
</div>

<?php include 'sub/footer.php'; ?>