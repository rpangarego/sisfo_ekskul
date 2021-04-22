<?php 
	$byk_peserta = 10;
?>

<form action="test2" method="POST">
	
	<input type="date" name="tanggal" value="<?= date("Y-m-d") ?>">

	<?php for ($i=1; $i <= $byk_peserta; $i++) { 
		$name = 'peserta_'.$i;
		$value_hadir = 'peserta_'.$i.'_hadir';
		$value_tidak = 'peserta_'.$i.'_tidak';
		?>
			<div>
				<label>Peserta <?= $i ?></label>
				<div>
				  <input type="radio" id="<?=$value_hadir?>" name="<?=$name?>" value="<?=$value_hadir?>" checked>
				  <label for="<?=$value_hadir?>">Hadir</label>
				</div>
				<div>
				  <input type="radio" id="<?=$value_tidak?>" name="<?=$name?>" value="<?=$value_tidak?>">
				  <label for="<?=$value_tidak?>">Tidak</label>
				</div>
			</div>
		<?php } ?>

	<button type="submit" name="submitbtn">Submit</button>
</form>