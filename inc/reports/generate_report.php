<?php
	ob_start();
	require_once '../functions.php';
	require_once '../../vendor/autoload.php';

    if (isset($_POST["laporan"])) {
        if ($_POST["laporan"] == 'ekskul') {
            $query = "SELECT ex.*, sw.nama as nama_peserta, sw.kelas, pgr.nama as pengurus FROM ekskul ex LEFT JOIN peserta ps ON ps.id_ekskul=ex.id LEFT JOIN siswa sw ON ps.id_siswa=sw.id LEFT JOIN pengurus pgr ON ex.id_pengurus=pgr.id WHERE ex.id='$_POST[ekskul]'";
        }
    }

    $results = $db->get_results($query);

    $judul = ($_POST["laporan"] == 'ekskul') ? 'Ekstrakurikuler' : 'Presensi';

	$html = '<h2 style="text-align:center;">Laporan '.$judul.'</h2><br>';

    $html .= '<p style="text-align:center;">Cetak tanggal: '.date('d M Y H:i:s').'</p><table class="table" border="1" cellpadding="6" cellspacing="0" style="margin: 0 auto;">
        <thead>
                <tr><th>Ekstrakurikuler</th><th>:</th><th>'.$results[0]->nama.'</th></tr>
                <tr><th>Jadwal</th><th>:</th><th>'.$results[0]->jadwal.'</th></tr>
                <tr><th>Pengurus</th><th>:</th><th>'.$results[0]->pengurus.'</th></tr><tr><td colspan="3"></td></tr>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama Peserta</th>
                    <th scope="col">Kelas</th>
                </tr>
            </thead><tbody>';

$html .= $query;

    if (count($results) <= 2) {
        $html .= '<tr><td colspan="3" style="text-align:center;">Tidak ada data</td></tr>';
    }else{
        foreach ($results as $result) {
            $birth  = $student->birth_place.', '. date("d M Y", strtotime($student->birth_date));
            $gender = ($student->gender == 1) ? 'Male' : 'Female';
            $html .= '<tr>
                        <td>'.++$i.'</td>
                        <td>'.$result->nama_peserta.'</td>
                        <td>'.$result->kelas.'</td>
                    </tr>';
        }
    }

    $html .= '</tbody>
    </table>';


	// Create Raport PDF File
	$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
	$mpdf->WriteHTML($html);
	$filename = 'Students Report.pdf';
	$mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
	ob_end_flush();
	ob_clean();
 ?>