<?php
    include "../../inc/functions.php";

    // form_status (tambah/edit) -> get from script.js
    if ($_GET['form_status'] == 'pengguna_edit') {
        $id=$_GET['id'];
        $result=$db->get_row("SELECT * FROM pengguna WHERE id='$id'");
    }
    
    $id = (!empty($result->id)) ? $result->id : '';
    $username = (!empty($result->username)) ? $result->username : '';
    $password = '';
    $status = (!empty($result->status)) ? $result->status : '';

    $form_title = ($_GET['form_status'] == 'pengguna_edit') ? 'Edit Pengguna' : 'Tambah Pengguna';
    echo "<h2 class='text-center'>$form_title</h2>";
?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <form method="POST" id="form" data-form-status='<?= $_GET['form_status'] ?>'>
            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="hidden" name="id" id="id" class="form-control" required value="<?= $id; ?>" />
                        <input type="text" name="username" id="username" class="form-control" required value="<?= $username; ?>" autocomplete='off'/>
                    </div>

                    <?php if ($_GET['form_status'] == 'pengguna_tambah'): ?>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="hidden" name="id" id="id" class="form-control" required value="<?= $id; ?>" />
                            <input type="password" name="password" id="password" class="form-control" required value="<?= $password; ?>" />
                        </div>
                    <?php endif ?>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="custom-select" required>
                            <option value="admin" <?= ($status=='admin') ? 'selected' : '' ?> >Admin</option>
                            <option value="kepsek" <?= ($status=='kepsek') ? 'selected' : '' ?> >Kepala Sekolah</option>
                            <option value="wakepsek" <?= ($status=='wakepsek') ? 'selected' : '' ?> >Wakil Kepala Sekolah</option>
                            <option value="pengurus" <?= ($status=='pengurus') ? 'selected' : '' ?> >Pengurus</option>
                            <option value="siswa" <?= ($status=='siswa') ? 'selected' : '' ?> >Siswa</option>
                        </select>
                    </div>
                   
                    <div class="form-buttons d-flex justify-content-end">
                        <button type="button" id="cancel-button" class="btn btn-secondary" >Batal</button>
                        <button type="submit" name="simpan" id="simpan" class="btn btn-primary">Simpan</button>
                    </div>
            </table>
        </form>
    </div>
</div>

