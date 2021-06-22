<div class="buttons mb-4 d-flex justify-content-end">
    <button id="add-button" class="btn btn-primary mr-3">Tambah</button>
</div>

<table border="1" cellspacing="0" cellpadding="0" id="data-table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Username</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php

   require "../../inc/functions.php";
   $no=1;
   $users = $db->get_results("SELECT * FROM pengguna ORDER BY status");

    if ($users) :
       foreach ($users as $user) : 
            if ($user->status == 'kepsek') {
                $status = 'Kepala Sekolah';
            } else if ($user->status == 'wakepsek') {
                $status = 'Wakil Kepala Sekolah';
            } else {
                $status = ucwords($user->status);
            }
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $user->username; ?></td>
            <td><?= $status; ?></td>
            <td>

                <form action="actions" method="GET">
                    <input type="hidden" name="action" value="reset_password">
                    <input type="hidden" name="token" value="<?=$_SESSION["token"]?>">
                    <input type="hidden" name="userid" value="<?= $user->id; ?>">
                    <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Yakin reset password user id <?= $user->id; ?> ?')">Reset Password</button>
                    <button id="delete-button" class="btn btn-sm btn-danger" data-id="<?= $user->id; ?>" data-action="pengguna_hapus" data-token="<?= $_SESSION['token'] ?>">Hapus</button>
                </form>
                
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