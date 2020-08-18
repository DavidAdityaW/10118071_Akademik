<?php 
	class Dosen {
		// deklasrasi objek/variabel
		private $mysqli;

		// fungsi yang otomatis diload pertama kali oleh kelas
		function __construct($conn) {
			$this->mysqli = $conn;
		}

		// fungsi tampil data dosen
		public function tampil($id = null) {
			$db = $this->mysqli->conn;
			$sql = "SELECT * FROM tb_dosen";
			if($id != null) {
				$sql .= " WHERE id_dsn = $id";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}

		// fungsi tambah data dosen
		public function tambah($nip, $nama_dsn, $jk, $agama, $tgl_lahir, $no_telp, $alamat) {
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO tb_dosen VALUES('', '$nip', '$nama_dsn', '$jk', '$agama', '$tgl_lahir', '$no_telp', '$alamat')") or die ($db_error);
		}

		// fungsi edit data dosen
		public function edit($sql) {
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db_error);
		}

		// fungsi hapus data dosen
		public function hapus($id) {
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM tb_dosen WHERE id_dsn = '$id'") or die ($db_error);
		}

		// fungsi yang otomatis dipanggil terakhir kali setelah semua fungsi dalam kelas dijalankan / penutup koneksi
		function __destruct() {
			$db = $this->mysqli->conn;
			$db->close();
		}
	}
?>