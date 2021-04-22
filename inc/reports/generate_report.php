<?php
	ob_start();
	require_once '../functions.php';
	require_once '../../vendor/autoload.php';

    if (isset($_POST["laporan"])) {
        if ($_POST["laporan"] == 'ekskul') {
            $query = "SELECT ex.*, sw.nama as nama_peserta, sw.kelas, pgr.nama as pengurus FROM ekskul ex LEFT JOIN peserta ps ON ps.id_ekskul=ex.id LEFT JOIN siswa sw ON ps.id_siswa=sw.id LEFT JOIN pengurus pgr ON ex.id_pengurus=pgr.id WHERE ex.id='$_POST[ekskul]'";
        } elseif ($_POST["laporan"] == 'presensi') {
            $query = "SELECT pr.*, ex.nama as ekskul, pgr.id as id_pengurus, pgr.nama as pengurus, sw.nama as nama_siswa, sw.kelas as kelas_siswa FROM presensi pr 
                    LEFT JOIN ekskul ex ON pr.id_ekskul=ex.id 
                    LEFT JOIN pengurus pgr ON ex.id_pengurus=pgr.id 
                    LEFT JOIN siswa sw ON pr.id_siswa=sw.id
                    WHERE pr.tanggal='$_POST[tanggal]' AND pr.id_ekskul='$_POST[ekskul]' ORDER BY sw.nama ASC";
        }
    }

    $results = $db->get_results($query);

    $html .= "<pre>".$query."</pre>";

    $judul = ($_POST["laporan"] == 'ekskul') ? 'Ekstrakurikuler '.$results[0]->nama : 'Presensi '.$results[0]->ekskul.' ('.date("d F Y", strtotime($_POST['tanggal'])).')';

	$html = '<h2 style="text-align:center;">Laporan '.$judul.'</h2>';

    $html .= '<p style="text-align:center;">Cetak: '.date('d M Y H:i:s').'</p><table class="table" border="1" cellpadding="6" cellspacing="0" style="margin: 0 auto;">';


    if ($_POST['laporan'] == 'ekskul') {
        $html .= '<thead>
                <tr><th>Ekstrakurikuler</th><th>:</th><th>'.$results[0]->nama.'</th></tr>
                <tr><th>Jadwal</th><th>:</th><th>'.$results[0]->jadwal.'</th></tr>
                <tr><th>Pengurus</th><th>:</th><th>'.$results[0]->pengurus.'</th></tr><tr><td colspan="3"></td></tr>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama Peserta</th>
                    <th scope="col">Kelas</th>
                </tr>
            </thead><tbody>';

            if (count($results) <= 2) {
                $html .= '<tr><td colspan="3" style="text-align:center;">Tidak ada data</td></tr>';
            }else{
                foreach ($results as $result) {
                    $html .= '<tr>
                                <td>'.++$i.'</td>
                                <td>'.$result->nama_peserta.'</td>
                                <td>'.$result->kelas.'</td>
                            </tr>';
                }
            }


    } elseif ($_POST['laporan'] == 'presensi') {
        $html .= '<thead>
                <tr><th>Ekstrakurikuler</th><th>:</th><th colspan="2">'.$results[0]->ekskul.'</th></tr>
                <tr><th>Pengurus</th><th>:</th><th colspan="2">'.$results[0]->pengurus.'</th></tr>
                <tr><th>Tanggal</th><th>:</th><th colspan="2">'.date('d F Y', strtotime($results[0]->tanggal)).'</th></tr><tr><td colspan="4"></td></tr>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama Peserta</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Hadir</th>
                </tr>
            </thead><tbody>';

            if (count($results) <= 2) {
                $html .= '<tr><td colspan="4" style="text-align:center;">Tidak ada data</td></tr>';
            }else{
                foreach ($results as $result) {
                    $html .= '<tr>
                                <td>'.++$i.'</td>
                                <td>'.$result->nama_siswa.'</td>
                                <td>'.$result->kelas_siswa.'</td>
                                <td>'.ucwords($result->hadir).'</td>
                            </tr>';
                }
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