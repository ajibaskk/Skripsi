<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="card card-stats">
					<div class="card-header card-header-warning card-header-icon">
						<div class="card-icon">
							<i class="material-icons">content_copy</i>
						</div>
						<p class="card-category">Posisi Jendela</p>
						<h3 class="card-title" id=posisijendela></h3>
						<button type="button" id="buka_jendela" style="display:none">Buka</button>
						<button type="button" id="tutup_jendela" style="display:none">Tutup</button>
					</div>
					<div class="card-footer">
						<div class="stats">
							<i class="material-icons text-danger">warning</i>
							<a href="#" onclick="operasi()">Ganti Operasi</a>
							<input type="hidden" id="status_sekarang">

						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="card card-stats">
					<div class="card-header card-header-success card-header-icon">
						<div class="card-icon">
							<i class="material-icons">gesture</i>
						</div>
						<p class="card-category">Kecepatan Angin</p>
						<h3 class="card-title" id="kecepatanangin"></h3>
					</div>
					<div class="card-footer">
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="card card-stats">
					<div class="card-header card-header-danger card-header-icon">
						<div class="card-icon">
							<i class="material-icons">wb_cloudy</i>
						</div>
						<p class="card-category">Status Hujan</p>
						<h3 class="card-title" id="statushujan"></h3>
					</div>
					<div class="card-footer">
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="card card-stats">
					<div class="card-header card-header-info card-header-icon">
						<div class="card-icon">
							<i class="material-icons">ac_unit</i>
						</div>
						<p class="card-category">Suhu & Kelembaban Kamar</p>
						<h3 class="card-title" id="suhukelembaban"></h3>
					</div>
					<div class="card-footer">
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header card-header-info" id="card_header_1">
						<h4 class="card-title" id="status_operasi_header">Operasi</h4>
						<p class="card-category"></p>
					</div>
					<div class="card-body" style="display:none;" id="card_body_1">
						<div class="row" id="card_body_2">
							<?php if ($jendela) :
								$i = 1;
								foreach ($jendela as $row) : ?>
									<div class="col-lg-3 col-md-6 col-sm-6">
										<div class="card card-stats">
											<div class="card-header card-header-info card-header-icon">
												<div class="card-icon">
													<i class="material-icons">content_copy</i>
												</div>
												<p class="card-category">Jendela <?= $row['id'] ?></p>
												<h3 class="card-title" id="status_jendela_<?= $row['id'] ?>"></h3>
											</div>
											<div class="card-footer d-flex justify-content-end">
												<button type="button" class="btn btn-md btn-success" id="buka_jendela_<?= $row['id'] ?>" style="display:block" onclick="bukaJendela('<?= $row['id'] ?>')">Buka</button>
												<button type="button" class="btn btn-md btn-danger" id="tutup_jendela_<?= $row['id'] ?>" style="display:none" onclick="tutupJendela('<?= $row['id'] ?>')">Tutup</button>
											</div>
										</div>
									</div>
							<?php endforeach;
							endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header card-header-warning">
						<h4 class="card-title">Data Sensor</h4>
						<p class="card-category">Data ini merupakan 5 update data sensor terakhir</p>
					</div>
					<div class="card-body table-responsive">
						<table class="table table-hover">
							<thead class="text-warning">

								<th>Waktu</th>
								<th>Tanggal</th>
								<th>Kecepatan Angin</th>
								<th>Status Hujan</th>
								<th>Suhu Kamar</th>
								<th>Kelembaban Kamar</th>
							</thead>
							<tbody id="datasensor">
								<tr>

									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var posisijendela = document.getElementById('posisijendela');
	var buka_jendela = document.getElementById('buka_jendela');
	var tutup_jendela = document.getElementById('tutup_jendela');
	var kecepatanangin = document.getElementById('kecepatanangin');
	var statushujan = document.getElementById('statushujan');
	var suhukelembaban = document.getElementById('suhukelembaban');
	$(document).ready(function() {
		setInterval(function() {
			$.ajax({
				url: "<?php echo base_url(); ?>Dashboard/ambilDataSensor",
				dataType: 'json',
				success: function(data) {

					if (data != false) {
						$.each(data, function(key, val) {
							if (val.statushujan == 0) {
								var status_hujan = "Tidak Hujan";
							} else if (val.statushujan == 1) {
								var status_hujan = "Hujan";
							}
							kecepatanangin.innerHTML = val.kecepatanangin;
							statushujan.innerHTML = status_hujan;
							suhukelembaban.innerHTML = val.suhu + " & " + val.kelembaban;

						});
					} else {
						kecepatanangin.innerHTML = "Data Tidak Ditemukan";
						statushujan.innerHTML = "Data Tidak Ditemukan";
						suhukelembaban.innerHTML = "Data Tidak Ditemukan";
					}
				}
			});
			$.ajax({
				url: "<?php echo base_url(); ?>Dashboard/ambilDataJendela",
				dataType: 'json',
				success: function(data) {
					if (data != "Manual") { // Otomatis
						if (data != "Tidak Ditemukan") {
							if (data == 0) {
								var posisi_jendela = "Tertutup";
							} else if (data == 1) {
								var posisi_jendela = "Terbuka";
							}
							posisijendela.innerHTML = posisi_jendela;
						} else {
							posisijendela.innerHTML = "Data Tidak Ditemukan";
						}

					} else { // Manual
						posisijendela.innerHTML = "Operasi Manual";
					}
				}
			});
			$.ajax({
				url: "<?php echo base_url(); ?>Dashboard/ambilStatusJendela",
				dataType: 'json',
				success: function(data) {

					if (data != false) {
						$.each(data, function(key, val) {
							var status = val.status;
							var status_jendela_id = "status_jendela_" + val.id;
							var buka_jendela_id = "buka_jendela_" + val.id;
							var tutup_jendela_id = "tutup_jendela_" + val.id;
							if (status == 1) {
								document.getElementById(status_jendela_id).innerHTML = "Terbuka";
								document.getElementById(buka_jendela_id).style.display = "none";
								document.getElementById(tutup_jendela_id).style.display = "block";
							} else {
								document.getElementById(status_jendela_id).innerHTML = "Tertutup";
								document.getElementById(buka_jendela_id).style.display = "block";
								document.getElementById(tutup_jendela_id).style.display = "none";
							}

						});
					}
				}
			});

		}, 1000);
	});
