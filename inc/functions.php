<?php
error_reporting(0);
session_start();
date_default_timezone_set('Asia/Jakarta');

ini_set('max_execution_time', 60 * 1);
ini_set('memory_limit', '256M');
ini_set('upload_max_filesize', '32M');

include 'config.php';
include 'db.php';
$db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);
include 'general.php';

check_last_activity();

function checkMenuActive($menu){
    if (!isset($_GET['m']) && $menu=='index' ) {
        return 'active';
    } elseif (isset($_GET['m']) && $menu==$_GET['m']) {
        return 'active';
    }

    return null;
}

function getPengurusOptions($selected = ''){
    global $db;
    $a = '';
    $rows = $db->get_results("SELECT id, nama FROM pengurus ORDER BY nama");
    foreach($rows as $row){
        if($row->id==$selected)
            $a.="<option value='$row->id' selected>$row->nama</option>";
        else
            $a.="<option value='$row->id'>$row->nama</option>";
    }
    return $a;
}

function create_username(){
  global $db;
  $result = $db->get_row("SELECT max(id)+1 as newValue from pengguna");

  switch (strlen($result->newValue)) {
    case 1:
      $new_username = '100'.$result->newValue;
      break;
    case 2:
      $new_username = '10'.$result->newValue;
      break;
    case 3:
      $new_username = '1'.$result->newValue;
      break;
    default:
      $new_username = $result->newValue;
      break;
  }
  return $new_username;
}

function getSiswaOptions($selected = ''){
    global $db;
    $a = '';
    $rows = $db->get_results("SELECT id, nama, kelas FROM siswa ORDER BY kelas,nama");
    foreach($rows as $row){
        if($row->id==$selected)
            $a.="<option value='$row->id' selected>[$row->kelas] $row->nama</option>";
        else
            $a.="<option value='$row->id'>[$row->kelas] $row->nama</option>";
    }
    return $a;
}

function getPesertaOptions($selected = ''){
    global $db;
    $a = '';
    $rows = $db->get_results("SELECT id, nama FROM peserta ORDER BY nama");
    foreach($rows as $row){
        if($row->id==$selected)
            $a.="<option value='$row->id' selected>$row->nama</option>";
        else
            $a.="<option value='$row->id'>$row->nama</option>";
    }
    return $a;
}


function getEkskulOptions($selected = ''){
    global $db;
    $a = '';
    $rows = $db->get_results("SELECT id, nama, wajib FROM ekskul ORDER BY wajib DESC");
    foreach($rows as $row){
        if($row->id==$selected)
            $a.="<option value='$row->id' selected>$row->nama</option>";
        else
            $a.="<option value='$row->id'>$row->nama</option>";
    }
    return $a;
}

function getEkskulPengurusOptions($selected = ''){
    global $db;
    $a = '';
    $rows = $db->get_results("SELECT id, nama, wajib FROM ekskul WHERE id_pengurus='$_SESSION[userid]' ORDER BY wajib DESC");
    foreach($rows as $row){
        if($row->id==$selected)
            $a.="<option value='$row->id' selected>$row->nama</option>";
        else
            $a.="<option value='$row->id'>$row->nama</option>";
    }
    return $a;
}

function uploadFoto(){
    $namafile = $_FILES['foto']['name'];
    $ukuranfile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpnama = $_FILES['foto']['tmp_name'];

    // Cek ada gambar yg diupload/tidak
    if ($error === 4) {
        $value = ($_POST['tmp_foto']) ? $_POST['tmp_foto'] : '';
        return $value;
    }

    // Cek pastikan file yang diupload adalah foto/gambar
    $ekstensigambarvalid = ['jpg','jpeg','png'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
        echo "<script> alert('File yang diupload bukan foto/gambar') </script>";
        return false;
    }

    // Cek ukuran file
    //Jika lebih dari 2MB atau error code 1: The uploaded file exceeds the upload_max_filesize
    if ($ukuranfile > 2000000 || $error === 1) {
        echo "<script> alert('Ukuran file terlalu besar!') </script>";
        return false;
    }

    // Pengecekan selesai, Foto/Gambar siap upload!
    // Generate nama baru
    $namafilebaru = uniqid().'_'.uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    move_uploaded_file($tmpnama, '../images/'.$namafilebaru);
    return $namafilebaru;
}

