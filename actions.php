<?php
require "inc/functions.php";

$module     = explode('_', $_GET['action'])[0];
$_action    = (count(explode('_', $_GET['action'])) > 1) ? explode('_', $_GET['action'])[1] : '_undefined';

// ACTION LOGIN, LOGOUT, UPLOAD IMAGE, CHANGE PASSWORD, UPDATE PROFILE
switch ($_GET['action']){

    // LOGIN
    case 'check_login':
        $username	= $_POST['username'];
        $password	= $_POST['password'];
        $user_real_name = '';

        $result = $db->get_row("SELECT * FROM pengguna WHERE (id='$username' OR username='$username') AND password='$password'");

        if ($result->status == 'siswa') {
            $siswa = $db->get_row("SELECT peserta.*, siswa.nama FROM peserta LEFT JOIN siswa ON peserta.id_siswa=siswa.id WHERE id_siswa='$result->id' GROUP BY id_siswa");
            $user_real_name = $siswa->nama;

            if (!$siswa) {
                echo 'Tidak dapat login karena tidak mengikuti ekstrakurikuler.';
                die();
            }
        }

        if ($result->status == 'pengurus') {
            $pengurus = $db->get_row("SELECT * FROM pengurus WHERE id=$result->id");
            $user_real_name = $pengurus->nama;
        }

        if ($result) {
            $_SESSION['userid']     = $result->id;
            $_SESSION['username']   = ($result->status == 'siswa' || $result->status == 'pengurus') ? $user_real_name : $result->username;
            $_SESSION['password']   = $result->password;
            $_SESSION['status']     = $result->status;

            // true = login successfully (redirect to index)
            echo 'true';
        } else {
            echo 'false';
        }
        break;

    // LOGOUT
    case 'logout':
        session_unset();
        session_destroy();

        redirect_js('login');
        break;

    // UPLOAD IMAGE
    case 'upload_image':
        $temp = "images/upload/";
        if (!file_exists($temp)) mkdir($temp);

        $filename   = $_POST['newfilename'];
        $fileupload = $_FILES['fileupload']['tmp_name'];
        $ImageName  = $_FILES['fileupload']['name'];
        $ImageType  = $_FILES['fileupload']['type'];

        if (!empty($fileupload)) {
            move_uploaded_file($_FILES["fileupload"]["tmp_name"], $temp.$filename); // Menyimpan file
            echo "File uploaded successfully#info"; //<message>_<alert-style>
        } else {
            echo "Failed to upload file#danger";
        }
        break;

    // CHANGE-UPDATE PASSWORD
    case 'change_password':
        $table = 'pengguna';

        $old_password   = $_POST['password_old'];
        $new_password   = $_POST['password_new'];
        $con_password   = $_POST['password_conf'];

        $user = $db->get_row("SELECT * FROM $table WHERE id='$_SESSION[userid]' AND password='$old_password'");

        if ($new_password == $con_password) {
            if ($user) {
                $query = $db->query("UPDATE $table SET password='$new_password' WHERE id='$_SESSION[userid]'");
                echo "Password berhasil diupdate!#info";
                exit;
            } else {
                echo "Password salah!#danger";
                exit;
            }
        } else {
            echo "Password tidak sama!#danger";
            exit;
        }
        break;

    // RESET PASSWORD
    case 'reset_password':
        $query = $db->query("UPDATE pengguna SET password='12345' WHERE id='$_GET[userid]'");
        alert('Password berhasil direset!');
        redirect_js('index?m=pengguna');
        break;

    // UPDATE MY PROFILE DATA
    case 'profile_update':
        $table = 'pengguna';

        $id         = trim($_POST['userid']);
        $username   = trim($_POST['username']);

        $result = $db->get_row("SELECT username FROM pengguna WHERE username='$username'");

        if (!$result) {
            $query = $db->query("UPDATE $table SET username='$username' WHERE id='$id'");
            $_SESSION['username'] = $username;

            if ($query) {
                echo "Profile berhasil diupdate!#info";
                exit;
            } else {
                echo "Update data gagal. Detail:".$query."#danger";
                exit;
            }
        } else {
            echo "Update gagal. Username tidak tersedia.#danger";
            exit;
        }
        break;

    // RESET PASSWORD
    case 'presensi_hapus':
        $id_ekskul = $_GET['id_ekskul'];
        $tanggal = $_GET['tanggal'];

        $query = $db->query("DELETE FROM presensi WHERE id_ekskul='$id_ekskul' AND tanggal='$tanggal'");
        redirect_js('index?m=presensi');
        break;

    // TANGGAL PRESENSI EKSKUL
    case 'presensi_tanggal':
        $date_options = '';
        $id_ekskul = $_POST['id_ekskul'];

        $results = $db->get_results("SELECT tanggal FROM presensi WHERE id_ekskul='$id_ekskul' GROUP BY tanggal ORDER BY tanggal DESC");

        if (count($results) > 0 ) {
            $date_options .= '<option value="semua">Semua</option>';

            foreach ($results as $result) {
                $date_options .= '<option value="'.$result->tanggal.'">'.date("d F Y", strtotime($result->tanggal)).'</option>';
            }
        } else {
            $date_options = '<option></option>';
        }
        echo $date_options;
        break;

    case 'daftar_ekskul':
        $result_ekskul = $db->get_row("SELECT nama FROM ekskul WHERE id=$_POST[id_ekskul]");
        $result = $db->get_row("SELECT id FROM peserta WHERE id_ekskul=$_POST[id_ekskul] AND id_siswa=$_SESSION[userid]");

        // var_dump($result);

        if ($result) {
            echo "<script>alert('Gagal daftar ekstrakurikuler ".$result_ekskul->nama." karena sudah terdaftar!')</script>";
            redirect_js('index?m=ekskul');
        } else {
            $db->query("INSERT INTO peserta(id, id_ekskul, id_siswa) VALUES (NULL,$_POST[id_ekskul],$_SESSION[userid])");
            echo "<script>alert('Berhasil daftar ekstrakurikuler $result_ekskul->nama')</script>";
            redirect_js('index?m=ekskul');
        }

        break;
}


