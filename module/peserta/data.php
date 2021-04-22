<div class="buttons mb-4 d-flex justify-content-end">
    <button id="add-button" class="btn btn-primary mr-3">Tambah</button>
</div>

<table border="1" cellspacing="0" cellpadding="0" id="data-table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Siswa</th>
            <th>Ekstrakurikuler</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php

   require "../../inc/functions.php";
   $no=1;

   $where = ($_SESSION['status'] != 'admin') ? "WHERE ex.id_pengurus='$_SESSION[userid]'" : "";
   $peserta = $db->get_results("SELECT ps.*, sw.nama as siswa, ex.nama as ekskul FROM peserta ps LEFT JOIN siswa sw ON ps.id_siswa=sw.id LEFT JOIN ekskul ex ON ps.id_ekskul=ex.id $where ORDER BY ex.nama");

    if ($peserta) :
       foreach ($peserta as $pst) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $pst->siswa; ?></td>
            <td><?= $pst->ekskul; ?></td>
            <td>
                <button id="edit-button" class="btn btn-sm btn-warning" data-id="<?= $pst->id; ?>">Edit</button>
                <button id="delete-button" class="btn btn-sm btn-danger" data-id="<?= $pst->id; ?>" data-action="peserta_hapus" data-token="<?= $_SESSION['token'] ?>">Hapus</button>
            </td>
        </tr>
    <?php endforeach;
    else: ?>
        <tr>
            <td colspan="4" style="text-align:center;">Tidak ada data</td>
        </tr>
    <?php endif; ?>

    </tbody>
</table>

<script>
    $('#data-table').DataTable();
</script>