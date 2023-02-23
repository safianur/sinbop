$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$periode = "SELECT * FROM pengeluaran WHERE month(tanggal)='$bulan' and year(tanggal)='$tahun'";

<div class="col-4">
										<label for="tahun">Tahun</label>
										<select name="tahun" class="form-control">
											<?php
											$mulai= date('Y') - 50;
											for($i = $mulai;$i<$mulai + 100;$i++){
												$sel = $i == date('Y') ? ' selected="selected"' : '';
												echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
											}
											?>
										</select>
									</div>
									<div class="col-4">
										<label for="bulan">Bulan</label>
										<select name="bulan" class="form-control">
											<option value="01">Januari</option>
											<option value="02">Februari</option>
											<option value="03">Maret</option>
											<option value="04">April</option>
											<option value="05">Mei</option>
											<option value="06">Juni</option>
											<option value="07">Juli</option>
											<option value="08">Agustus</option>
											<option value="09">September</option>
											<option value="10">Oktober</option>
											<option value="11">November</option>
											<option value="12">Desember</option>
										</select>
									</div>