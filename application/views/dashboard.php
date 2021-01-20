<!doctype html>
<html lang="en">

<head>
	<?php $this->load->view("templates/head.php") ?>
</head>

<body>
	<div class="wrapper ">
		<?php $this->load->view("templates/sidebar.php") ?>
		<div class="main-panel">
			<!-- Navbar -->
			<?php $this->load->view("templates/navbar.php") ?>
			<!-- End Navbar -->
			<div class="content">
				<div class="container-fluid">
					<!-- Content -->
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
											<h3 class="card-title">Terbuka</h3>
										</div>
										<div class="card-footer">
											<div class="stats">
												<i class="material-icons text-danger">warning</i>
												<a href="javascript:;">Tutup Manual</a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-md-6 col-sm-6">
									<div class="card card-stats">
										<div class="card-header card-header-success card-header-icon">
											<div class="card-icon">
												<i class="material-icons">store</i>
											</div>
											<p class="card-category">Kecepatan Angin</p>
											<h3 class="card-title">34</h3>
										</div>
										<div class="card-footer">
											<div class="stats">
												<i class="material-icons">date_range</i> Last 10 Minutes
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-md-6 col-sm-6">
									<div class="card card-stats">
										<div class="card-header card-header-danger card-header-icon">
											<div class="card-icon">
												<i class="material-icons">info_outline</i>
											</div>
											<p class="card-category">Status Hujan</p>
											<h3 class="card-title">Tidak Hujan</h3>
										</div>
										<div class="card-footer">
											<div class="stats">
												<i class="material-icons">date_range</i> Last 10 Minutes
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-md-6 col-sm-6">
									<div class="card card-stats">
										<div class="card-header card-header-info card-header-icon">
											<div class="card-icon">
												<i class="fa fa-twitter"></i>
											</div>
											<p class="card-category">Suhu & Kelembaban Kamar</p>
											<h3 class="card-title">32 dan 60</h3>
										</div>
										<div class="card-footer">
											<div class="stats">
												<i class="material-icons">update</i> Just Updated
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12 col-md-12">
									<div class="card">
										<div class="card-header card-header-warning">
											<h4 class="card-title">Data Sensor</h4>
											<p class="card-category">Data ini merupakan 10 update data sensor terakhir</p>
										</div>
										<div class="card-body table-responsive">
											<table class="table table-hover">
												<thead class="text-warning">
													<th>No</th>
													<th>Waktu</th>
													<th>Kecepatan Angin</th>
													<th>Status Hujan</th>
													<th>Suhu dan Kelembaban Kamar</th>
												</thead>
												<tbody>
													<tr>
														<td>1</td>
														<td>13:05 12 Januari 2021</td>
														<td>34</td>
														<td>Tidak Hujan</td>
														<td>32 dan 60</td>
													</tr>
													<tr>
														<td>2</td>
														<td>13:00 12 Januari 2021</td>
														<td>32</td>
														<td>Tidak Hujan</td>
														<td>32 dan 60</td>
													</tr>
													<tr>
														<td>3</td>
														<td>12:55 12 Januari 2021</td>
														<td>33</td>
														<td>Tidak Hujan</td>
														<td>32 dan 60</td>
													</tr>
													<tr>
														<td>4</td>
														<td>12:50 12 Januari 2021</td>
														<td>31</td>
														<td>Tidak Hujan</td>
														<td>32 dan 60</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php $this->load->view("templates/footer.php") ?>
		</div>
	</div>

</body>

</html>