<?php 
    require_once '../functions.php';

    if (isset($_POST["laporan"])) {
        if ($_POST["laporan"] == 'ekskul') {
            $query = "SELECT ex.*, sw.nama as nama_peserta, sw.kelas, pgr.nama as pengurus FROM ekskul ex LEFT JOIN peserta ps ON ps.id_ekskul=ex.id LEFT JOIN siswa sw ON ps.id_siswa=sw.id LEFT JOIN pengurus pgr ON ex.id_pengurus=pgr.id WHERE ex.id='$_POST[id_ekskul]'";
        
        } elseif ($_POST["laporan"] == 'presensi') {
            $query = "SELECT pr.*, ex.nama as ekskul, pgr.id as id_pengurus, pgr.nama as pengurus, sw.nama as nama_siswa, sw.kelas as kelas_siswa FROM presensi pr 
                    LEFT JOIN ekskul ex ON pr.id_ekskul=ex.id 
                    LEFT JOIN pengurus pgr ON ex.id_pengurus=pgr.id 
                    LEFT JOIN siswa sw ON pr.id_siswa=sw.id
                    WHERE pr.tanggal='$_POST[tanggal]' AND pr.id_ekskul='$_POST[id_ekskul]' ORDER BY sw.nama ASC";
        }
    } 

    $results = $db->get_results($query);
    $judul = ($_POST["laporan"] == 'ekskul') ? "Ekstrakurikuler" : "Presensi";
?>

<div id="preview-data-report">
    <h2 align="center" class="mb-4">Preview Laporan <?= $judul ?></h2>

    <table class="table table-bordered table-resposive">

        <!-- PREVIEW TABEL EKSTRAKURIKULER -->
        <?php if ($_POST["laporan"] == 'ekskul'): ?>
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
            </thead>
            <tbody>

                <?php if (count($results) >= 2): ?>
                    <?php foreach ($results as $result): ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= $result->nama_siswa ?></td>
                            <td><?= $result->kelas_siswa ?></td>
                            <td><?= ucwords($result->hadir) ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr><td class="text-center" colspan="4">Tidak ada data</td></tr>
                <?php endif ?> 

            </tbody>

        
        <?php endif ?>

    </table>
</div>