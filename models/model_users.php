<?php 
	class Users {
		// deklasrasi objek/variabel
		private $mysqli;

		// fungsi yang otomatis diload pertama kali oleh kelas
		function __construct($conn) {
			$this->mysqli = $conn;
		}

		// fungsi tampil data users
		public function tampil($id = null) {
			$db = $this->mysqli->conn;
			$sql = "SELECT * FROM tb_users";
			if($id != null) {
				$sql .= " WHERE id_users = $id";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}

		// fungsi tambah data users
		public function tambah($nama_users, $username, $password, $role) {
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO tb_users VALUES('', '$nama_users', '$username', '$password', '$role')") or die ($db_error);
		}

		// fungsi edit data users
		public function edit($sql) {
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db_error);
		}

		// fungsi hapus data users
		public function hapus($id) {
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM tb_users WHERE id_users = '$id'") or die ($db_error);
		}

		// fungsi yang otomatis dipanggil terakhir kali setelah semua fungsi dalam kelas dijalankan / penutup koneksi
		function __destruct() {
			$db = $this->mysqli->conn;
			$db->close();
		}
	}
?>