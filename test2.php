<?php 
	echo "Data Peserta";
	echo "<pre>";
	var_dump($_POST);
	echo "</pre>";

	echo "<br><hr>";

	$peserta = [];
	$peserta_hadir = [];
	$peserta_tidak = [];

	for ($i=0; $i < count($_POST); $i++) {
		$arr_name = 'peserta_'.$i;

		if ($_POST[$arr_name] != NULL) {
			array_push($peserta, $_POST[$arr_name]);

			// check hadir/tidak
			$check_kehadiran_peserta = explode('_', $_POST[$arr_name]);
			if ($check_kehadiran_peserta[2] == 'hadir') {
				array_push($peserta_hadir, $_POST[$arr_name]);
			} else {
				array_push($peserta_tidak, $_POST[$arr_name]);
			}
		}
	}

	echo "<pre>";
	var_dump($peserta);
	echo "</pre>";
	echo "<br><br><hr>";

	echo "PESERTA HADIR";
	echo "<pre>";
	var_dump($peserta_hadir);
	echo "</pre>";
	echo "<br><br><hr>";

	echo "PESERTA TIDAK HADIR";
	echo "<pre>";
	var_dump($peserta_tidak);
	echo "</pre>";
	echo "<br><br><hr>";
 ?>

 <a href="test">back</a>