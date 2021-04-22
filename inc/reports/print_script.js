$(document).ready(function() {
	$("#form_date").hide();


	$("#laporan").change(function(e){
		const laporan = e.target.value;
		if (laporan === 'presensi') {
			$("#form_date").show();
		} else {
			$("#form_date").hide();
		}
	});

	 // preview report
    $("#preview-report").click(function(e){
        e.preventDefault();

        var laporan = $("#laporan").val();
        var ekskul = $("#ekskul").val();
        var bulan_tahun = $("#bulan_tahun").val();

        $.ajax({
            url: "preview_report.php",
            type: 'POST',
            data: {
                laporan: laporan,
                ekskul: ekskul,
                bulan_tahun: bulan_tahun
            },
            success: function(res) {
            	// console.log(res);
                $("#preview-data").html(res);
            }
        });
    });

});