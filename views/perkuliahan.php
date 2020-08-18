<?php
	// include models/model_perkuliahan.php
	include "models/model_perkuliahan.php";
	
	$pk = new Perkuliahan($connection);

	// untuk clean dan mengamankan parameter pada link browser
	if(@$_GET['act'] == '') {
?>
<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<!-- <div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Perkuliahan</h3>
							<p class="panel-subtitle">Selamat Datang, Admin</p>
						</div>
					</div> -->
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Data Perkuliahan</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-bordered table-hover table-striped" id="datatables">
											<thead>
												<tr>
													<th>No.</th>
													<th>Tanggal Perkuliahan</th>
													<th>NIM</th>
													<th>Kode Matkul</th>
													<th>NIP</th>
													<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
												<!-- tampil data perkuliahan -->
												<?php
													$no = 1;
													$tampil = $pk->tampil();
													while($data = $tampil->fetch_object()) {
												?>
												<tr>
													<td><?php echo $no++."."; ?></td>
													<td><?php echo $data->tgl_pk; ?></td>
													<td><?php echo $data->nim; ?></td>
													<td><?php echo $data->kode_mk; ?></td>
													<td><?php echo $data->nip; ?></td>
													<td>
														<!-- button edit dengan jquery ajax -->
														<a id="edit_pk" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id_pk; ?>" data-tgl="<?php echo $data->tgl_pk; ?>" data-nim="<?php echo $data->nim; ?>" data-kode="<?php echo $data->kode_mk ?>" data-nip="<?php echo $data->nip; ?>">
															<button class="btn btn-info btn-xs"><i class="lnr lnr-pencil"></i></button></a>
														<!-- end button edit dengan jquery ajax -->
														<!-- button hapus -->
														<a href="?page=perkuliahan&act=del&id=<?php echo $data->id_pk; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
															<button class="btn btn-danger btn-xs"><i class="lnr lnr-trash"></i></button></a>
														<!-- button hapus -->
													</td>
												</tr>
												<?php
													}
												?>
												<!-- end tampil data perkuliahan -->
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- END BORDERED TABLE -->

							<!-- button dan form pop up tambah data perkuliahan -->
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
							<!-- model pop up tambah data perkuliahan -->
							<div id="tambah" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Tambah Data Perkuliahan</h4>
										</div>
										<form action="" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<label class="control-label" for="tgl_pk">Tanggal Perkuliahan</label>
													<input type="date" date-format="YYYY-MM-dd" name="tgl_pk" class="form-control" placeholder="Masukan tanggal perkuliahan" id="tgl_pk" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="nim">NIM</label>
													<select class="form-control" name="nim" id="nim" required>
														<?php
															// relasi dari tb_mahasiswa
															// koneksi database
															$koneksi = mysqli_connect('localhost','root','','10118071_Akademik');
															$sql="SELECT * FROM tb_mahasiswa";
															$hasil=mysqli_query($koneksi,$sql);
															echo '<option>-- Pilih --</option>';
															while ($data = mysqli_fetch_array($hasil)) {
														?>
													    	<option value="<?php echo $data['nim']; ?>"><?php echo $data['nim']; ?></option>
													  	<?php 
															}
														?>
													</select>
												</div>
												<div class="form-group">
													<label class="control-label" for="kode_mk">Kode Mata Kuliah</label>
													<select class="form-control" name="kode_mk" id="kode_mk" required>
														<?php
															// relasi dari tb_matakuliah
															// koneksi database
															$koneksi = mysqli_connect('localhost','root','','10118071_Akademik');
															$sql="SELECT * FROM tb_matakuliah";
															$hasil=mysqli_query($koneksi,$sql);
															echo '<option>-- Pilih --</option>';
															while ($data = mysqli_fetch_array($hasil)) {
														?>
													    	<option value="<?php echo $data['kode_mk']; ?>"><?php echo $data['nama_mk']; ?></option>
													  	<?php 
															}
														?>
													</select>
												</div>
												<div class="form-group">
													<label class="control-label" for="nip">NIP</label>
													<select class="form-control" name="nip" id="nip" required>
														<?php
															// relasi dari tb_dosen
															// koneksi database
															$koneksi = mysqli_connect('localhost','root','','10118071_Akademik');
															$sql="SELECT * FROM tb_dosen";
															$hasil=mysqli_query($koneksi,$sql);
															echo '<option>-- Pilih --</option>';
															while ($data = mysqli_fetch_array($hasil)) {
														?>
													    	<option value="<?php echo $data['nip']; ?>"><?php echo $data['nip']; ?></option>
													  	<?php 
															}
														?>
													</select>
												</div>
											</div>
											<div class="modal-footer">
												<button type="reset" class="btn btn-danger">Reset</button>
												<input type="submit" class="btn btn-success" name="tambah" value="Simpan">
											</div>
										</form>

										<!-- tambah data perkuliahan -->
										<?php
											if(@$_POST['tambah']) {
												$tgl_pk = $connection->conn->real_escape_string($_POST['tgl_pk']);
												$nim = $connection->conn->real_escape_string($_POST['nim']);
												$kode_mk = $connection->conn->real_escape_string($_POST['kode_mk']);
												$nip = $connection->conn->real_escape_string($_POST['nip']);
												if(@$_POST['tambah']) {
													$pk->tambah($tgl_pk, $nim, $kode_mk, $nip);
													header("location: ?page=perkuliahan"); // redirect ke form data perkuliahan
												} else {
													echo "<script>alert('Tambah data perkuliahan gagal!')</script>";
												}
											}
										?>
										<!-- end tambah data perkuliahan -->
									</div>
								</div>
							</div>
							<!-- end button dan form pop up tambah data perkuliahan -->

							<!-- model pop up edit data perkuliahan -->
							<div id="edit" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Edit Data Perkuliahan</h4>
										</div>
										<form id="form" enctype="multipart/form-data">
											<div class="modal-body" id="modal-edit">
												<div class="form-group">
													<label class="control-label" for="tgl_pk">Tanggal Perkuliahan</label>
													<!-- id setiap data perkuliahan untuk parameter edit -->
													<input type="hidden" name="id_pk" id="id_pk"> 
													<input type="date" date-format="YYYY-MM-dd" name="tgl_pk" class="form-control" placeholder="Masukan tanggal perkuliahan" id="tgl_pk" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="nim">NIM</label>
													<select class="form-control" name="nim" id="nim" required>
														<?php
															// relasi dari tb_mahasiswa
															// koneksi database
															$koneksi = mysqli_connect('localhost','root','','10118071_Akademik');
															$sql="SELECT * FROM tb_mahasiswa";
															$hasil=mysqli_query($koneksi,$sql);
															echo '<option>-- Pilih --</option>';
															while ($data = mysqli_fetch_array($hasil)) {
														?>
													    	<option value="<?php echo $data['nim']; ?>"><?php echo $data['nim']; ?></option>
													  	<?php 
															}
														?>
													</select>
												</div>
												<div class="form-group">
													<label class="control-label" for="kode_mk">Kode Mata Kuliah</label>
													<select class="form-control" name="kode_mk" id="kode_mk" required>
														<?php
															// relasi dari tb_matakuliah
															// koneksi database
															$koneksi = mysqli_connect('localhost','root','','10118071_Akademik');
															$sql="SELECT * FROM tb_matakuliah";
															$hasil=mysqli_query($koneksi,$sql);
															echo '<option>-- Pilih --</option>';
															while ($data = mysqli_fetch_array($hasil)) {
														?>
													    	<option value="<?php echo $data['kode_mk']; ?>"><?php echo $data['nama_mk']; ?></option>
													  	<?php 
															}
														?>
													</select>
												</div>
												<div class="form-group">
													<label class="control-label" for="nip">NIP</label>
													<select class="form-control" name="nip" id="nip" required>
														<?php
															// relasi dari tb_dosen
															// koneksi database
															$koneksi = mysqli_connect('localhost','root','','10118071_Akademik');
															$sql="SELECT * FROM tb_dosen";
															$hasil=mysqli_query($koneksi,$sql);
															echo '<option>-- Pilih --</option>';
															while ($data = mysqli_fetch_array($hasil)) {
														?>
													    	<option value="<?php echo $data['nip']; ?>"><?php echo $data['nip']; ?></option>
													  	<?php 
															}
														?>
													</select>
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" name="edit" value="Simpan">
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- end model pop up edit data perkuliahan -->

							<!-- get data perkuliahan dengan jquery ajax -->
							<script src="assets/vendor/jquery/jquery.min.js"></script>
							<script type="text/javascript">
								// saat diklik dengan id #edit_pk
								$(document).on("click", "#edit_pk", function() {
									var id_pk = $(this).data('id');
									var tgl_pk = $(this).data('tgl');
									var nim_pk = $(this).data('nim');
									var kode_mk = $(this).data('kode');
									var nip_pk = $(this).data('nip');
									$("#modal-edit #id_pk").val(id_pk);
									$("#modal-edit #tgl_pk").val(tgl_pk);
									$("#modal-edit #nim").val(nim_pk);
									$("#modal-edit #kode_mk").val(kode_mk);
									$("#modal-edit #nip").val(nip_pk);
								})

								// proses edit data perkuliahan dengan jquery ajax
								$(document).ready(function(e) {
									$("#form").on("submit", (function(e) {
										e.preventDefault();
										$.ajax({
											url : 'models/proses_edit_perkuliahan.php',
											type : 'POST',
											data : new FormData(this),
											contentType : false,
											cache : false,
											processData : false,
											success : function(msg) {
												$('.table').html(msg);
											}
										});
									}));
								})
							</script>

					<!-- END OVERVIEW -->
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
<!-- END MAIN -->
<?php
	} else if(@$_GET['act'] == 'del') {
		// echo "proses delete untuk id : ".$_GET['id'];
		$pk->hapus($_GET['id']);
		// redirect
		header("location: ?page=perkuliahan");
	}