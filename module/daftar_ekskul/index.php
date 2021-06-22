<h1>Daftar Ekstrakurikuler</h1>
<div class="alert-container"></div>

<div id="content-data">
<?php
    // $id = (!empty($result->id)) ? $result->id : '';
    // $id_siswa = (!empty($result->id_siswa)) ? $result->id_siswa : '';
    // $id_ekskul = (!empty($result->id_ekskul)) ? $result->id_ekskul : '';

    echo "<h2 class='text-center'>Daftar Ekstrakurikuler Baru</h2>";
?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <form method="POST" action="actions?action=daftar_ekskul">
                    <div class="form-group">
                        <label for="ekskul">Ekstrakurikuler</label>
                        <select name="id_ekskul" id="ekskul" class="custom-select" required>
                            <?= getEkskulOptions(); ?>
                        </select>
                    </div>

                    <div class="form-buttons d-flex justify-content-end">
                        <a href="index?m=ekskul" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="simpan" id="simpan" class="btn btn-primary">Simpan</button>
                    </div>
            </table>
        </form>
    </div>
</div>


</div>
