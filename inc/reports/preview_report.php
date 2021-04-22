<?php 
    require_once '../functions.php';

    if (isset($_POST["laporan"])) {
        if ($_POST["laporan"] == 'ekskul') {

            $query = "SELECT ex.*, sw.nama as nama_peserta, sw.kelas, pgr.nama as pengurus FROM ekskul ex LEFT JOIN peserta ps ON ps.id_ekskul=ex.id LEFT JOIN siswa sw ON ps.id_siswa=sw.id LEFT JOIN pengurus pgr ON ex.id_pengurus=pgr.id WHERE ex.id='$_POST[ekskul]'";
        
        }
    }

    $results = $db->get_results($query);
?>

<div id="preview-data-report">
    <h2 align="center" class="mb-4">Preview Laporan</h2>

    <table class="table table-bordered table-resposive">

        <?php if ($_POST["laporan"] != 'ekstrakurikuler'): ?>
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
            
        <?php endif ?>


    </table>
</div>