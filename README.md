# PraktikumWeb2-TUGAS 2

Implementasi CRUD dengan menggunakan PPHP OOP <br>
Implementasi CRUD menggunakan PHP OOP melibatkan pemanfaatan konsep Object-Oriented Programming (OOP) dalam mengelola operasi Create, Read, Update, dan Delete pada database. Dalam pendekatan ini, kita memisahkan logika menjadi kelas-kelas dan metode-metode, sehingga lebih terstruktur dan mudah dikelola. <br>
<br>
---
**Contoh Study Kasus :** <br>
ERD :
![ERD Persuratan Dosen drawio](https://github.com/user-attachments/assets/9f375f9f-e526-4605-b4c9-b72c8b0d414e)

1. Create an OOP-based View, by retrieving data from the MySQL database 
2. Use the _construct as a link to the database 
3. Apply encapsulation according to the logic of the case study 
4. Create a derived class using the concept of inheritance 
5. Apply polymorphism for at least 2 roles according to the case study

**Penyelesaian :** <br>

1. Membuat file Database
   ```
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
   ```
- Script ini membuat sebuah **kelas `Database`** yang berfungsi untuk mengelola koneksi ke database MySQL menggunakan ekstensi **MySQLi**. Di dalam kelas ini terdapat beberapa atribut yang digunakan untuk menyimpan informasi koneksi, seperti **host**, **username**, **password**, dan **nama database**. 

- Fungsi **constructor** otomatis dijalankan ketika kelas diinisialisasi, yang bertugas membuat koneksi ke database. Jika koneksi berhasil, objek MySQLi disimpan di atribut **$koneksi**. Jika gagal, program akan berhenti dan menampilkan pesan error.

- Script ini juga menyediakan sebuah **method `getConnection()`** yang mengembalikan koneksi ke database, sehingga bisa digunakan untuk menjalankan query. Selain itu, ada method kosong **`tampilkanData()`** yang bisa di-override oleh kelas turunan untuk menampilkan data dari database. <br>

2. Mendeklarasikan Kelas Penggantian_Pengawas
```
<?php
require_once('database.php'); // Mengimpor file 'database.php' yang berisi koneksi ke database

// Membuat kelas Penggantian Pengawas yang merupakan turunan dari kelas Database
class Penggantian_Pengawas extends Database {
    function tampilkanData() { // Method untuk menampilkan data penggantian pengawas ujian
        $query = "SELECT * FROM penggantian_pengawasan_ujian";
        $data  = $this->koneksi->query($query); // Menggunakan koneksi dari superclass

        $hasil = []; // Inisialisasi array hasil
        if ($data && $data->num_rows > 0) { // Cek apakah ada data
            while ($row = $data->fetch_assoc()) { // Mengambil data sebagai array asosiatif
                $hasil[] = $row; // Menambahkan setiap row ke array hasil
            }
        }
        return $hasil; // Mengembalikan hasil
    }
}

// Kode pengujian
$pengawas = new Penggantian_Pengawas(); // Membuat objek dari kelas LaporanKerjaLembur
$pengawas_ujian = $pengawas->tampilkanData(); // Mengambil data laporan

// Menampilkan data laporan
// echo "<pre>";
// print_r($dataLaporan); // Menampilkan data laporan
// echo "</pre>";
?>
```
- require_once('database.php'): <br>
Script ini mengimpor file database.php yang berisi pengaturan koneksi ke database. Ini memungkinkan kelas Penggantian_Pengawas untuk menggunakan koneksi tersebut tanpa harus mendeklarasikan ulang. <br>
- Deklarasi Kelas Penggantian_Pengawas: <br>
Kelas ini merupakan turunan dari kelas Database, yang berarti kelas ini mewarisi fungsi dan atribut yang sudah ada di kelas Database, terutama terkait koneksi database.
Kelas ini difokuskan untuk mengambil dan menampilkan data terkait penggantian pengawas ujian dari tabel database yang sesuai. <br>
- Method tampilkanData(): <br>
Method ini bertugas untuk menjalankan query SQL yang mengambil semua data dari tabel penggantian_pengawasan_ujian.
Query SQL yang digunakan adalah: SELECT * FROM penggantian_pengawasan_ujian, yang berarti mengambil seluruh data dari tabel tersebut.
Menggunakan objek $koneksi yang berasal dari kelas induk untuk menjalankan query di database.
Jika ada hasil yang didapatkan (melalui pengecekan $data->num_rows > 0), maka data diubah menjadi array asosiatif menggunakan fetch_assoc(), lalu disimpan dalam array $hasil. Pada akhirnya, method ini mengembalikan data dalam bentuk array hasil yang bisa diproses lebih lanjut. <br>
- Pengujian Kode: <br>
$pengawas = new Penggantian_Pengawas();: Membuat objek dari kelas Penggantian_Pengawas. Objek ini digunakan untuk mengakses method di dalam kelas tersebut.
$pengawas_ujian = $pengawas->tampilkanData();: Memanggil method tampilkanData() untuk mengambil data dari database dan menyimpannya di variabel $pengawas_ujian. <br>

3. Mendeklarasikan Kelas Laporan Kerja Lembur
```
<?php
require_once('database.php'); // Mengimpor file 'database.php' yang berisi koneksi ke database

// Membuat kelas LaporanKerjaLembur yang merupakan turunan dari kelas Database
class LaporanKerjaLembur extends Database {
    // Method untuk menampilkan semua data dari tabel 'laporan_kerja_lembur'
    function tampilkanData() {
        $query = "SELECT * FROM laporan_kerja_lembur"; // Query untuk mengambil semua data
        $data  = $this->koneksi->query($query); // Menggunakan koneksi dari superclass Database

        $hasil = []; // Inisialisasi array untuk menampung hasil
        if ($data && $data->num_rows > 0) { // Cek apakah ada data
            while ($row = $data->fetch_assoc()) { // Mengambil data sebagai array asosiatif
                $hasil[] = $row; // Menambahkan setiap row ke array hasil
            }
        }
        return $hasil; // Mengembalikan array hasil
    }
}

// Membuat objek dari kelas LaporanKerjaLembur dan memanggil method tampilkanData
$laporan       = new LaporanKerjaLembur(); 
$LaporanLembur = $laporan->tampilkanData(); // Menyimpan hasil dalam variabel $LaporanLembur

// Membuat kelas Materi yang mewarisi LaporanKerjaLembur
class Materi extends LaporanKerjaLembur {
    // Method untuk menampilkan data spesifik di mana 'uraian_pekerjaan' adalah 'Menyiapkan materi kuliah'
    function tampilkanData() {
        $query = "SELECT * FROM laporan_kerja_lembur WHERE uraian_pekerjaan = 'Menyiapkan materi kuliah'"; // Query yang difilter
        $data  = $this->koneksi->query($query); // Menggunakan koneksi dari superclass

        $hasil = []; // Inisialisasi array hasil
        if ($data && $data->num_rows > 0) { // Cek apakah ada data
            while ($row = $data->fetch_assoc()) { // Mengambil data sebagai array asosiatif
                $hasil[] = $row; // Menambahkan setiap row ke array hasil
            }
        }
        return $hasil; // Mengembalikan hasil
    }
}

// Membuat objek dari kelas Materi dan memanggil method tampilkanData
$materi    = new Materi(); 
$materi_kuliah = $materi->tampilkanData(); // Menyimpan hasil dalam variabel $materi_kuliah

// Membuat kelas riset yang mewarisi Materi
class riset extends Materi {
    // Method untuk menampilkan data spesifik di mana 'uraian_pekerjaan' adalah 'Menyusun Laporan Riset'
    function tampilkanData() {
        $query = "SELECT * FROM laporan_kerja_lembur WHERE uraian_pekerjaan = 'Menyusun Laporan Riset'"; // Query yang difilter
        $data  = $this->koneksi->query($query); // Menggunakan koneksi dari superclass

        $hasil = []; // Inisialisasi array hasil
        if ($data && $data->num_rows > 0) { // Cek apakah ada data
            while ($row = $data->fetch_assoc()) { // Mengambil data sebagai array asosiatif
                $hasil[] = $row; // Menambahkan setiap row ke array hasil
            }
        }
        return $hasil; // Mengembalikan hasil
    }
}

// Membuat objek dari kelas riset dan memanggil method tampilkanData
$riset    = new riset(); 
$laporan_riset = $riset->tampilkanData(); // Menyimpan hasil dalam variabel $laporan_riset
?>
```
Script ini mendeklarasikan tiga kelas yang masing-masing bertugas untuk mengambil data dari tabel laporan_kerja_lembur dalam database. Kelas-kelas ini saling berhubungan melalui pewarisan, di mana setiap kelas meng-override method dari kelas induknya untuk mendapatkan data spesifik. 
- require_once('database.php');: Memasukkan file yang berisi konfigurasi dan fungsi untuk menghubungkan ke database. Ini memastikan bahwa koneksi ke database tersedia untuk semua kelas yang dideklarasikan dalam script.
- Kelas LaporanKerjaLembur: Kelas ini mewarisi dari kelas Database dan memiliki method tampilkanData(). Method ini mengambil semua data dari tabel laporan_kerja_lembur dan mengembalikannya sebagai array.
- Pengambilan Data Umum: Setelah membuat objek dari kelas LaporanKerjaLembur, script memanggil method tampilkanData() untuk mendapatkan semua data dan menyimpannya dalam variabel $LaporanLembur.
- Kelas Materi: Kelas ini mewarisi dari LaporanKerjaLembur dan mengoverride method tampilkanData(). Method ini hanya mengambil data di mana uraian_pekerjaan sama dengan Menyiapkan materi kuliah.
- Pengambilan Data Spesifik Materi: Script membuat objek dari kelas Materi, memanggil method tampilkanData(), dan menyimpan hasilnya dalam variabel $materi_kuliah.
- Kelas riset: Kelas ini mewarisi dari kelas Materi dan juga mengoverride method tampilkanData(). Method ini mengambil data di mana uraian_pekerjaan sama dengan Menyusun Laporan Riset.
- Pengambilan Data Spesifik Riset: script ini membuat objek dari kelas riset, memanggil method tampilkanData(), dan menyimpan hasilnya dalam variabel $laporan_riset.

4. Menampilkan Data Laporan Pengawasan dan Lembur secara Keseluruhan (umum)
```
<?php 
require_once 'class_pengawas.php'; // Memasukkan file yang berisi class Penggantian_Pengawas

// Membuat objek dari class Penggantian_Pengawas dan mengambil data pengawas ujian
$pengawas       = new Penggantian_Pengawas();
$pengawas_ujian = $pengawas->tampilkanData(); // Memanggil method tampilkanData untuk menampilkan data pengawas ujian
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laporan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Menggunakan Bootstrap untuk styling -->
    <style>
        /* Styling tambahan untuk margin, padding, dan tampilan tabel */
        .container {
            margin-top: 40px;
            margin-bottom: 40px;
        }
        .card-header h2 {
            margin-bottom: 0;
            padding: 10px 0;
            font-size: 1.5rem;
        }
        .text-laporan {
            text-align: center;
            font-size: 2rem; 
            font-weight: bold; 
            margin-bottom: 20px;
        }
        table thead th {
            text-align: center; 
        }
    </style>
</head>

<body>
    <?php include 'index.html'; ?> <!-- Menyisipkan file index.html -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="text-laporan">DATA LAPORAN</div> <!-- Bagian judul Data Laporan -->
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h2 class="text-center">DATA PENGGANTI PENGAWASAN UJIAN</h2>
                    </div>
                    <div class="card-body">
                        <!-- Tabel untuk menampilkan data penggantian pengawas ujian -->
                        <table class="table table-bordered table-hover">
                            <thead class="table-info">
                                <tr>
                                    <th scope="col">NO.</th>
                                    <th scope="col">ID Pengganti</th>
                                    <th scope="col">Nama Pengawas Diganti</th>
                                    <th scope="col">Unit Kerja</th>
                                    <th scope="col">Hari Tanggal Penggantian</th>
                                    <th scope="col">Jam</th>
                                    <th scope="col">Ruang</th>
                                    <th scope="col">Nama Pengawas Pengganti</th>
                                    <th scope="col">Nama Dosen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Menampilkan data pengawas ujian dalam bentuk tabel
                                $no = 1; // Nomor urut
                                foreach ($pengawas_ujian as $x) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $x['id_pengganti']; ?></td>
                                        <td><?php echo $x['nama_pengawas_diganti']; ?></td>
                                        <td><?php echo $x['unit_kerja']; ?></td>
                                        <td><?php echo $x['hari_tgl_penggantian']; ?></td>
                                        <td><?php echo $x['jam']; ?></td>
                                        <td><?php echo $x['ruang']; ?></td>
                                        <td><?php echo $x['nama_pengawas_pengganti']; ?></td>
                                        <td><?php echo $x['dosen']; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
require_once 'class_lembur.php'; // Memasukkan file yang berisi class LaporanKerjaLembur

// Membuat objek dari class LaporanKerjaLembur dan mengambil data lembur
$laporan       = new LaporanKerjaLembur(); 
$LaporanLembur = $laporan->tampilkanData(); // Memanggil method tampilkanData untuk menampilkan data lembur
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h2 class="text-center">LAPORAN KERJA LEMBUR</h2>
                </div>
                <div class="card-body">
                    <!-- Tabel untuk menampilkan laporan kerja lembur -->
                    <table class="table table-bordered table-hover">
                        <thead class="table-info">
                            <tr>
                                <th scope="col">NO.</th>
                                <th scope="col">ID Lembur</th>
                                <th scope="col">Hari Tanggal</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Uraian Pekerjaan</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Nama Dosen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Menampilkan data lembur dalam bentuk tabel
                            $no = 1; // Nomor urut
                            foreach ($LaporanLembur as $x) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $x['id_lembur']; ?></td>
                                    <td><?php echo $x['hari_tgl_laporan']; ?></td>
                                    <td><?php echo $x['waktu']; ?></td>
                                    <td><?php echo $x['uraian_pekerjaan']; ?></td>
                                    <td><?php echo $x['keterangan']; ?></td>
                                    <td><?php echo $x['dosen']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script> <!-- Memasukkan Bootstrap JavaScript -->
</body>

</html>
```
Skrip ini adalah bagian dari sebuah aplikasi web yang menampilkan laporan tentang pengawas ujian dan kerja lembur. Di bagian awal, skrip memuat dua kelas: Penggantian_Pengawas dan LaporanKerjaLembur. Keduanya diimpor melalui require_once, yang memastikan bahwa file kelas hanya dimuat sekali selama eksekusi skrip.
Setelah itu, objek dari kelas Penggantian_Pengawas dibuat dan disimpan dalam variabel $pengawas. Dengan objek ini, metode tampilkanData() dipanggil untuk mengambil data pengawas ujian, yang kemudian disimpan dalam variabel $pengawas_ujian. Data ini kemudian akan ditampilkan dalam bentuk tabel di halaman web. <br>
Setelah menampilkan laporan pengawas ujian, skrip kemudian memuat kelas LaporanKerjaLembur dan membuat objek dari kelas tersebut. Dengan menggunakan objek ini, metode tampilkanData() dipanggil untuk mengambil data lembur, yang disimpan dalam variabel $LaporanLembur.

5. Menampilkan output dari kelas turunan, yaitu kelas riset, yang merupakan turunan dari kelas lain (lembur)
```
<?php 
require_once('class_lembur.php'); // Memastikan bahwa file 'class_lembur.php' di-load
// Membuat objek dari kelas UraianPekerjaan
$riset = new riset(); // Membuat instance dari kelas 'riset' untuk mengambil data riset lembur.
$laporan_riset = $riset->tampilkanData(); // Memanggil method 'tampilkanData' dari objek 'riset' untuk mendapatkan data lembur dan menyimpannya dalam variabel $laporan_riset.
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Riset</title> <!-- Judul halaman yang akan ditampilkan di tab browser -->

    <!-- Menyertakan CSS Bootstrap untuk styling -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- CSS tambahan untuk memberikan styling khusus pada elemen HTML -->
    <style>
        .container {
            margin-top: 40px; /* Memberikan jarak bagian atas pada container */
            margin-bottom: 40px; /* Memberikan jarak bagian bawah pada container */
        }

        .card-header h2 {
            margin-bottom: 0; /* Menghilangkan margin bawah judul */
            padding: 10px 0; /* Memberikan padding pada judul */
            font-size: 1.5rem; /* Mengatur ukuran font untuk judul */
        }

        table thead th {
            text-align: center; /* Mengatur teks pada header tabel agar berada di tengah */
        }

        table tbody td {
            text-align: center; /* Mengatur teks pada isi tabel agar berada di tengah */
        }
    </style>
</head>

<body>
    <!-- Menyertakan file 'index.html' -->
    <?php include 'index.html'; ?>

    <!-- Bagian utama halaman -->
    <div class="container">
        <div class="row justify-content-center"> <!-- Mengatur agar konten di tengah dengan Bootstrap grid system -->
            <div class="col-md-10"> <!-- Menggunakan grid Bootstrap dengan ukuran kolom 10 -->
                <div class="card shadow-lg"> <!-- Menggunakan card Bootstrap dengan shadow untuk tampilan -->
                    <div class="card-header bg-primary text-white"> <!-- Header card dengan background biru dan teks putih -->
                        <h2 class="text-center">LAPORAN KERJA LEMBUR</h2> <!-- Judul di tengah halaman -->
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover"> <!-- Tabel dengan border dan hover effect -->
                            <thead class="table-info"> <!-- Bagian header tabel dengan background berwarna -->
                                <tr>
                                    <th scope="col">NO.</th> <!-- Kolom untuk nomor urut -->
                                    <th scope="col">ID Lembur</th> <!-- Kolom untuk ID Lembur -->
                                    <th scope="col">Hari Tanggal</th> <!-- Kolom untuk hari dan tanggal -->
                                    <th scope="col">Waktu</th> <!-- Kolom untuk waktu lembur -->
                                    <th scope="col">Uraian Pekerjaan</th> <!-- Kolom untuk deskripsi pekerjaan -->
                                    <th scope="col">Keterangan</th> <!-- Kolom untuk keterangan tambahan -->
                                    <th scope="col">Nama Dosen</th> <!-- Kolom untuk menampilkan nama dosen -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1; // Inisialisasi variabel nomor urut
                                
                                // Looping untuk menampilkan setiap data dari $laporan_riset
                                foreach ($laporan_riset as $x) {
                                ?>
                                    <tr>
                                        <!-- Menampilkan data sesuai kolom dalam tabel -->
                                        <td><?php echo $no++; ?></td> <!-- Nomor urut bertambah setiap kali iterasi -->
                                        <td><?php echo $x['id_lembur']; ?></td> <!-- Menampilkan ID lembur -->
                                        <td><?php echo $x['hari_tgl_laporan']; ?></td> <!-- Menampilkan hari dan tanggal -->
                                        <td><?php echo $x['waktu']; ?></td> <!-- Menampilkan waktu lembur -->
                                        <td><?php echo $x['uraian_pekerjaan']; ?></td> <!-- Menampilkan uraian pekerjaan -->
                                        <td><?php echo $x['keterangan']; ?></td> <!-- Menampilkan keterangan tambahan -->
                                        <td><?php echo $x['dosen']; ?></td> <!-- Menampilkan nama dosen -->
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menyertakan Bootstrap JavaScript dan dependencies -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
```
