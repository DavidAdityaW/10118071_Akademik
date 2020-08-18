<?php
	// include models/model_matakuliah.php
	include "models/model_matakuliah.php";
	
	$mk = new Matakuliah($connection);

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
							<h3 class="panel-title">Mata Kuliah</h3>
							<p class="panel-subtitle">Selamat Datang, Admin</p>
						</div>
					</div> -->
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Data Mata Kuliah</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-bordered table-hover table-striped" id="datatables">
											<thead>
												<tr>
													<th>No.</th>
													<th>Kode Mata Kuliah</th>
													<th>Nama Mata Kuliah</th>
													<th>SKS</th>
													<th>Semester</th>
													<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
												<!-- tampil data matakuliah -->
												<?php
													$no = 1;
													$tampil = $mk->tampil();
													while($data = $tampil->fetch_object()) {
												?>
												<tr>
													<td><?php echo $no++."."; ?></td>
													<td><?php echo $data->kode_mk; ?></td>
													<td><?php echo $data->nama_mk; ?></td>
													<td><?php echo $data->sks; ?></td>
													<td><?php echo $data->semester; ?></td>
													<td>
														<!-- button edit dengan jquery ajax -->
														<a id="edit_mk" data-toggle="modal" data-target="#edit" data-kode="<?php echo $data->kode_mk; ?>" data-nama="<?php echo $data->nama_mk ?>" data-sks="<?php echo $data->sks; ?>" data-semester="<?php echo $data->semester; ?>">
															<button class="btn btn-info btn-xs"><i class="lnr lnr-pencil"></i></button></a>
														<!-- end button edit dengan jquery ajax -->
														<!-- button hapus -->
														<a href="?page=matakuliah&act=del&id=<?php echo $data->kode_mk; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
															<button class="btn btn-danger btn-xs"><i class="lnr lnr-trash"></i></button></a>
														<!-- button hapus -->
													</td>
												</tr>
												<?php
													}
												?>
												<!-- end tampil data matakuliah -->
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- END BORDERED TABLE -->

							<!-- button dan form pop up tambah data matakuliah -->
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
							<!-- model pop up tambah data matakuliah -->
							<div id="tambah" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Tambah Data Matakuliah</h4>
										</div>
										<form action="" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<label class="control-label" for="kode_mk">Kode Mata Kuliah</label>
													<input type="text" name="kode_mk" class="form-control" placeholder="Masukan kode mata kuliah" id="kode_mk" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="nama_mk">Nama Mata Kuliah</label>
													<input type="text" name="nama_mk" class="form-control" placeholder="Masukan nama mata kuliah" id="nama_mk" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="sks">SKS</label>
													<input type="number" name="sks" class="form-control" placeholder="Masukan sks" id="sks" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="semester">Semester</label>
													<input type="number" name="semester" class="form-control" placeholder="Masukan semester" id="semester" required>
												</div>
											</div>
											<div class="modal-footer">
												<button type="reset" class="btn btn-danger">Reset</button>
												<input type="submit" class="btn btn-success" name="tambah" value="Simpan">
											</div>
										</form>

										<!-- tambah data matakuliah -->
										<?php
											if(@$_POST['tambah']) {
												$kode_mk = $connection->conn->real_escape_string($_POST['kode_mk']);
												$nama_mk = $connection->conn->real_escape_string($_POST['nama_mk']);
												$sks = $connection->conn->real_escape_string($_POST['sks']);
												$semester = $connection->conn->real_escape_string($_POST['semester']);
												if(@$_POST['tambah']) {
													$mk->tambah($kode_mk, $nama_mk, $sks, $semester);
													header("location: ?page=matakuliah"); // redirect ke form data matakuliah
												} else {
													echo "<script>alert('Tambah data mata kuliah gagal!')</script>";
												}
											}
										?>
										<!-- end tambah data matakuliah -->
									</div>
								</div>
							</div>
							<!-- end button dan form pop up tambah data matakuliah -->

							<!-- model pop up edit data matakuliah -->
							<div id="edit" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Edit Data Mata Kuliah</h4>
										</div>
										<form id="form" enctype="multipart/form-data">
											<div class="modal-body" id="modal-edit">
												<div class="form-group">
													<!-- kode_mk setiap data matakuliah untuk parameter edit -->
													<label class="control-label" for="kode_mk">Kode Mata Kuliah</label>
													<input type="text" name="kode_mk" class="form-control" placeholder="Masukan kode mata kuliah" id="kode_mk" required readonly>
												</div>
												<div class="form-group">
													<label class="control-label" for="nama_mk">Nama Mata Kuliah</label>
													<input type="text" name="nama_mk" class="form-control" placeholder="Masukan nama mata kuliah" id="nama_mk" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="sks">SKS</label>
													<input type="number" name="sks" class="form-control" placeholder="Masukan sks" id="sks" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="semester">Semester</label>
													<input type="number" name="semester" class="form-control" placeholder="Masukan semester" id="semester" required>
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" name="edit" value="Simpan">
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- end model pop up edit data matakuliah -->

							<!-- get data matakuliah dengan jquery ajax -->
							<script src="assets/vendor/jquery/jquery.min.js"></script>
							<script type="text/javascript">
								// saat diklik dengan id #edit_mk
								$(document).on("click", "#edit_mk", function() {
									var kode_mk = $(this).data('kode');
									var nama_mk = $(this).data('nama');
									var sks_mk = $(this).data('sks');
									var semester_mk = $(this).data('semester');
									$("#modal-edit #kode_mk").val(kode_mk);
									$("#modal-edit #nama_mk").val(nama_mk);
									$("#modal-edit #sks").val(sks_mk);
									$("#modal-edit #semester").val(semester_mk);
								})

								// proses edit data matakuliah dengan jquery ajax
								$(document).ready(function(e) {
									$("#form").on("submit", (function(e) {
										e.preventDefault();
										$.ajax({
											url : 'models/proses_edit_matakuliah.php',
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
		$mk->hapus($_GET['id']);
		// redirect
		header("location: ?page=matakuliah");
	}