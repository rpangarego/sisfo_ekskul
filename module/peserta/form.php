<?php
    include "../../inc/functions.php";

    // form_status (tambah/edit) -> get from script.js
    if ($_GET['form_status'] == 'peserta_edit') {
        $id=$_GET['id'];
        $result=$db->get_row("SELECT * FROM peserta WHERE id='$id'");
    }
    
    $id = (!empty($result->id)) ? $result->id : '';
    $id_siswa = (!empty($result->id_siswa)) ? $result->id_siswa : '';
    $id_ekskul = (!empty($result->id_ekskul)) ? $result->id_ekskul : '';

    $form_title = ($_GET['form_status'] == 'peserta_edit') ? 'Edit Data Peserta' : 'Tambah Data Peserta';
    echo "<h2 class='text-center'>$form_title</h2>";
?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <form method="POST" id="form" data-form-status='<?= $_GET['form_status'] ?>'>
            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                    <div class="form-group">
                        <label for="siswa">Siswa</label>
                        <input type="hidden" name="id" id="id" class="form-control" required value="<?= $id; ?>" />
                        <select name="siswa" id="siswa" class="custom-select" required>
                            <option value=""></option>
                            <?= getSiswaOptions($id_siswa); ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="ekskul">Ekstrakurikuler</label>
                        <select name="ekskul" id="ekskul" class="custom-select" required>
                            <?= getEkskulPengurusOptions($id_ekskul); ?>
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

