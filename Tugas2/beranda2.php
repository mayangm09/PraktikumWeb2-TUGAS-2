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
    <?php include 'beranda2.html'; ?> <!-- Menyisipkan file index.html -->
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