// MODULE ACTIONS
switch ($module){
    // =================== PENGGUNA ===================
    case 'pengguna':
        $table = 'pengguna';

        $id         = ($_POST['id']) ? trim($_POST['id']) : create_username();
        $username   = trim($_POST['username']);
        $password   = trim($_POST['password']);
        $status     = trim($_POST['status']);

        switch ($_action) {
            case 'tambah':
                $query = $db->query("INSERT INTO $table(id, username, password, status) VALUES ($id,'$username','$password','$status')");

                echo "Data berhasil disimpan!#info";
                break;

            case 'hapus':
                $query = $db->query("DELETE FROM $table WHERE id='$id'");

                echo "Data dihapus!#info";
                break;
        }
    break;


    // =================== EKSTRAKURIKULER ===================
    case 'ekskul':
        $table  = 'ekskul';

        $id     = trim($_POST['id']);
        $nama   = trim($_POST['nama']);
        $jadwal = trim($_POST['jadwal']);
        $wajib  = trim($_POST['wajib']);
        $id_pengurus = trim($_POST['pengurus']);

        switch ($_action) {
            case 'tambah':
                $query = $db->query("INSERT INTO $table(id, nama, jadwal, wajib, id_pengurus) VALUES (NULL,'$nama','$jadwal','$wajib','$id_pengurus')");
                echo "Data berhasil disimpan!#info";
                break;

            case 'edit':
                $query = $db->query("UPDATE $table SET nama='$nama', jadwal='$jadwal', wajib='$wajib', id_pengurus='$id_pengurus' WHERE id='$id'");
                echo "Data berhasil diupdate!#info";
                break;

            case 'hapus':
                $query = $db->query("DELETE FROM $table WHERE id='$id'");
                echo "Data dihapus!#info";
                break;
        }
    break;

    // =================== PENGURUS ===================
    case 'pengurus':
        $table = 'pengurus';

        $id   = trim($_POST['id']);
        $nama = ucwords(trim($_POST['nama']));
        $nohp = trim($_POST['nohp']);
        $userid = create_username();

        switch ($_action) {
            case 'tambah':
                $query = $db->query("INSERT INTO $table(id, nama, nohp) VALUES ('$userid','$nama','$nohp')");
                $query = $db->query("INSERT INTO pengguna(id, username, password, status) VALUES ('$userid','$userid','12345','pengurus')");
                echo "Data berhasil disimpan!#info";
                break;

            case 'edit':
                $query = $db->query("UPDATE $table SET nama='$nama', nohp='$nohp' WHERE id='$id'");
                echo "Data berhasil diupdate!#info";
                break;

            case 'hapus':
                $query = $db->query("DELETE FROM $table WHERE id='$id'");
                $query = $db->query("DELETE FROM pengguna WHERE id='$id'");
                echo "Data dihapus!#info";
                break;
        }
    break;

    // =================== SISWA ===================
    case 'siswa':
        $table = 'siswa';

        $id   = trim($_POST['id']);
        $nama = ucwords(trim($_POST['nama']));
        $kelas = trim($_POST['kelas']);
        $nohp  = trim($_POST['nohp']);
        $userid = create_username();

        switch ($_action) {
            case 'tambah':
                $query = $db->query("INSERT INTO $table(id, nama, kelas, nohp) VALUES ('$userid','$nama','$kelas','$nohp')");
                $query = $db->query("INSERT INTO pengguna(id, username, password, status) VALUES ('$userid','$userid','12345','siswa')");
                echo "Data berhasil disimpan!#info";
                break;

            case 'edit':
                $query = $db->query("UPDATE $table SET nama='$nama', kelas='$kelas', nohp='$nohp' WHERE id='$id'");
                echo "Data berhasil diupdate!#info";
                break;

            case 'hapus':
                $query = $db->query("DELETE FROM $table WHERE id='$id'");
                $query = $db->query("DELETE FROM pengguna WHERE id='$id'");
                echo "Data dihapus!#info";
                break;
        }
    break;

    // =================== PESERTA ===================
    case 'peserta':
        $table = 'peserta';

        $id     = trim($_POST['id']);
        $id_siswa  = trim($_POST['siswa']);
        $id_ekskul  = trim($_POST['ekskul']);

        switch ($_action) {
            case 'tambah':

                $result = $db->get_row("SELECT id FROM peserta WHERE id_siswa='$id_siswa' AND id_ekskul='$id_ekskul'");

                if (!$result) {
                        $query = $db->query("INSERT INTO $table(id, id_siswa, id_ekskul) VALUES (NULL,'$id_siswa','$id_ekskul')");

                    echo "Data berhasil disimpan!#info";
                } else {
                    echo "Gagal menyimpan karena data sudah ada.#danger";
                }

                break;

            case 'edit':

                $result = $db->get_row("SELECT id FROM peserta WHERE id_siswa='$id_siswa' AND id_ekskul='$id_ekskul'");

                if (!$result) {
                        $query = $db->query("UPDATE $table SET id_siswa='$id_siswa', id_ekskul='$id_ekskul' WHERE id='$id'");

                    echo "Data berhasil diupdate!#info";
                } else {
                    echo "Gagal menyimpan karena data sudah ada.#danger";
                }

                break;

            case 'hapus':
                $query = $db->query("DELETE FROM $table WHERE id='$id'");
                echo "Data dihapus!#info";
                break;
        }
    break;

    // =================== POSTINGAN ===================
    case 'postingan':
        $table = 'postingan';

        $id             = trim($_POST['id']);
        $tanggal        = trim($_POST['tanggal']);
        $judul          = trim($_POST['judul']);
        $kategori       = trim($_POST['kategori']);
        $isi            = trim($_POST['isi']);
        $id_pengurus    = $_SESSION['userid'];
        $id_ekskul      = trim($_POST['ekskul']);

        switch ($_action) {
            case 'tambah':
                $query = $db->query("INSERT INTO $table(id, judul, isi, kategori, tanggal, id_pengurus, id_ekskul) VALUES (NULL,'$judul','$isi','$kategori','$tanggal',$id_pengurus,$id_ekskul)");
                echo "Data berhasil disimpan!#info";
                break;

            case 'edit':
                $ekskul = ($id_ekskul) ? ',id_ekskul='.$id_ekskul : ',id_ekskul=NULL';

                $query = $db->query("UPDATE $table SET judul='$judul', isi='$isi', tanggal='$tanggal', kategori='$kategori' WHERE id=$id");
                echo "Data berhasil diupdate!#info";
                break;

            case 'hapus':
                $query = $db->query("DELETE FROM $table WHERE id=$id");
                echo "Data dihapus!#info";
                break;
        }
    break;

    // =================== PESERTA ===================
    case 'presensi':
        $table      = 'presensi';
        $peserta    = [];

        $id        = trim($_POST['id']);
        $tanggal   = trim($_POST['tanggal']);
        $id_ekskul = trim($_POST['id_ekskul']);

        switch ($_action) {
            case 'tambah':

                // check data (validasi duplikasi data)
                $results = $db->get_results("SELECT * FROM $table WHERE tanggal='$tanggal' AND id_ekskul='$id_ekskul'");
                if (count($results) >= 1) {
                    echo "Gagal menyimpan data karena data presensi tanggal ". date('d F Y', strtotime($tanggal))." sudah ada.#danger";
                    die();
                }

                // simpan data presensi ke db
                for ($i=0; $i < count($_POST); $i++) {
                    $arr_name = 'peserta_'.$i;

                    if ($_POST[$arr_name] != NULL) {
                        array_push($peserta, $_POST[$arr_name]);

                        // check kehadiran
                        $check_kehadiran_peserta = explode('_', $_POST[$arr_name]);
                        $id_siswa = $check_kehadiran_peserta[1];

                        if ($check_kehadiran_peserta[2] == 'y') {
                            $db->query("INSERT INTO $table(id, tanggal, hadir, id_siswa, id_ekskul) VALUES (NULL,'$tanggal','ya','$id_siswa','$id_ekskul')");
                        }

                    }
                }

                if (count($peserta) >= 1) {
                    echo "Data berhasil disimpan!#info";
                } else {
                    echo "Gagal menyimpan karena tidak ada data presensi.#danger";
                }
                break;

            case 'hapus':
                $query = $db->query("DELETE FROM $table WHERE id='$id'");
                echo "Data dihapus!#info";
                break;
        }
    break;
}
?>