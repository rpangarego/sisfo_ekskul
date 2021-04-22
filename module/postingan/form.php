<?php
    include "../../inc/functions.php";

    // form_status (tambah/edit) -> get from script.js
    if ($_GET['form_status'] == 'postingan_edit') {
        $id=$_GET['id'];
        $result=$db->get_row("SELECT * FROM postingan WHERE id='$id'");
    }
    
    $id = (!empty($result->id)) ? $result->id : '';
    $judul = (!empty($result->judul)) ? $result->judul : '';
    $isi = (!empty($result->isi)) ? $result->isi : '';
    $tanggal = (!empty($result->tanggal)) ? $result->tanggal : date("Y-m-d");
    $id_pengurus = (!empty($result->id_pengurus)) ? $result->id_pengurus : '';
    
    $data_ekskul = $db->get_row("SELECT id FROM ekskul WHERE id_pengurus='$_SESSION[userid]'");
    $id_ekskul = $data_ekskul->id;

    $form_title = ($_GET['form_status'] == 'postingan_edit') ? 'EDIT DATA POSTINGAN' : 'TAMBAH DATA POSTINGAN';
    echo "<h3 class='text-center'>$form_title</h3>";
?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <form method="POST" id="form" data-form-status='<?= $_GET['form_status'] ?>'>
            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
            <input type="hidden" name="id" id="id" required value="<?= $id; ?>" />

            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" required value="<?= $tanggal; ?>" autocomplete="off"/>
            </div>

            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" id="judul" class="form-control" required value="<?= $judul; ?>" autocomplete="off"/>
            </div>

            <div class="form-group">
                <label for="isi">Isi Postingan</label>
                <textarea name="isi" id="postArea" required class="form-control"><?=$isi?></textarea>
            </div>

            <div class="form-group">
                <label for="ekskul">Ekstrakurikuler</label>
                <select class="custom-select" name="ekskul">
                    <?= getEkskulPengurusOptions($id_ekskul); ?>
                </select>
            </div>
            
            <div class="form-buttons d-flex justify-content-end">
                <button type="button" id="cancel-button" class="btn btn-secondary" >Batal</button>
                <button type="submit" name="simpan" id="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
    