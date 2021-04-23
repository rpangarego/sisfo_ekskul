<?php require '../functions.php';
    // if (!isset($_SESSION['userid'])) redirect_js('../../login');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan</title>

  <link rel="stylesheet" href="../../assets/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../../assets/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../../assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body>

    <div class="row mt-5 mx-2">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h1 align="center">Cetak Laporan</h1>
                </div>
                <div class="card-body">
                
                <form action="generate_report" method="POST">
                    <input type="hidden" name="token" id="token" value="<?= $_SESSION['token'] ?>">
                    <div class="row">
                        <div class="col-md-12 col-lg-6" id="form_laporan">
                        <div class="form-group">
                            <label for="laporan">Laporan</label>
                            <select name="laporan" id="laporan" class="custom-select">
                                <option value="ekskul">Ekstrakurikuler</option>
                                <option value="presensi">Presensi</option>
                            </select>
                        </div>
                        </div>

                        <div class="col-md-12 col-lg-6" id="form_ekskul">
                        <div class="form-group">
                            <label for="ekskul">Ekstrakurikuler</label>
                            <select name="ekskul" id="ekskul" class="custom-select">
                                <?= getEkskulOptions() ?>
                            </select>
                        </div>
                        </div>

                        <div class="col-md-12 col-lg-4" id="form_date">
                        <div class="form-group">
                            <label for="laporan">Tanggal</label>
                            <select name="tanggal" id="tanggal" class="custom-select">
                                <option></option>
                            </select>
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-secondary" onclick="window.close()">Tutup</button>
                        <button type="button" id="preview-report" class="btn btn-secondary">Lihat Data</button>
                        <button type="submit" id="print-report" class="btn btn-primary">Print</button>
                        </div>
                    </div>
                </form>
                    
                <hr>
                <div id="preview-data"></div>

                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/jquery-3.6.0.js"></script>
    <script src="../../assets/js/script.js"></script>
    <script src="print_script.js"></script>
</body>
</html>