<?php
	// include models/model_users.php
	include "models/model_users.php";
	
	$users = new Users($connection);

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
							<h3 class="panel-title">Users</h3>
							<p class="panel-subtitle">Selamat Datang, Admin</p>
						</div>
					</div> -->
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Data Users</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-bordered table-hover table-striped" id="datatables">
											<thead>
												<tr>
													<th>No.</th>
													<th>Nama Users</th>
													<th>Username</th>
													<th>Password</th>
													<th>Role</th>
													<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
												<!-- tampil data users -->
												<?php
													$no = 1;
													$tampil = $users->tampil();
													while($data = $tampil->fetch_object()) {
												?>
												<tr>
													<td><?php echo $no++."."; ?></td>
													<td><?php echo $data->nama_users; ?></td>
													<td><?php echo $data->username; ?></td>
													<td><?php echo $data->password; ?></td>
													<td><?php echo $data->role; ?></td>
													<td>
														<!-- button edit dengan jquery ajax -->
														<a id="edit_users" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id_users; ?>" data-nama="<?php echo $data->nama_users ?>" data-username="<?php echo $data->username; ?>" data-password="<?php echo $data->password; ?>" data-role="<?php echo $data->role; ?>">
															<button class="btn btn-info btn-xs"><i class="lnr lnr-pencil"></i></button></a>
														<!-- end button edit dengan jquery ajax -->
														<!-- button hapus -->
														<a href="?page=users&act=del&id=<?php echo $data->id_users; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
															<button class="btn btn-danger btn-xs"><i class="lnr lnr-trash"></i></button></a>
														<!-- button hapus -->
													</td>
												</tr>
												<?php
													}
												?>
												<!-- end tampil data users -->
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- END BORDERED TABLE -->

							<!-- button dan form pop up tambah data users -->
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
							<!-- model pop up tambah data users -->
							<div id="tambah" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Tambah Data Users</h4>
										</div>
										<form action="" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<label class="control-label" for="nama_users">Nama Users</label>
													<input type="text" name="nama_users" class="form-control" placeholder="Masukan nama lengkap" id="nama_users" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="username">Username</label>
													<input type="text" name="username" class="form-control" placeholder="Masukan username" id="username" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="password">Password</label>
													<input type="text" name="password" class="form-control" placeholder="Masukan password" id="password" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="role">Role</label>
													<select class="form-control" name="role" id="role" required>
														<option>-- Pilih --</option>
														<option value="admin">admin</option>
														<option value="operator">operator</option>
													</select>
												</div>
											</div>
											<div class="modal-footer">
												<button type="reset" class="btn btn-danger">Reset</button>
												<input type="submit" class="btn btn-success" name="tambah" value="Simpan">
											</div>
										</form>

										<!-- tambah data users -->
										<?php
											if(@$_POST['tambah']) {
												$nama_users = $connection->conn->real_escape_string($_POST['nama_users']);
												$username = $connection->conn->real_escape_string($_POST['username']);
												$password = $connection->conn->real_escape_string($_POST['password']);
												$role = $connection->conn->real_escape_string($_POST['role']);
												if(@$_POST['tambah']) {
													$users->tambah($nama_users, $username, $password, $role);
													header("location: ?page=users"); // redirect ke form data users
												} else {
													echo "<script>alert('Tambah data users gagal!')</script>";
												}
											}
										?>
										<!-- end tambah data users -->
									</div>
								</div>
							</div>
							<!-- end button dan form pop up tambah data users -->

							<!-- model pop up edit data users -->
							<div id="edit" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Edit Data Users</h4>
										</div>
										<form id="form" enctype="multipart/form-data">
											<div class="modal-body" id="modal-edit">
												<div class="form-group">
													<label class="control-label" for="nama_users">Nama Users</label>
													<!-- id setiap data users untuk parameter edit -->
													<input type="hidden" name="id_users" id="id_users"> 
													<input type="text" name="nama_users" class="form-control" placeholder="Masukan nama lengkap" id="nama_users" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="username">Username</label>
													<input type="text" name="username" class="form-control" placeholder="Masukan username" id="username" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="password">Password</label>
													<input type="text" name="password" class="form-control" placeholder="Masukan password" id="password" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="role">Role</label>
													<select class="form-control" name="role" id="role" required>
														<option>-- Pilih --</option>
														<option value="admin">admin</option>
														<option value="operator">operator</option>
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
							<!-- end model pop up edit data users -->

							<!-- get data mahasiswa dengan jquery ajax -->
							<script src="assets/vendor/jquery/jquery.min.js"></script>
							<script type="text/javascript">
								// saat diklik dengan id #edit_users
								$(document).on("click", "#edit_users", function() {
									var id_users = $(this).data('id');
									var nama_users = $(this).data('nama');
									var username_users = $(this).data('username');
									var password_users = $(this).data('password');
									var role_users = $(this).data('role');
									$("#modal-edit #id_users").val(id_users);
									$("#modal-edit #nama_users").val(nama_users);
									$("#modal-edit #username").val(username_users);
									$("#modal-edit #password").val(password_users);
									$("#modal-edit #role").val(role_users);
								})

								// proses edit data users dengan jquery ajax
								$(document).ready(function(e) {
									$("#form").on("submit", (function(e) {
										e.preventDefault();
										$.ajax({
											url : 'models/proses_edit_users.php',
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
		$users->hapus($_GET['id']);
		// redirect
		header("location: ?page=users");
	}