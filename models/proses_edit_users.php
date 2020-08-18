<?php
	// jquery ajax memerlukan pemanggilan semua koneksi
	// index.php
	// mencegah error saat redirect dengan fungsi header(location)
	ob_start();
	// include sekali controllers/koneksi.php dan models/database.php
	require_once('../controllers/koneksi.php');
	require_once('../models/database.php');
	$connection = new Database($host, $user, $pass, $database);

	// model_users.php
	// include models/model_users.php
	include "../models/model_users.php";
	$users = new Users($connection);

	$id_users = $_POST['id_users'];
	$nama_users = $connection->conn->real_escape_string($_POST['nama_users']);
	$username = $connection->conn->real_escape_string($_POST['username']);
	$password = $connection->conn->real_escape_string($_POST['password']);
	$role = $connection->conn->real_escape_string($_POST['role']);

	$users->edit("UPDATE tb_users SET nama_users = '$nama_users', username = '$username', password = '$password', role = '$role' WHERE id_users = '$id_users'");
	// redirect
	echo "<script>window.location='?page=users';</script>";
?>