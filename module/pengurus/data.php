<div class="buttons mb-4 d-flex justify-content-end">
    <button id="add-button" class="btn btn-primary mr-3">Tambah</button>
</div>

<table border="1" cellspacing="0" cellpadding="0" id="data-table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Pengurus</th>
            <th>No Telepon/Hp</th>
            <th>Ekstrakurikuler</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php

   require "../../inc/functions.php";
   $no=1;
   $pengurus = $db->get_results("SELECT pengurus.*, ekskul.nama AS nama_ekskul FROM pengurus LEFT JOIN ekskul ON pengurus.id=ekskul.id_pengurus ORDER BY pengurus.nama");

    if ($pengurus) :
       foreach ($pengurus as $pgr) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $pgr->nama; ?></td>
            <td><?= $pgr->nohp; ?></td>
            <td><?= $pgr->nama_ekskul; ?></td>
            <td>
                <button id="edit-button" class="btn btn-sm btn-warning" data-id="<?= $pgr->id; ?>">Edit</button>
                <button id="delete-button" class="btn btn-sm btn-danger" data-id="<?= $pgr->id; ?>" data-action="pengurus_hapus" data-token="<?= $_SESSION['token'] ?>">Hapus</button>
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