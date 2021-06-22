<?php
    include "../../inc/functions.php";

    // form_status (tambah/edit) -> get from script.js
    if ($_GET['form_status'] == 'pengurus_edit') {
        $id=$_GET['id'];
        $result=$db->get_row("SELECT * FROM pengurus WHERE id='$id'");
    }
    
    $id = (!empty($result->id)) ? $result->id : '';
    $nama = (!empty($result->nama)) ? $result->nama : '';
    $nohp = (!empty($result->nohp)) ? $result->nohp : '';

    $form_title = ($_GET['form_status'] == 'pengurus_edit') ? 'Edit Data Pengurus' : 'Tambah Data Pengurus';
    echo "<h2 class='text-center'>$form_title</h2>";
?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <form method="POST" id="form" data-form-status='<?= $_GET['form_status'] ?>'>
            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                    <div class="form-group">
                        <label for="nama">Nama Pengurus</label>
                        <input type="hidden" name="id" id="id" class="form-control" required value="<?= $id; ?>" />
                        <input type="text" name="nama" id="nama" class="form-control" required value="<?= $nama; ?>" autocomplete='off'/>
                    </div>

                    <div class="form-group">
                        <label for="nohp">No Telepon/Hp</label>
                        <input type="text" name="nohp" id="nohp" class="form-control" required value="<?= $nohp; ?>" autocomplete="off"/>
                    </div>
                    
                    <div class="form-buttons d-flex justify-content-end">
                        <button type="button" id="cancel-button" class="btn btn-secondary" >Batal</button>
                        <button type="submit" name="simpan" id="simpan" class="btn btn-primary">Simpan</button>
                    </div>
            </table>
        </form>
    </div>
</div>