</script>

<script>
	var datasensor = document.getElementById('datasensor');
	var status_operasi_header = document.getElementById('status_operasi_header');
	var card_body_1 = document.getElementById('card_body_1');
	var status_sekarang = document.getElementById('status_sekarang');
	$(document).ready(function() {
		setInterval(function() {
			$.ajax({
				url: "<?php echo base_url(); ?>Dashboard/ambilDataSensorTabel",
				dataType: 'json',
				success: function(data) {

					if (data != false) {
						datasensor.innerHTML = "";
						$.each(data, function(key, val) {

							if (val.statushujan == 0) {
								var status_hujan = "Tidak Hujan";
							} else if (val.statushujan == 1) {
								var status_hujan = "Hujan";
							}


							datasensor.innerHTML += "<tr><td>" + val.waktu +
								"</td><td>" + val.tanggal +
								"</td><td>" + val.kecepatanangin +
								"</td><td>" + status_hujan +
								"</td><td>" + val.suhu +
								"</td><td>" + val.kelembaban +
								"</td></tr>"
						});
					}
				}
			});

			$.ajax({
				url: "<?php echo base_url(); ?>Dashboard/ambilOperasi",
				dataType: 'json',
				success: function(data) {
					if (data[0] == 1) {
						status_operasi_header.innerHTML = "Operasi Otomatis";
						card_body_1.style.display = "none";
						document.getElementById("card_header_1").classList.remove('card-header-info');
						document.getElementById("card_header_1").classList.add('card-header-success');
					} else {
						status_operasi_header.innerHTML = "Operasi Manual";
						card_body_1.style.display = "block";
						document.getElementById("card_header_1").classList.remove('card-header-success');
						document.getElementById("card_header_1").classList.add('card-header-info');
					}
					status_sekarang.value = data[0];
				}
			});
		}, 1000);
	});
</script>

<script>
	function operasi() {
		$.ajax({
			url: "<?php echo base_url(); ?>Dashboard/ubahOperasi",
			method: "POST",
			dataType: 'json',
			success: function(data) {
				console.log(data);
			}
		});
	}
</script>

<script>
	function bukaJendela(id) {
		$.ajax({
			url: "<?php echo base_url(); ?>Dashboard/bukaJendela",
			method: "POST",
			data: {
				id_jendela: id
			},
			dataType: 'json',
			success: function(data) {
				console.log(data);
			}
		});
	}

	function tutupJendela(id) {
		$.ajax({
			url: "<?php echo base_url(); ?>Dashboard/tutupJendela",
			method: "POST",
			data: {
				id_jendela: id
			},
			dataType: 'json',
			success: function(data) {
				console.log(data);
			}
		});
	}
</script>