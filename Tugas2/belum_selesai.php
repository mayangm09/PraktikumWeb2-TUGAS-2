<?php 
require_once('class_lembur.php'); // Memastikan file 'class_lembur.php' di-load 

// Membuat objek baru dari kelas Belum_Selesai untuk mengakses data laporan kerja lembur yang belum selesai
$belum_selesai = new Belum_Selesai(); 

// Memanggil metode tampilkanData() dari objek $belum_selesai untuk mengambil data dengan keterangan 'Belum Selesai'
// Hasilnya disimpan dalam variabel $belum_lembur
$belum_lembur = $belum_selesai->tampilkanData(); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Keterangan</title> <!-- Judul halaman web yang ditampilkan pada tab browser -->

    <!-- Link ke Bootstrap CSS untuk tata letak yang rapi dan modern -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- CSS tambahan untuk styling kustom -->
    <style>
        /* Mengatur margin pada container di bagian atas dan bawah */
        .container {
            margin-top: 40px;
            margin-bottom: 40px;
        }

        /* Styling header pada elemen card */
        .card-header h2 {
            margin-bottom: 0; /* Menghilangkan margin bawah agar judul tidak terlalu jauh dari tepi */
            padding: 10px 0; /* Menambah padding untuk memberikan ruang */
            font-size: 1.5rem; /* Mengatur ukuran font untuk judul */
        }

        /* Menyelaraskan teks pada header tabel agar berada di tengah */
        table thead th {
            text-align: center;
        }

        /* Menyelaraskan teks pada isi tabel agar berada di tengah */
        table tbody td {
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Menyertakan file index.html -->
    <?php include 'beranda2.html'; ?>

    <!-- Bagian utama konten halaman -->
    <div class="container">
        <div class="row justify-content-center"> <!-- Menggunakan Bootstrap grid untuk membuat tata letak yang responsif dan terpusat -->
            <div class="col-md-10"> <!-- Kolom berukuran 10 di grid Bootstrap -->
                <div class="card shadow-lg"> <!-- Menggunakan card Bootstrap dengan efek bayangan untuk tampilan -->
                    <div class="card-header bg-primary text-white"> <!-- Header card dengan background biru dan teks berwarna putih -->
                        <h2 class="text-center">LAPORAN KERJA LEMBUR</h2> <!-- Judul di tengah halaman -->
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover"> <!-- Membuat tabel dengan border dan efek hover -->
                            <thead class="table-info"> <!-- Menyusun header tabel dengan warna latar belakang info -->
                                <tr>
                                    <th scope="col">NO.</th> <!-- Kolom untuk nomor urut -->
                                    <th scope="col">ID Lembur</th> <!-- Kolom untuk ID lembur -->
                                    <th scope="col">Hari Tanggal</th> <!-- Kolom untuk hari dan tanggal lembur -->
                                    <th scope="col">Waktu</th> <!-- Kolom untuk waktu lembur -->
                                    <th scope="col">Uraian Pekerjaan</th> <!-- Kolom untuk deskripsi pekerjaan -->
                                    <th scope="col">Keterangan</th> <!-- Kolom untuk keterangan tambahan -->
                                    <th scope="col">Nama Dosen</th> <!-- Kolom untuk menampilkan nama dosen -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1; // Inisialisasi variabel nomor urut
                                
                                // Looping melalui data yang diambil dari $materi_kuliah
                                foreach ($belum_lembur as $x) {
                                ?>
                                    <tr>
                                        <!-- Menampilkan data sesuai kolom dalam tabel -->
                                        <td><?php echo $no++; ?></td> <!-- Nomor urut bertambah setiap kali iterasi -->
                                        <td><?php echo $x['id_lembur']; ?></td> <!-- Menampilkan ID lembur dari array -->
                                        <td><?php echo $x['hari_tgl_laporan']; ?></td> <!-- Menampilkan hari dan tanggal lembur -->
                                        <td><?php echo $x['waktu']; ?></td> <!-- Menampilkan waktu lembur -->
                                        <td><?php echo $x['uraian_pekerjaan']; ?></td> <!-- Menampilkan deskripsi pekerjaan -->
                                        <td><?php echo $x['keterangan']; ?></td> <!-- Menampilkan keterangan tambahan -->
                                        <td><?php echo $x['dosen']; ?></td> <!-- Menampilkan nama dosen terkait lembur -->
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

    <!-- Bootstrap JavaScript dependencies untuk interaktivitas -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
