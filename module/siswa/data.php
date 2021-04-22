<div class="buttons mb-4 d-flex justify-content-end">
    <button id="add-button" class="btn btn-primary mr-3">Tambah</button>
</div>

<table border="1" cellspacing="0" cellpadding="0" id="data-table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>No Telepon/Hp</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php

   require "../../inc/functions.php";
   $no=1;
   $students = $db->get_results("SELECT * FROM siswa ORDER BY kelas, nama");

    if ($students) :
       foreach ($students as $student) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $student->nama; ?></td>
            <td><?= $student->kelas; ?></td>
            <td><?= $student->nohp; ?></td>
            <td>
                <button id="edit-button" class="btn btn-sm btn-warning" data-id="<?= $student->id; ?>">Edit</button>
                <button id="delete-button" class="btn btn-sm btn-danger" data-id="<?= $student->id; ?>" data-action="siswa_hapus" data-token="<?= $_SESSION['token'] ?>">Hapus</button>
            </td>
        </tr>
    <?php endforeach;
    else: ?>
        <tr>
            <td colspan="5" style="text-align:center;">Tidak ada data</td>
        </tr>
    <?php endif; ?>

    </tbody>
</table>

<script>
    $('#data-table').DataTable();
</script>