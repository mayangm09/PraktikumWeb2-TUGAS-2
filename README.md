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

<b>1. Membuat file Database </b>
![image](https://github.com/user-attachments/assets/77970cc4-0d58-40fd-b342-0fbc292921cb)

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

<b> 2. Gunakan _construct sebagai link ke database </b>
```
function __construct() {
        // Membuat koneksi ke database dengan menggunakan atribut yang sudah didefinisikan
        $this->koneksi = new mysqli($this->host, $this->username, $this->pass, $this->db);
```
Di dalam fungsi ini, dilakukan proses untuk membuat koneksi ke database dengan memanfaatkan class mysqli yang sudah disediakan oleh PHP. Koneksi ini dibuat menggunakan beberapa atribut yang sudah ditetapkan sebelumnya di dalam class, seperti nama host, username, password, dan nama database. Hasil dari koneksi tersebut disimpan dalam variabel $this->koneksi, sehingga bisa digunakan untuk berinteraksi dengan database, seperti menjalankan query atau mengelola data. <br> <br>
<b> 3. Terapkan enkapsulasi sesuai logika studi kasus </b>
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
```
Enkapsulasi dalam script ini diterapkan dengan cara melindungi atribut-atribut penting seperti `$host`, `$username`, `$pass`, dan `$db` menggunakan akses private, sehingga hanya bisa diakses dari dalam class `Database`. Atribut `$koneksi` diberi akses protected agar bisa diakses oleh subclass, namun tetap terlindungi dari akses luar. Selain itu, method `getConnection()` yang bersifat public memungkinkan akses terkontrol ke objek koneksi tanpa membiarkan data internal terbuka secara langsung. <br>

<b> 4. Membuat kelas turunan menggunakan konsep pewarisan </b> <br>
a) Mendeklarasikan Kelas Penggantian Pengawas
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
Kelas Penggantian_Pengawas merupakan turunan dari kelas Database, yang berarti bahwa ia mewarisi semua atribut dan metode yang ada di kelas Database. Dengan pewarisan ini, kelas Penggantian_Pengawas dapat menggunakan koneksi database yang telah didefinisikan di kelas Database tanpa harus mendefinisikannya ulang. Pewarisan ini memungkinkan pengorganisasian kode yang lebih baik, karena kode yang umum dapat ditempatkan di kelas induk, sedangkan kode yang spesifik dapat didefinisikan di kelas turunan

b) Mendeklarasikan Kelas Laporan Kerja Lembur
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
```
Script ini mengimpor file `database.php`, yang berisi class `Database` dengan koneksi ke database. Class `LaporanKerjaLembur` didefinisikan sebagai turunan dari class `Database`, sehingga mewarisi semua properti dan metode yang ada di dalamnya, termasuk koneksi ke database. Di dalam class ini, terdapat metode `tampilkanData()`, yang digunakan untuk mengambil seluruh data dari tabel `laporan_kerja_lembur` menggunakan query SQL. Hasil query disimpan dalam variabel dan diolah menjadi array asosiatif, kemudian dikembalikan sebagai hasil. Di akhir script, objek `LaporanKerjaLembur` dibuat dan metode `tampilkanData()` dipanggil untuk mendapatkan data dari tabel tersebut. <br> <br>
c) Mendeklarasikan Kelas Selesai
```
class Selesai extends LaporanKerjaLembur {
    // Method untuk menampilkan data spesifik di mana 'uraian_pekerjaan' adalah 'Menyiapkan materi kuliah'
    function tampilkanData() {
        $query = "SELECT * FROM laporan_kerja_lembur WHERE keterangan = 'Selesai'"; // Query yang difilter
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
$selesai    = new Selesai(); 
$selesai_lembur = $selesai->tampilkanData();
```
Class Selesai mewarisi dari class LaporanKerjaLembur, yang berarti class Selesai memiliki akses ke semua properti dan metode yang ada di LaporanKerjaLembur, termasuk koneksi database yang telah didefinisikan <br> <br>
d) Mendeklarasikan Kelas Belum Selesai
```
class Belum_Selesai extends Selesai {
    // Method untuk menampilkan data spesifik di mana 'uraian_pekerjaan' adalah 'Menyusun Laporan Riset'
    function tampilkanData() {
        $query = "SELECT * FROM laporan_kerja_lembur WHERE keterangan = 'Belum Selesai'"; // Query yang difilter
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
$belum_selesai    = new Belum_Selesai(); 
$belum_lembur = $belum_selesai->tampilkanData(); // Menyimpan hasil dalam variabel $laporan_riset
```
Class Belum_Selesai adalah contoh penerapan konsep pewarisan yang lebih lanjut, di mana class ini mewarisi dari class Selesai. Dengan cara ini, Belum_Selesai mendapatkan semua atribut dan metode yang ada di class Selesai, termasuk koneksi ke database.

