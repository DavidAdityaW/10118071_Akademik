<?php
	// koneksi database
	$koneksi = mysqli_connect('localhost','root','','10118071_Akademik');
?>
<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login | 10118071_Akademik</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="assets/img/logo-10118071_Akademik_lr.png" alt="Klorofil Logo"></div>
								<p class="lead">Create your account</p>
							</div>
							<form class="form-auth-small" action="" method="post">
								<div class="form-group">
									<label for="nama" class="control-label sr-only">Nama</label>
									<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
								</div>
								<div class="form-group">
									<label for="user" class="control-label sr-only">Username</label>
									<input type="text" class="form-control" name="user" id="user" placeholder="Username">
								</div>
								<div class="form-group">
									<label for="pass" class="control-label sr-only">Password</label>
									<input type="password" class="form-control" name="pass" id="pass" placeholder="Password">
								</div>
								<div class="form-group">
									<label class="control-label sr-only" for="role">Role</label>
									<select class="form-control" name="role" id="role" required>
										<option>-- Pilih --</option>
										<option value="admin">Admin</option>
										<option value="operator">Operator</option>
									</select>
								</div>
								<!-- <div class="form-group clearfix">
									<label class="fancy-checkbox element-left">
										<input type="checkbox">
										<span>Remember me</span>
									</label>
								</div> -->
								<input type="submit" class="btn btn-primary btn-lg btn-block" name="register" value="REGISTER">
								<!-- <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button> -->
								<div class="bottom">
									<span class="helper-text"><!-- <i class="fa fa-lock"></i> --> <a href="login.php">Have an account?</a></span>
								</div>
							</form>
							<?php
							if (@$_POST['register']) {
								$nama = @$_POST['nama'];
								$user = @$_POST['user'];
								$pass = @$_POST['pass'];
								$role = @$_POST['role'];

								if ($nama == "" || $user == "" || $pass == "" || $role == "") {
									?> <script type="text/javascript">alert('Inputan tidak boleh ada yang kosong');</script> <?php
								}else {
									$sql_insert = mysqli_query($koneksi, "INSERT INTO tb_users VALUES ('', '$nama', '$user', '$pass', '$role')") or die (mysql_error());
									if ($sql_insert) {
										?> <script type="text/javascript">alert('Register berhasil, silahkan login');</script> <?php
										//header("location: login.php");
									}
								}
							}
							?>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">WELCOME TO SI-AKADEMIK</h1>
							<p>by 10118071 David Aditya Winarto</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>