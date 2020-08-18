<?php
	// include models/model_mahasiswa.php
	include "models/model_mahasiswa.php";
	
	$mhs = new Mahasiswa($connection);

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
							<h3 class="panel-title">Mahasiswa</h3>
							<p class="panel-subtitle">Selamat Datang, Admin</p>
						</div>
					</div> -->
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Data Mahasiswa</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-bordered table-hover table-striped" id="datatables">
											<thead>
												<tr>
													<th>No.</th>
													<th>NIM</th>
													<th>Nama Mahasiswa</th>
													<th>Jenis Kelamin</th>
													<th>Agama</th>
													<th>Tanggal Lahir</th>
													<th>Nomor Handphone</th>
													<th>Alamat</th>
													<th>Jurusan</th>
													<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
												<!-- tampil data mahasiswa -->
												<?php
													$no = 1;
													$tampil = $mhs->tampil();
													while($data = $tampil->fetch_object()) {
												?>
												<tr>
													<td><?php echo $no++."."; ?></td>
													<td><?php echo $data->nim; ?></td>
													<td><?php echo $data->nama_mhs; ?></td>
													<td><?php echo $data->jk; ?></td>
													<td><?php echo $data->agama; ?></td>
													<td><?php echo $data->tgl_lahir; ?></td>
													<td><?php echo $data->no_telp; ?></td>
													<td><?php echo $data->alamat; ?></td>
													<td><?php echo $data->kode_jsn; ?></td>
													<td>
														<!-- button edit dengan jquery ajax -->
														<a id="edit_mhs" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id_mhs; ?>" data-nim="<?php echo $data->nim; ?>" data-nama="<?php echo $data->nama_mhs ?>" data-jk="<?php echo $data->jk; ?>" data-agama="<?php echo $data->agama; ?>" data-tgl="<?php echo $data->tgl_lahir; ?>" data-notelp="<?php echo $data->no_telp; ?>" data-alamat="<?php echo $data->alamat; ?>" data-kode="<?php echo $data->kode_jsn; ?>">
															<button class="btn btn-info btn-xs"><i class="lnr lnr-pencil"></i></button></a>
														<!-- end button edit dengan jquery ajax -->
														<!-- button hapus -->
														<a href="?page=mahasiswa&act=del&id=<?php echo $data->id_mhs; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
															<button class="btn btn-danger btn-xs"><i class="lnr lnr-trash"></i></button></a>
														<!-- button hapus -->
													</td>
												</tr>
												<?php
													}
												?>
												<!-- end tampil data mahasiswa -->
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- END BORDERED TABLE -->

							<!-- button dan form pop up tambah data mahasiswa -->
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
							<!-- model pop up tambah data mahasiswa -->
							<div id="tambah" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Tambah Data Mahasiswa</h4>
										</div>
										<form action="" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<label class="control-label" for="nim">NIM</label>
													<input type="text" name="nim" class="form-control" placeholder="Masukan NIM" id="nim" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="nama_mhs">Nama Mahasiswa</label>
													<input type="text" name="nama_mhs" class="form-control" placeholder="Masukan nama lengkap" id="nama_mhs" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="jk">Jenis Kelamin</label>
													<select class="form-control" name="jk" id="jk" required>
														<option>-- Pilih --</option>
														<option value="L">Laki-laki</option>
														<option value="P">Perempuan</option>
													</select>
												</div>
												<div class="form-group">
													<label class="control-label" for="agama">Agama</label>
													<select class="form-control" name="agama" id="agama" required>
														<option>-- Pilih --</option>
														<option value="Islam">Islam</option>
														<option value="Kriten">Kriten</option>
														<option value="Budha">Budha</option>
														<option value="Hindu">Hindu</option>
													</select>
												</div>
												<div class="form-group">
													<label class="control-label" for="tgl_lahir">Tanggal Lahir</label>
													<input type="date" date-format="YYYY-MM-dd" name="tgl_lahir" class="form-control" placeholder="Masukan tanggal lahir" id="tgl_lahir" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="no_telp">Nomor Handphone</label>
													<input type="number" name="no_telp" class="form-control" placeholder="Ex. 083121153355" id="no_telp" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="alamat">Alamat</label>
													<textarea name="alamat" class="form-control" placeholder="Masukan alamat" rows="4" id="alamat" required></textarea>
												</div>
												<div class="form-group">
													<label class="control-label" for="kode_jsn">Jurusan</label>
													<select class="form-control" name="kode_jsn" id="kode_jsn" required>
														<?php
															// relasi dari tb_jurusan
															// koneksi database
															$koneksi = mysqli_connect('localhost','root','','10118071_Akademik');
															$sql="SELECT * FROM tb_jurusan";
															$hasil=mysqli_query($koneksi,$sql);
															echo '<option>-- Pilih --</option>';
															while ($data = mysqli_fetch_array($hasil)) {
														?>
													    	<option value="<?php echo $data['kode_jsn']; ?>"><?php echo $data['nama_jsn']; ?></option>
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

										<!-- tambah data mahasiswa -->
										<?php
											if(@$_POST['tambah']) {
												$nim = $connection->conn->real_escape_string($_POST['nim']);
												$nama_mhs = $connection->conn->real_escape_string($_POST['nama_mhs']);
												$jk = $connection->conn->real_escape_string($_POST['jk']);
												$agama = $connection->conn->real_escape_string($_POST['agama']);
												$tgl_lahir = $connection->conn->real_escape_string($_POST['tgl_lahir']);
												$no_telp = $connection->conn->real_escape_string($_POST['no_telp']);
												$alamat = $connection->conn->real_escape_string($_POST['alamat']);
												$kode_jsn = $connection->conn->real_escape_string($_POST['kode_jsn']);
												if(@$_POST['tambah']) {
													$mhs->tambah($nim, $nama_mhs, $jk, $agama, $tgl_lahir, $no_telp, $alamat, $kode_jsn);
													header("location: ?page=mahasiswa"); // redirect ke form data mahasiswa
												} else {
													echo "<script>alert('Tambah data mahasiswa gagal!')</script>";
												}
											}
										?>
										<!-- end tambah data mahasisiwa -->
									</div>
								</div>
							</div>
							<!-- end button dan form pop up tambah data mahasisiwa -->

							<!-- model pop up edit data mahasiswa -->
							<div id="edit" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Edit Data Mahasiswa</h4>
										</div>
										<form id="form" enctype="multipart/form-data">
											<div class="modal-body" id="modal-edit">
												<div class="form-group">
													<label class="control-label" for="nim">NIM</label>
													<!-- id setiap data mahasiswa untuk parameter edit -->
													<input type="hidden" name="id_mhs" id="id_mhs"> 
													<input type="text" name="nim" class="form-control" placeholder="Masukan NIM" id="nim" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="nama_mhs">Nama Mahasiswa</label>
													<input type="text" name="nama_mhs" class="form-control" placeholder="Masukan nama lengkap" id="nama_mhs" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="jk">Jenis Kelamin</label>
													<select class="form-control" name="jk" id="jk" required>
														<option>-- Pilih --</option>
														<option value="L">Laki-laki</option>
														<option value="P">Perempuan</option>
													</select>
												</div>
												<div class="form-group">
													<label class="control-label" for="agama">Agama</label>
													<select class="form-control" name="agama" id="agama" required>
														<option>-- Pilih --</option>
														<option value="Islam">Islam</option>
														<option value="Kriten">Kriten</option>
														<option value="Budha">Budha</option>
														<option value="Hindu">Hindu</option>
													</select>
												</div>
												<div class="form-group">
													<label class="control-label" for="tgl_lahir">Tanggal Lahir</label>
													<input type="date" date-format="YYYY-MM-dd" name="tgl_lahir" class="form-control" placeholder="Masukan tanggal lahir" id="tgl_lahir" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="no_telp">Nomor Handphone</label>
													<input type="number" name="no_telp" class="form-control" placeholder="Ex. 083121153355" id="no_telp" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="alamat">Alamat</label>
													<textarea name="alamat" class="form-control" placeholder="Masukan alamat" rows="4" id="alamat" required></textarea>
												</div>
												<div class="form-group">
													<label class="control-label" for="kode_jsn">Jurusan</label>
													<select class="form-control" name="kode_jsn" id="kode_jsn" required>
														<?php
															// relasi dari tb_jurusan
															// koneksi database
															$koneksi = mysqli_connect('localhost','root','','10118071_Akademik');
															$sql="SELECT * FROM tb_jurusan";
															$hasil=mysqli_query($koneksi,$sql);
															echo '<option>-- Pilih --</option>';
															while ($data = mysqli_fetch_array($hasil)) {
														?>
													    	<option value="<?php echo $data['kode_jsn']; ?>"><?php echo $data['nama_jsn']; ?></option>
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
							<!-- end model pop up edit data mahasiswa -->

							<!-- get data mahasiswa dengan jquery ajax -->
							<script src="assets/vendor/jquery/jquery.min.js"></script>
							<script type="text/javascript">
								// saat diklik dengan id #edit_mhs
								$(document).on("click", "#edit_mhs", function() {
									var id_mhs = $(this).data('id');
									var nim_mhs = $(this).data('nim');
									var nama_mhs = $(this).data('nama');
									var jk_mhs = $(this).data('jk');
									var agama_mhs = $(this).data('agama');
									var tgllahir_mhs = $(this).data('tgl');
									var notelp_mhs = $(this).data('notelp');
									var alamat_mhs = $(this).data('alamat');
									var kode_jsn = $(this).data('kode');
									$("#modal-edit #id_mhs").val(id_mhs);
									$("#modal-edit #nim").val(nim_mhs);
									$("#modal-edit #nama_mhs").val(nama_mhs);
									$("#modal-edit #jk").val(jk_mhs);
									$("#modal-edit #agama").val(agama_mhs);
									$("#modal-edit #tgl_lahir").val(tgllahir_mhs);
									$("#modal-edit #no_telp").val(notelp_mhs);
									$("#modal-edit #alamat").val(alamat_mhs);
									$("#modal-edit #kode_jsn").val(kode_jsn);
								})

								// proses edit data mahasiswa dengan jquery ajax
								$(document).ready(function(e) {
									$("#form").on("submit", (function(e) {
										e.preventDefault();
										$.ajax({
											url : 'models/proses_edit_mahasiswa.php',
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
		$mhs->hapus($_GET['id']);
		// redirect
		header("location: ?page=mahasiswa");
	}