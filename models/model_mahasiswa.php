<?php 
	class Mahasiswa {
		// deklasrasi objek/variabel
		private $mysqli;

		// fungsi yang otomatis diload pertama kali oleh kelas
		function __construct($conn) {
			$this->mysqli = $conn;
		}

		// fungsi tampil data mahasiswa
		public function tampil($id = null) {
			$db = $this->mysqli->conn;
			$sql = "SELECT * FROM tb_mahasiswa";
			if($id != null) {
				$sql .= " WHERE id_mhs = $id";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}

		// fungsi tambah data mahasiswa
		public function tambah($nim, $nama_mhs, $jk, $agama, $tgl_lahir, $no_telp, $alamat, $kode_jsn) {
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO tb_mahasiswa VALUES('', '$nim', '$nama_mhs', '$jk', '$agama', '$tgl_lahir', '$no_telp', '$alamat', '$kode_jsn')") or die ($db_error);
		}

		// fungsi edit data mahasiswa
		public function edit($sql) {
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db_error);
		}

		// fungsi hapus data mahasiswa
		public function hapus($id) {
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM tb_mahasiswa WHERE id_mhs = '$id'") or die ($db_error);
		}

		// fungsi yang otomatis dipanggil terakhir kali setelah semua fungsi dalam kelas dijalankan / penutup koneksi
		function __destruct() {
			$db = $this->mysqli->conn;
			$db->close();
		}
	}
?>