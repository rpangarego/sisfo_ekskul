<div class="buttons mb-4 d-flex justify-content-end">
    <?php
        session_start();
        if ($_SESSION['status'] != 'kepsek' && $_SESSION['status'] != 'siswa'): ?>
            <button id="add-button" class="btn btn-primary mr-3">Tambah</button>
        <?php endif ?>

        <?php if ($_SESSION['status'] == 'siswa'): ?>
            <a href="index?m=daftar_ekskul" class="btn btn-primary mr-3">Daftar Eksktrakurikuler</a>
        <?php endif ?>


    <?php if ($_SESSION['status'] == 'kepsek' || $_SESSION['status'] == 'wakepsek'): ?>
        <a href="inc/reports/print_report" class="btn btn-secondary" target="_blank">Cetak Laporan</a>
    <?php endif ?>
</div>

<table border="1" cellspacing="0" cellpadding="0" id="data-table" class="table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>Eksktrakurikuler</th>
            <th>Jadwal</th>
            <th>Pengurus</th>

            <?php if ($_SESSION['status'] == 'siswa') : ?>
            <th>Status Verifikasi</th>
            <?php endif ?>

            <?php if ($_SESSION['status'] != 'siswa') : ?>
            <th>Jumlah Peserta</th>
            <?php endif ?>

            <th>Wajib</th>

            <?php if ($_SESSION['status'] != 'kepsek' && $_SESSION['status'] != 'siswa'): ?>
                <th>Aksi</th>
            <?php endif ?>

        </tr>
    </thead>
    <tbody>

    <?php
    require "../../inc/functions.php";

    $where = ($_SESSION['status'] == 'siswa') ? "WHERE ps.id_siswa='$_SESSION[userid]'" : "";

    $no=1;
    $query_sql = "SELECT e.*, pg.nama AS nama_pengurus, count(ps.id) as jml_peserta FROM ekskul e LEFT JOIN pengurus pg ON e.id_pengurus=pg.id LEFT JOIN peserta ps ON e.id=ps.id_ekskul $where GROUP BY e.id ORDER BY wajib DESC";

    if ($_SESSION['status'] == 'siswa') {
        $query_sql = "SELECT e.*, pg.nama AS nama_pengurus, ps.verifikasi FROM ekskul e JOIN pengurus pg ON e.id_pengurus=pg.id JOIN peserta ps ON e.id=ps.id_ekskul $where";
    }

    $ekskul =  $db->get_results($query_sql);

    if ($ekskul) :
       foreach ($ekskul as $eks) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $eks->nama; ?></td>
            <td><?= $eks->jadwal; ?></td>
            <td><?= $eks->nama_pengurus; ?></td>

            <?php if ($_SESSION['status'] == 'siswa') : ?>
                <td align="center"><?= ucwords($eks->verifikasi); ?></td>
            <?php endif ?>

            <?php if ($_SESSION['status'] != 'siswa') : ?>
            <td align="center"><?= $eks->jml_peserta; ?></td>
            <?php endif ?>

            <td><?= ucwords($eks->wajib); ?></td>

            <?php if ($_SESSION['status'] != 'kepsek' && $_SESSION['status'] != 'siswa'): ?>
            <td>
                <button id="edit-button" class="btn btn-sm btn-warning" data-id="<?= $eks->id; ?>">Edit</button>
                <button id="delete-button" class="btn btn-sm btn-danger" data-id="<?= $eks->id; ?>" data-action="ekskul_hapus" data-token="<?= $_SESSION['token'] ?>">Hapus</button>
            </td>
            <?php endif ?>

        </tr>
    <?php endforeach;
    else: ?>
        <tr>
            <td colspan="7" style="text-align:center;">Tidak ada data</td>
        </tr>
    <?php endif; ?>

    </tbody>
</table>

<script>
    $('#data-table').DataTable();
</script>