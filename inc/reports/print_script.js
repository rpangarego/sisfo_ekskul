$(document).ready(function() {
	$("#form_date").hide();

	$("#laporan").change(function(e){
		const laporan = e.target.value;
		if (laporan === 'presensi') {
			$("#form_date").show();

            $("#form_laporan").removeClass("col-lg-6").addClass("col-lg-4");
            $("#form_ekskul").removeClass("col-lg-6").addClass("col-lg-4");

		} else {
			$("#form_date").hide();

            $("#form_laporan").removeClass("col-lg-4").addClass("col-lg-6");
            $("#form_ekskul").removeClass("col-lg-4").addClass("col-lg-6");
		}

        getEkskulDate();
	});

    $("#ekskul").change(function(e){
        getEkskulDate();
    });

	 // preview report
    $("#preview-report").click(function(e){
        e.preventDefault();

        var laporan = $("#laporan").val();
        var ekskul = $("#ekskul").val();
        var tanggal = $("#tanggal").val();

        $.ajax({
            url: "preview_report.php",
            type: 'POST',
            data: {
                laporan: laporan,
                id_ekskul: ekskul,
                tanggal: tanggal
            },
            success: function(res) {
                $("#preview-data").html(res);
            }
        });
    });

});

function getEkskulDate() {
    const laporan   = $("#laporan").val();
    const ekskul    = $("#ekskul").val();
    const token     = $("#token").val();

    if (laporan === 'presensi') {
        $.ajax({
            url: '../../actions.php?action=presensi_tanggal',
            type: 'POST',
            data: {
                laporan: laporan,
                id_ekskul: ekskul,
                token:token
            },
            success: function(res) {
                // console.log(res);
                $("#tanggal").html(res);
            }
        });
    }
}