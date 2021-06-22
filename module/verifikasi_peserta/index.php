<a href="index?m=peserta" class="text-primary">Kembali</a>

<h1>Verifikasi Peserta Ekstrakurikuler</h1>
<div class="alert-container"></div>

<div id="content-data">
    <table border="1" cellspacing="0" cellpadding="0" id="data-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Siswa</th>
                <th>Kelas</th>
                <th>Ekstrakurikuler</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

    <?php $no=1;

    $where = "WHERE ps.verifikasi<>'ya' ";
    $where .= ($_SESSION['status'] != 'admin') ? "AND ex.id_pengurus='$_SESSION[userid]'" : "";
    $peserta = $db->get_results("SELECT ps.*, sw.nama as siswa, sw.kelas, ex.nama as ekskul FROM peserta ps LEFT JOIN siswa sw ON ps.id_siswa=sw.id LEFT JOIN ekskul ex ON ps.id_ekskul=ex.id $where ORDER BY sw.kelas, sw.nama, ex.nama ASC");

        if ($peserta) :
        foreach ($peserta as $pst) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $pst->siswa; ?></td>
                <td><?= $pst->kelas; ?></td>
                <td><?= $pst->ekskul; ?></td>
                <td><?= ucwords($pst->verifikasi); ?></td>
                <td>
                    <?php if ($pst->verifikasi == 'tidak') { ?>
                        <a href="actions?action=verifikasi_peserta&status=pending&id_siswa=<?= $pst->id_siswa ?>&id_ekskul=<?= $pst->id_ekskul ?>" class="btn btn-sm btn-warning">Verifikasi Ulang</a>
                    <?php } else { ?>
                        <a href="actions?action=verifikasi_peserta&status=ya&id_siswa=<?= $pst->id_siswa ?>&id_ekskul=<?= $pst->id_ekskul ?>" class="btn btn-sm btn-success">Ya</a>
                        <a href="actions?action=verifikasi_peserta&status=tidak&id_siswa=<?= $pst->id_siswa ?>&id_ekskul=<?= $pst->id_ekskul ?>" class="btn btn-sm btn-danger">Tidak</a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach;
        else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">Tidak ada data</td>
            </tr>
        <?php endif; ?>

        </tbody>
    </table>

    <script>
        $('#data-table').DataTable();
    </script>
</div>
