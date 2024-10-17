<?php 
require_once('class_lembur.php'); // Memastikan bahwa file 'class_lembur.php' di-load
// Membuat objek dari kelas UraianPekerjaan
$selesai    = new Selesai(); 
$selesai_lembur = $selesai->tampilkanData();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Keterangan</title> <!-- Judul halaman yang akan ditampilkan di tab browser -->

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
    <?php include 'beranda2.html'; ?>

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
                                foreach ($selesai_lembur as $x) {
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
