
<?php 
$no=1;
foreach ($presensi as $prs) : ?>
    <!-- Modal -->
    <div class="modal fade" id="modalPresensi<?=$no?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Presensi Ekstrakurikuler: <?= $prs->ekskul ?> <br> (<?= date('d F Y', strtotime($prs->tanggal)); ?>)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                
            <?php 
                $detail_presensi = $db->get_results("SELECT pr.*, ex.nama as ekskul, pgr.id as id_pengurus, pgr.nama as pengurus, sw.nama as nama_siswa FROM presensi pr 
                    LEFT JOIN ekskul ex ON pr.id_ekskul=ex.id 
                    LEFT JOIN pengurus pgr ON ex.id_pengurus=pgr.id 
                    LEFT JOIN siswa sw ON pr.id_siswa=sw.id
                    WHERE pr.tanggal='$prs->tanggal' AND pr.id_ekskul='$prs->id_ekskul' ORDER BY sw.nama ASC");

                $result = $db->get_row("SELECT count(id_siswa) as total_peserta FROM peserta WHERE id_ekskul='$prs->id_ekskul'");
            ?>

            <p>Total yang hadir: <?= count($detail_presensi).' dari '.$result->total_peserta.' peserta.' ?></p>
            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <th>Hadir</th>
                </tr>

            <?php foreach ($detail_presensi as $data) { ?>
                <tr>
                    <td><?= $data->nama_siswa ?></td>
                    <td><?= ucwords($data->hadir) ?></td>
                </tr>
            <?php } ?>

            </table>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>
<?php $no++; endforeach; ?>
