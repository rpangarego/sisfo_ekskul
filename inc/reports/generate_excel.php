<?php 
    require_once '../functions.php';

    $judul = ($_GET["laporan"] == 'ekskul') ? "Ekstrakurikuler" : "Presensi";

    if (isset($_GET['export_excel']) && $_GET['export_excel'] == 'true') {
        header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=Laporan ".$judul.".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
    }

    if (isset($_GET["laporan"])) {
        if ($_GET["laporan"] == 'ekskul') {
            $query = "SELECT ex.*, sw.nama as nama_peserta, sw.kelas, pgr.nama as pengurus FROM ekskul ex LEFT JOIN peserta ps ON ps.id_ekskul=ex.id LEFT JOIN siswa sw ON ps.id_siswa=sw.id LEFT JOIN pengurus pgr ON ex.id_pengurus=pgr.id WHERE ex.id='$_GET[ekskul]'";
        
        } elseif ($_GET["laporan"] == 'presensi') {
            if ($_GET['tanggal'] == 'semua') {
                $query = "SELECT pr.*, count(pr.id) AS siswa_hadir, ex.nama as ekskul, pgr.id as id_pengurus, pgr.nama as pengurus, sw.nama as nama_siswa, sw.kelas as kelas_siswa FROM presensi pr 
                    LEFT JOIN ekskul ex ON pr.id_ekskul=ex.id 
                    LEFT JOIN pengurus pgr ON ex.id_pengurus=pgr.id 
                    LEFT JOIN siswa sw ON pr.id_siswa=sw.id WHERE
                    pr.id_ekskul='$_GET[ekskul]' GROUP BY pr.tanggal ORDER BY pr.tanggal,sw.nama ASC";
            } else {
                $query = "SELECT pr.*, ex.nama as ekskul, pgr.id as id_pengurus, pgr.nama as pengurus, sw.nama as nama_siswa, sw.kelas as kelas_siswa FROM presensi pr 
                    LEFT JOIN ekskul ex ON pr.id_ekskul=ex.id 
                    LEFT JOIN pengurus pgr ON ex.id_pengurus=pgr.id 
                    LEFT JOIN siswa sw ON pr.id_siswa=sw.id
                    WHERE pr.tanggal='$_GET[tanggal]' AND pr.id_ekskul='$_GET[ekskul]' ORDER BY sw.nama ASC";
            }
        }
    } 

    $results = $db->get_results($query);
?>

<div id="preview-data-report">
    <h2 align="center" class="mb-4">Laporan <?= $judul ?></h2>

    <table class="table table-bordered table-resposive">

        <!-- PREVIEW TABEL EKSTRAKURIKULER -->
        <?php if ($_GET["laporan"] == 'ekskul'): ?>
            <thead>
                <tr>
                    <th>Ekstrakurikuler</th><th>:</th><th><?= $results[0]->nama ?></th>
                </tr>
                <tr>
                    <th>Jadwal</th><th>:</th><th><?= $results[0]->jadwal ?></th>
                </tr>
                <tr>
                    <th>Pengurus</th><th>:</th><th><?= $results[0]->pengurus ?></th>
                </tr>
                <tr><td colspan="3"></td></tr>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama Peserta</th>
                    <th scope="col">Kelas</th>
                </tr>
            </thead>
            <tbody>
                
                <?php if (count($results) >= 2): ?>
                    <?php foreach ($results as $result): ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= $result->nama_peserta ?></td>
                            <td><?= $result->kelas ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr><td class="text-center" colspan="3">Tidak ada data</td></tr>
                <?php endif ?>

            </tbody>

        <?php else: ?>
            
            <!-- PREVIEW TABEL PRESENSI -->
                <thead>
                    <tr>
                        <th>Ekstrakurikuler</th><th>:</th><th colspan="2"><?= $results[0]->ekskul ?></th>
                    </tr>
                    <tr>
                        <th>Pengurus</th><th>:</th><th colspan="2"><?= $results[0]->pengurus ?></th>
                    </tr>

                    <!-- PREVIEW DATA PRESENSI SEMUA TANGGAL -->
                    <?php if ($_GET['tanggal'] == 'semua'): ?>
                        <tr><td colspan="3"></td></tr>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jumlah Siswa Hadir</th>
                        </tr>

                    <?php else: ?>

                    <!-- PREVIEW DATA PRESENSI SPESIFIK TANGGAL -->
                        <tr>
                            <th>Tanggal</th><th>:</th><th colspan="2"><?= date('d F Y', strtotime($results[0]->tanggal)); ?></th>
                        </tr>
                        <tr><td colspan="4"></td></tr>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Peserta</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Hadir</th>
                        </tr>
                    <?php endif ?>
                </thead>
            <tbody>

                <?php if (count($results) >= 2): ?>
                    <?php foreach ($results as $result): ?>
                        <tr>
                            <td><?= ++$i ?></td>

                            <!-- tanggal, jumlah siswa -->
                            <?php if ($_GET['tanggal'] == 'semua'): ?>
                                <td><?= $result->tanggal ?></td>
                                <td><?= $result->siswa_hadir ?></td>

                            <!-- nama peserta, kelas, hadir -->
                            <?php else: ?>
                                <td><?= $result->nama_siswa ?></td>
                                <td><?= $result->kelas_siswa ?></td>
                                <td><?= ucwords($result->hadir) ?></td>
                            <?php endif ?>

                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr><td class="text-center" colspan="4">Tidak ada data</td></tr>
                <?php endif ?> 

            </tbody>
        
        <?php endif ?>

    </table>
</div>