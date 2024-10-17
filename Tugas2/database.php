<?php

class Database {
    // Deklarasi atribut untuk koneksi database
    private $host = "localhost";  // Nama host database
    private $username = "root";   // Username untuk akses database
    private $pass = "";           // Password untuk akses database (kosong untuk default)
    private $db = "persuratan";   // Nama database yang akan digunakan
    protected $koneksi; // Ubah menjadi protected agar bisa diakses dari subclass

    // Constructor untuk menghubungkan ke database menggunakan MySQLi
    function __construct() {
        // Membuat koneksi ke database dengan menggunakan atribut yang sudah didefinisikan
        $this->koneksi = new mysqli($this->host, $this->username, $this->pass, $this->db);

        // Cek apakah koneksi berhasil
        if ($this->koneksi->connect_error) {
            // Jika terjadi error, tampilkan pesan dan hentikan eksekusi
            die("Koneksi gagal: " . $this->koneksi->connect_error);
        }
    }

    // Method untuk mengambil koneksi yang sudah dibuat
    public function getConnection() {
        return $this->koneksi;  // Mengembalikan objek koneksi MySQLi
    }

    // Method kosong yang bisa di-override oleh subclass untuk menampilkan data
    function tampilkanData() {
        // Kosongkan, akan diimplementasikan di subclass
    }
}

?>