Konsep pewarisan memungkinkan class Belum_Selesai untuk menggunakan dan mengubah fungsi yang sudah ada tanpa perlu mendefinisikannya kembali. Dalam hal ini, Belum_Selesai mengoverride metode tampilkanData() dari class Selesai untuk menyesuaikan query yang diinginkan. Class ini mengambil data dengan kondisi spesifik, yaitu hanya data dengan keterangan 'Belum Selesai', sehingga fungsionalitas di dalam class turunan lebih spesifik dan sesuai dengan kebutuhan. <br>

<b>5. Terapkan polimorfisme untuk minimal 2 peran sesuai studi kasus </b> <br>
a) Pada tabel/ kelas Laporan Kerja Lembur
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
class Selesai extends LaporanKerjaLembur {
    // Method untuk menampilkan data spesifik di mana 'uraian_pekerjaan' adalah 'Menyiapkan materi kuliah'
    function tampilkanData() {
        $query = "SELECT * FROM laporan_kerja_lembur WHERE keterangan = 'Selesai'"; // Query yang difilter
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
$selesai    = new Selesai(); 
$selesai_lembur = $selesai->tampilkanData(); // Menyimpan hasil dalam variabel $materi_kuliah

// Membuat kelas riset yang mewarisi Materi
class Belum_Selesai extends Selesai {
    // Method untuk menampilkan data spesifik di mana 'uraian_pekerjaan' adalah 'Menyusun Laporan Riset'
    function tampilkanData() {
        $query = "SELECT * FROM laporan_kerja_lembur WHERE keterangan = 'Belum Selesai'"; // Query yang difilter
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
$belum_selesai    = new Belum_Selesai(); 
$belum_lembur = $belum_selesai->tampilkanData(); // Menyimpan hasil dalam variabel $laporan_riset
?>

```
Polimorfisme dalam kode ini terlihat melalui metode tampilkanData() yang ada pada kelas LaporanKerjaLembur, Selesai, dan Belum_Selesai. Kelas Selesai mewarisi dari kelas LaporanKerjaLembur, sehingga ia memiliki akses ke semua metode dari kelas induk. Namun, kelas Selesai mengoverride metode tampilkanData() untuk menampilkan data yang spesifik, yaitu hanya data dengan keterangan 'Selesai'.Begitu pula, kelas Belum_Selesai, yang mewarisi dari kelas Selesai, juga mengoverride metode tampilkanData() untuk mengambil data dengan keterangan 'Belum Selesai'.Dengan cara ini, meskipun ketiga kelas memiliki metode dengan nama yang sama, implementasinya berbeda. Ketika metode tampilkanData() dipanggil dari objek kelas Selesai, hasil yang didapat adalah data yang telah difilter untuk keterangan 'Selesai', sementara panggilan dari objek kelas Belum_Selesai akan mengembalikan data dengan keterangan 'Belum Selesai'. <br><br>

<b>6. Dashboard Laporan Kerja Lembur dan Pengawasan </b> <br>
```
<?php 
require_once 'class_lembur.php'; // Memasukkan file yang berisi class LaporanKerjaLembur

// Membuat objek dari class LaporanKerjaLembur dan mengambil data lembur
$laporan       = new LaporanKerjaLembur(); 
$LaporanLembur = $laporan->tampilkanData(); // Memanggil method tampilkanData untuk menampilkan data lembur
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
    <?php include 'beranda.html'; ?> <!-- Menyisipkan file index.html -->
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="text-laporan">DATA LAPORAN</div> <!-- Bagian judul Data Laporan -->
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
<?php 
require_once 'class_pengawas.php'; // Memasukkan file yang berisi class Penggantian_Pengawas
// Membuat objek dari class Penggantian_Pengawas dan mengambil data pengawas ujian
$pengawas       = new Penggantian_Pengawas();
$pengawas_ujian = $pengawas->tampilkanData(); // Memanggil method tampilkanData untuk menampilkan data pengawas ujian
?>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
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

<script src="js/bootstrap.bundle.min.js"></script> <!-- Memasukkan Bootstrap JavaScript -->
</body>

</html>
```
Script PHP ini mengatur tampilan data laporan lembur dan data pengganti pengawasan ujian dengan memanfaatkan dua kelas yang terpisah untuk masing-masing jenis laporan. Pertama, file yang berisi kelas LaporanKerjaLembur diimpor, memungkinkan pembuatan objek untuk mengakses dan menampilkan data lembur. Setelah itu, metode tampilkanData() dipanggil untuk mengambil data lembur yang diperlukan, yang kemudian disimpan dalam variabel $LaporanLembur.Setelah tabel laporan lembur, script memuat kelas Penggantian_Pengawas, membuat objek dari kelas ini, dan memanggil metode tampilkanData() untuk mengambil data pengawas ujian. Data tersebut kemudian disajikan dalam tabel kedua dengan format yang sama. Struktur tabel ini mencakup informasi seperti ID pengganti, nama pengawas yang diganti, unit kerja, tanggal penggantian, jam, ruang, nama pengawas pengganti, dan nama dosen. <br><br>
**Output :** <br>
![image](https://github.com/user-attachments/assets/3c357251-864d-4fd9-8a20-b45c2f15d3ec)

<b>7. User Role Dosen </b> <br>
a) Membuat filter pada tabel Laporan Kerja lembur, dengan mengambil kolom keterangan yang bernilia "Selesai"
```
function tampilkanData() {
        $query = "SELECT * FROM laporan_kerja_lembur WHERE keterangan = 'Selesai'"; // Query yang difilter
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

$selesai    = new Selesai(); 
$selesai_lembur = $selesai->tampilkanData(); 
```
ketika metode tampilkanData() dipanggil pada objek Selesai. Metode ini berisi query yang difilter, yang hanya mengambil data dari tabel laporan_kerja_lembur dengan keterangan 'Selesai'. Proses pengambilan data hanya akan menghasilkan laporan yang sesuai dengan kriteria yang ditetapkan. <br><br>
b) Membuat filter pada tabel Laporan Kerja lembur, dengan mengambil kolom keterangan yang bernilia "Selesai"
```
// Membuat kelas Belum_Selesai yang mewarisi Selesai
class Belum_Selesai extends Selesai {
    // Method untuk menampilkan data spesifik di mana 'uraian_pekerjaan' adalah 'Menyusun Laporan Riset'
    function tampilkanData() {
        $query = "SELECT * FROM laporan_kerja_lembur WHERE keterangan = 'Belum Selesai'"; // Query yang difilter
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
$belum_selesai    = new Belum_Selesai(); 
$belum_lembur = $belum_selesai->tampilkanData(); // Menyimpan hasil dalam variabel $laporan_riset
?>
```
Proses polimorfisme terjadi ketika metode dengan nama yang sama, yaitu tampilkanData(), menghasilkan perilaku yang berbeda sesuai dengan kelas yang memanggilnya. Meskipun kelas Belum_Selesai mewarisi seluruh struktur dari kelas Selesai, termasuk koneksi ke database, query yang dijalankan berbeda karena implementasi yang telah diubah dalam metode tersebut. Hasilnya, metode ini bisa digunakan untuk mengambil data yang lebih spesifik berdasarkan kondisi yang ditetapkan di masing-masing kelas <br><br>
**Output :** <br>
![image](https://github.com/user-attachments/assets/f24f9c51-dddb-4ebd-9ba4-ae88732fbd4d)
![image](https://github.com/user-attachments/assets/822f57f7-10fe-4ce1-b3d1-7bebf73e6657)
![image](https://github.com/user-attachments/assets/cd7a3133-74cb-451f-967f-cc410f9d519a)

<b>8. User Role Admin </b> <br>
```
```


