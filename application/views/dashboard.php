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
							<a onclick="operasi()">Ganti Operasi</a>
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
					<div class="card-header card-header-warning">
						<h4 class="card-title">Data Sensor</h4>
						<p class="card-category">Data ini merupakan 5 update data sensor terakhir</p>
					</div>
					<div class="card-body table-responsive">
						<table class="table table-hover">
							<thead class="text-warning">
								<th>No</th>
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

							if (val.posisijendela == 0) {
								var posisi_jendela = "Tertutup";
								buka_jendela.style.display = "block";
								tutup_jendela.style.display = "none";
							} else if (val.posisijendela == 1) {
								var posisi_jendela = "Terbuka";
								buka_jendela.style.display = "none";
								tutup_jendela.style.display = "block";
							}
							posisijendela.innerHTML = posisi_jendela;
							kecepatanangin.innerHTML = val.kecepatanangin;
							statushujan.innerHTML = status_hujan;
							suhukelembaban.innerHTML = val.suhu + " & " + val.kelembaban;

						});
					} else {
						posisijendela.innerHTML = "Data TIdak Ditemukan";
						kecepatanangin.innerHTML = "Data TIdak Ditemukan";
						statushujan.innerHTML = "Data TIdak Ditemukan";
						suhukelembaban.innerHTML = "Data TIdak Ditemukan";
					}
				}
			});
			$.ajax({
				url: "<?php echo base_url(); ?>Dashboard/ambilDataJendela",
				dataType: 'json',
				success: function(data) {

					if (data != false) {
						$.each(data, function(key, val) {
							if (val.posisijendela == 0) {
								var posisi_jendela = "Tertutup";
								buka_jendela.style.display = "block";
								tutup_jendela.style.display = "none";
							} else if (val.posisijendela == 1) {
								var posisi_jendela = "Terbuka";
								buka_jendela.style.display = "none";
								tutup_jendela.style.display = "block";
							}
							posisijendela.innerHTML = posisi_jendela;

						});
					} else {
						posisijendela.innerHTML = "Data TIdak Ditemukan";
					}
				}
			});
		}, 1000);
	});
</script>

<script>
	var datasensor = document.getElementById('datasensor');
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


							datasensor.innerHTML += "<tr><td>" + val.id +
								"</td><td>" + val.waktu +
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
					status_sekarang.value = data[0];
				}
			});
		}, 1000);
	});
</script>

<script>
	var status = document.getElementById('status_sekarang').value;

	function operasi() {
		$.ajax({
			url: "<?php echo base_url(); ?>Dashboard/ambilOperasi",
			dataType: 'json',
			success: function(data) {
				status_sekarang.value = data[0];
			}
		});
	}
</script>