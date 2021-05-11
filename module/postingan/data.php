<?php 
    session_start();
    if ($_SESSION['status'] != 'kepsek' && $_SESSION['status'] != 'siswa'): ?>
    <div class="buttons mb-4 d-flex justify-content-end">
        <button id="add-button" class="btn btn-primary mr-3">Tambah</button>
    </div>
<?php endif ?>


<?php 
    require "../../inc/functions.php";

   $where = "";
   if ($_SESSION['status'] == 'pengurus') {
       $where = "WHERE p.id_pengurus='$_SESSION[userid]'";

   } elseif ($_SESSION['status'] == 'siswa') {
        $results = $db->get_results("SELECT * FROM peserta WHERE id_siswa='$_SESSION[userid]'");
        $where_parameter = [];

        foreach ($results as $result) {
            $value = "p.id_ekskul='".$result->id_ekskul."'";
            array_push($where_parameter, $value);
        }

        // WHERE id_ekskul='xxxx' OR id_ekskul='yyyy' or id_ekskul='zzzz'
        $where = "WHERE ".join(" OR ", $where_parameter)." AND kategori='pengumuman'";
   }

   $no=1;
   $postingan = $db->get_results("SELECT p.*, e.nama AS ekskul, pg.nama AS pengurus FROM postingan p 
                        LEFT JOIN ekskul e ON p.id_ekskul=e.id 
                        LEFT JOIN pengurus pg ON p.id_pengurus=pg.id $where ORDER BY p.kategori,p.tanggal DESC");


    if ($_SESSION['status'] != 'siswa' && $_SESSION['status'] != 'kepsek'): ?>
        <table border="1" cellspacing="0" cellpadding="0" id="data-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Judul</th>
                    <th>Eksktrakurikuler</th>
                    <th>Kategori</th>
                    <th>Oleh</th>

                    <?php if ($_SESSION['status'] != 'kepsek' && $_SESSION['status'] != 'siswa'): ?>
                        <th>Aksi</th>
                    <?php endif ?>
                </tr>
            </thead>
            <tbody>

            <?php
            if ($postingan) :
               foreach ($postingan as $post) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= date('d F Y', strtotime($post->tanggal)); ?></td>
                    <td><?= $post->judul; ?></td>
                    <td><?= $post->ekskul; ?></td>
                    <td><?= ($post->kategori) ? ucwords($post->kategori) : '-'; ?></td>
                    <td><?= $post->pengurus; ?></td>

                    <?php if ($_SESSION['status'] != 'kepsek' && $_SESSION['status'] != 'siswa'): ?>
                        <td>
                            <button id="edit-button" class="btn btn-sm btn-warning" data-id="<?= $post->id; ?>">Edit</button>
                            <button id="delete-button" class="btn btn-sm btn-danger" data-id="<?= $post->id; ?>" data-action="postingan_hapus" data-token="<?= $_SESSION['token'] ?>">Hapus</button>
                        </td>
                    <?php endif ?>
                    
                </tr>
            <?php endforeach;
            else: ?>
                <tr><td colspan="6" style="text-align:center;">Tidak ada data</td></tr>
            <?php endif; ?>

            </tbody>
        </table>

<?php else: ?>

    <?php
        if ($postingan) :
           foreach ($postingan as $post) : ?>

            <div class="card">
              <div class="card-header">
                Ekstrakurikuler: <?= $post->ekskul; ?> || Oleh: <?= $post->pengurus.' - '.date('d F Y', strtotime($post->tanggal)); ?>
              </div>
              <div class="card-body">
                <h2 class="card-title"><?= $post->judul; ?></h2>
                <p class="card-text"><?= $post->isi; ?></p>
              </div>
            </div>
        <?php endforeach;
        else: ?>
            <div class="card"><div class="card-body text-center">Tidak ada postingan</div></div>
        <?php endif; ?>

<?php endif ?>


<script>
    $('#data-table').DataTable();
</script>