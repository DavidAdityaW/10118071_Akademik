<?php
	// koneksi database
	$koneksi = mysqli_connect('localhost','root','','10118071_Akademik');

	// mengambil data mahasiswa
	$data_mhs = mysqli_query($koneksi,"SELECT * FROM tb_mahasiswa");
 	// menghitung data mahasiswa
	$jumlah_mhs = mysqli_num_rows($data_mhs);

	// mengambil data dosen
	$data_dsn = mysqli_query($koneksi,"SELECT * FROM tb_dosen");
 	// menghitung data dosen
	$jumlah_dsn = mysqli_num_rows($data_dsn);

	// mengambil data jurusan
	$data_jsn = mysqli_query($koneksi,"SELECT * FROM tb_jurusan");
 	// menghitung data jurusan
	$jumlah_jsn = mysqli_num_rows($data_jsn);

	// mengambil data matakuliah
	$data_mk = mysqli_query($koneksi,"SELECT * FROM tb_matakuliah");
 	// menghitung data matakuliah
	$jumlah_mk = mysqli_num_rows($data_mk);
?>

<style type="text/css">
/*animasi gambar berputar*/
.metric span.icon {
  -webkit-transition: -webkit-transform 1.1s ease-in-out;
  transition: transform 1.1s ease-in-out;
}
.metric span.icon:hover {
  -webkit-transform: rotate(360deg);
  transform: rotate(360deg);
}
</style>

<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Dashboard</h3>
							<!-- <p class="panel-subtitle">Selamat Datang, Admin</p> -->
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-users"></i></span>
										<p>
											<span class="number"><?php echo $jumlah_mhs; ?></span>
											<span class="title">Mahasiswa</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-users"></i></span>
										<p>
											<span class="number"><?php echo $jumlah_dsn; ?></span>
											<span class="title">Dosen</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-layers"></i></span>
										<p>
											<span class="number"><?php echo $jumlah_jsn; ?></span>
											<span class="title">Jurusan</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-book"></i></span>
										<p>
											<span class="number"><?php echo $jumlah_mk; ?></span>
											<span class="title">Mata Kuliah</span>
										</p>
									</div>
								</div>
							</div>
							<!-- <div class="row">
								<div class="col-md-9">
									<div id="headline-chart" class="ct-chart"></div>
								</div>
								<div class="col-md-3">
									<div class="weekly-summary text-right">
										<span class="number">2,315</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 12%</span>
										<span class="info-label">Total Sales</span>
									</div>
									<div class="weekly-summary text-right">
										<span class="number">$5,758</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 23%</span>
										<span class="info-label">Monthly Income</span>
									</div>
									<div class="weekly-summary text-right">
										<span class="number">$65,938</span> <span class="percentage"><i class="fa fa-caret-down text-danger"></i> 8%</span>
										<span class="info-label">Total Income</span>
									</div>
								</div>
							</div> -->
						</div>
					</div>
					<!-- END OVERVIEW -->
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
<!-- END MAIN -->