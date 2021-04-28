<?php 
    session_start();

    if ($_SESSION['status'] == 'pengurus'): ?>
    <div class="buttons mb-4 d-flex justify-content-end">
        <button id="add-button" class="btn btn-primary mr-3">Tambah</button>
    </div>
<?php endif ?>

    <?php if ($_SESSION['status'] == 'kepsek' || $_SESSION['status'] == 'wakepsek'): ?>
        <div class="buttons mb-4 d-flex justify-content-end">
            <a href="inc/reports/print_report" class="btn btn-secondary" target="_blank">Cetak Laporan</a>
        </div>
    <?php endif ?>

<table border="1" cellspacing="0" cellpadding="0" id="data-table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Eksktrakurikuler</th>
            <th>Pengurus</th>

            <?php if ($_SESSION['status'] != 'siswa') : ?>
                <th>Peserta yang hadir</th>
                <th>Aksi</th>
            <?php endif ?>
        </tr>
    </thead>
    <tbody>
        <?php

    require "../../inc/functions.php";
    $no=1;

    $where = ($_SESSION['status'] == 'pengurus') ? "WHERE pgr.id='$_SESSION[userid]'" : "";

    $presensi = $db->get_results("SELECT pr.*, ex.nama as ekskul, pgr.id as id_pengurus, pgr.nama as pengurus, count(pr.id_siswa) as siswa_hadir FROM presensi pr LEFT JOIN ekskul ex ON pr.id_ekskul=ex.id LEFT JOIN pengurus pgr ON ex.id_pengurus=pgr.id $where GROUP BY pr.tanggal, pr.id_ekskul ORDER BY pr.id_ekskul, pr.tanggal DESC");

    // echo "SELECT pr.*, ex.nama as ekskul, pgr.id as id_pengurus, pgr.nama as pengurus, count(pr.id_siswa) as siswa_hadir FROM presensi pr LEFT JOIN ekskul ex ON pr.id_ekskul=ex.id LEFT JOIN pengurus pgr ON ex.id_pengurus=pgr.id $where GROUP BY pr.tanggal, pr.id_ekskul ORDER BY pr.id_ekskul, pr.tanggal DESC";

    if ($presensi) :
       foreach ($presensi as $prs) : ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?= date('d F Y', strtotime($prs->tanggal)); ?></td>
            <td><?= $prs->ekskul; ?></td>
            <td><?= $prs->pengurus; ?></td>

            <?php if ($_SESSION['status'] != 'siswa') : ?>
            <td><?= $prs->siswa_hadir; ?> Orang</td>
            <td>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalPresensi<?=$no?>">Detail</button>

                <?php if ($_SESSION['status'] == 'pengurus'): ?>
                    <a href="actions?action=presensi_hapus&id_ekskul=<?= $prs->id_ekskul; ?>&tanggal=<?= $prs->tanggal; ?>" class="btn btn-sm btn-danger">Hapus</a>
                <?php endif ?>
            </td>
            <?php endif; ?>
        </tr>

    <?php $no++; endforeach;
    else: ?>
        <tr>
            <td colspan="6" style="text-align:center;">Tidak ada data</td>
        </tr>
    <?php endif; ?>

    </tbody>
</table>

<?php include '../../inc/partials/presensiModal.php'; ?>

<script>
    $('#data-table').DataTable();
</script>