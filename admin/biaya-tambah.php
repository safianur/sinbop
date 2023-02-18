<?php include 'sub/header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="card">
				<div class="alert alert-success alert-dismissible animated fadeInDown" id="feedback" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					Data berhasil ditambahkan
				</div>
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
				<div class="modal-body">
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
                    </fieldset>
					<fieldset class="form-group floating-label-form-group">
						<label for="kategori">Saldo Biaya Operasional</label>
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

<?php include 'sub/footer.php'; ?>