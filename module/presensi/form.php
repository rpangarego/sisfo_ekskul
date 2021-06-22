<?php
    include "../../inc/functions.php";

    // form_status (tambah/edit) -> get from script.js
    if ($_GET['form_status'] == 'presensi_edit') {
        $id=$_GET['id'];
        $result=$db->get_row("SELECT prs.*, ex.nama as nama_ekskul FROM presensi prs LEFT JOIN ekskul ex ON prs.id_ekskul=ex.id WHERE id='$id'");
    }

    $data_ekskul = $db->get_row("SELECT id FROM ekskul WHERE id_pengurus='$_SESSION[userid]'");
    $id_ekskul = $data_ekskul->id;
    
    $id = (!empty($result->id)) ? $result->id : '';
    $tanggal = (!empty($result->tanggal)) ? $result->tanggal : '';

    $form_title = ($_GET['form_status'] == 'presensi_edit') ? 'EDIT DATA PRESENSI' : 'TAMBAH DATA PRESENSI';
    echo "<h3 class='text-center'>$form_title</h3>";
?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <form method="POST" id="form" data-form-status='<?= $_GET['form_status'] ?>'>
            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
            <input type="hidden" name="id" id="id" required value="<?= $id; ?>" />

            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" required value="<?= date("Y-m-d"); ?>" autocomplete="off"/>
            </div>

            <div class="form-group">
                <label for="ekskul">Ekstrakurikuler</label>
                <input type="hidden" name="id_ekskul" id="id_ekskul" class="form-control" required value="<?= $id_ekskul; ?>" autocomplete="off"/>
                <select class="custom-select" name="ekskul" readonly disabled>
                    <?= getEkskulOptions($id_ekskul); ?>
                </select>
            </div>

            <?php 
                $peserta_ekskul = $db->get_results("SELECT pst.*, ex.nama as ekskul, sw.nama as siswa 
                    FROM peserta pst 
                    LEFT JOIN ekskul ex ON pst.id_ekskul=ex.id 
                    LEFT JOIN siswa sw ON pst.id_siswa=sw.id
                    WHERE pst.id_ekskul=$id_ekskul
                    ORDER BY sw.nama");
            ?>

            <table class="table table-bordered mb-4" cellpadding="5">
                <tr>
                    <th class="text-center">Nama Peserta</th>
                    <th class="text-center">Presensi</th>
                </tr>

            
            <?php $ix = 0; foreach ($peserta_ekskul as $peserta){

                $nama = 'peserta_'.$ix;
                $value_hadir = 'peserta_'.$peserta->id_siswa.'_y'; //y = hadir
                $value_tidak = 'peserta_'.$peserta->id_siswa.'_n'; //t = tidak hadir
                ?>

                <tr>
                    <td><?= $peserta->siswa ?></td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="<?= $nama ?>" id="<?= $value_hadir ?>" value="<?= $value_hadir ?>" checked>
                            <label class="form-check-label" for="<?= $value_hadir ?>">Hadir</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="<?= $nama ?>" id="<?= $value_tidak ?>" value="<?= $value_tidak ?>">
                            <label class="form-check-label" for="<?= $value_tidak ?>">Tidak Hadir</label>
                        </div>
                    </td>
                </tr>

            <?php $ix++; 
            } ?>

            </table>

            
            <div class="form-buttons d-flex justify-content-end">
                <button type="button" id="cancel-button" class="btn btn-secondary" >Batal</button>
                <button type="submit" name="simpan" id="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>