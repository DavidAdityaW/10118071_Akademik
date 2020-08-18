<?php
	// include models/model_jurusan.php
	include "models/model_jurusan.php";
	
	$jsn = new Jurusan($connection);

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
							<h3 class="panel-title">Jurusan</h3>
							<p class="panel-subtitle">Selamat Datang, Admin</p>
						</div>
					</div> -->
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Data Jurusan</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-bordered table-hover table-striped" id="datatables">
											<thead>
												<tr>
													<th>No.</th>
													<th>Kode Jurusan</th>
													<th>Nama Jurusan</th>
													<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
												<!-- tampil data jurusan -->
												<?php
													$no = 1;
													$tampil = $jsn->tampil();
													while($data = $tampil->fetch_object()) {
												?>
												<tr>
													<td><?php echo $no++."."; ?></td>
													<td><?php echo $data->kode_jsn; ?></td>
													<td><?php echo $data->nama_jsn; ?></td>
													<td>
														<!-- button edit dengan jquery ajax -->
														<a id="edit_jsn" data-toggle="modal" data-target="#edit" data-kode="<?php echo $data->kode_jsn; ?>" data-nama="<?php echo $data->nama_jsn ?>">
															<button class="btn btn-info btn-xs"><i class="lnr lnr-pencil"></i></button></a>
														<!-- end button edit dengan jquery ajax -->
														<!-- button hapus -->
														<a href="?page=jurusan&act=del&id=<?php echo $data->kode_jsn; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
															<button class="btn btn-danger btn-xs"><i class="lnr lnr-trash"></i></button></a>
														<!-- button hapus -->
													</td>
												</tr>
												<?php
													}
												?>
												<!-- end tampil data jurusan -->
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- END BORDERED TABLE -->

							<!-- button dan form pop up tambah data jurusan -->
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
							<!-- model pop up tambah data jurusan -->
							<div id="tambah" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Tambah Data Jurusan</h4>
										</div>
										<form action="" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<label class="control-label" for="kode_jsn">Kode Jurusan</label>
													<input type="text" name="kode_jsn" class="form-control" placeholder="Masukan kode jurusan" id="kode_jsn" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="nama_jsn">Nama Jurusan</label>
													<input type="text" name="nama_jsn" class="form-control" placeholder="Masukan nama jurusan" id="nama_jsn" required>
												</div>
											</div>
											<div class="modal-footer">
												<button type="reset" class="btn btn-danger">Reset</button>
												<input type="submit" class="btn btn-success" name="tambah" value="Simpan">
											</div>
										</form>

										<!-- tambah data jurusan -->
										<?php
											if(@$_POST['tambah']) {
												$kode_jsn = $connection->conn->real_escape_string($_POST['kode_jsn']);
												$nama_jsn = $connection->conn->real_escape_string($_POST['nama_jsn']);
												if(@$_POST['tambah']) {
													$jsn->tambah($kode_jsn, $nama_jsn);
													header("location: ?page=jurusan"); // redirect ke form data jurusan
												} else {
													echo "<script>alert('Tambah data jurusan gagal!')</script>";
												}
											}
										?>
										<!-- end tambah data jurusan -->
									</div>
								</div>
							</div>
							<!-- end button dan form pop up tambah data jurusan -->

							<!-- model pop up edit data jurusan -->
							<div id="edit" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Edit Data Jurusan</h4>
										</div>
										<form id="form" enctype="multipart/form-data">
											<div class="modal-body" id="modal-edit">
												<div class="form-group">
													<!-- kode_jsn setiap data jurusan untuk parameter edit -->
													<label class="control-label" for="kode_jsn">Kode Jurusan</label>
													<input type="text" name="kode_jsn" class="form-control" placeholder="Masukan kode jurusan" id="kode_jsn" required readonly>
												</div>
												<div class="form-group">
													<label class="control-label" for="nama_jsn">Nama Jurusan</label>
													<input type="text" name="nama_jsn" class="form-control" placeholder="Masukan nama jurusan" id="nama_jsn" required>
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" name="edit" value="Simpan">
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- end model pop up edit data jurusan -->

							<!-- get data jurusan dengan jquery ajax -->
							<script src="assets/vendor/jquery/jquery.min.js"></script>
							<script type="text/javascript">
								// saat diklik dengan id #edit_jsn
								$(document).on("click", "#edit_jsn", function() {
									var kode_jsn = $(this).data('kode');
									var nama_jsn = $(this).data('nama');
									$("#modal-edit #kode_jsn").val(kode_jsn);
									$("#modal-edit #nama_jsn").val(nama_jsn);
								})

								// proses edit data jurusan dengan jquery ajax
								$(document).ready(function(e) {
									$("#form").on("submit", (function(e) {
										e.preventDefault();
										$.ajax({
											url : 'models/proses_edit_jurusan.php',
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
		$jsn->hapus($_GET['id']);
		// redirect
		header("location: ?page=jurusan");
	}