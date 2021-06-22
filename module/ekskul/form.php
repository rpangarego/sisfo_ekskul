<?php
    include "../../inc/functions.php";

    // form_status (tambah/edit) -> get from script.js
    if ($_GET['form_status'] == 'ekskul_edit') {
        $id=$_GET['id'];
        $result=$db->get_row("SELECT * FROM ekskul WHERE id='$id'");
    }
    
    $id = (!empty($result->id)) ? $result->id : '';
    $nama = (!empty($result->nama)) ? $result->nama : '';
    $jadwal = (!empty($result->jadwal)) ? $result->jadwal : '';
    $wajib = (!empty($result->wajib)) ? $result->wajib : '';
    $id_pengurus = (!empty($result->id_pengurus)) ? $result->id_pengurus : '';

    $form_title = ($_GET['form_status'] == 'ekskul_edit') ? 'Edit Ekstrakurikuler' : 'Tambah Ekstrakurikuler';
    echo "<h2 class='text-center'>$form_title</h2>";
?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <form method="POST" id="form" data-form-status='<?= $_GET['form_status'] ?>'>
            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                    <div class="form-group">
                        <label for="nama">Nama Kegiatan</label>
                        <input type="hidden" name="id" id="id" class="form-control" required value="<?= $id; ?>" />
                        <input type="text" name="nama" id="nama" class="form-control" required value="<?= $nama; ?>" autocomplete='off'/>
                    </div>

                    <div class="form-group">
                        <label for="jadwal">Jadwal</label>
                        <input type="text" name="jadwal" id="jadwal" class="form-control" required value="<?= $jadwal; ?>" placeholder="cth. Senin dan Jumat, Jam 16:00" autocomplete="off"/>
                    </div>

                    <div class="form-group">
                        <label for="wajib">Wajib</label>
                        <select name="wajib" id="wajib" class="custom-select" required>
                            <option value="ya" <?= ($wajib=='ya') ? 'selected' : '' ?> >Ya</option>
                            <option value="tidak" <?= ($wajib=='tidak') ? 'selected' : '' ?> >Tidak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pengurus">Pengurus Ekstrakurikuler</label>
                        <select name="pengurus" id="pengurus" class="custom-select" required>
                            <option value=""></option>
                            <?= getPengurusOptions($id_pengurus); ?>
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

