<?php
include_once 'inc/inc.koneksi.php';
include_once 'inc/inc.library.php';
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "stage"
    </script>';
    exit;
}
$arrayAkses = explode(",", $_SESSION['level']);

if (in_array(1, $arrayAkses)) {
    if (isset($_POST['addStage'])) {
        $code2 = time() . '-' . uniqid();
        $code = strtoupper($code2);
        $created_by = $_SESSION['id'];
        $thn = mysqli_escape_string($myConnection, $_POST['thn']);
        $thp = mysqli_escape_string($myConnection, $_POST['thp']);

        $insertAccount = mysqli_query($myConnection, "insert into tb_tahap_akreditasi (id_tahap, thn_tahap, tahap) values ('$code','$thn', '$thp')");
        if ($insertAccount) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Akun berhasil ditambahkan'})";
            echo "<script> window.location='stage'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Akun gagal ditambahkan'})";
            echo "<script> window.location='stage'; </script>";
        }
    } elseif (isset($_POST['statusStage'])) {
        $created_by = $_SESSION['id'];
        $id_tahap = mysqli_escape_string($myConnection, $_POST['_token']);
        $status =  decrypt($_POST['_key']);
        if ($status === '1' || $status === '0') {
            $updateStatus = mysqli_query($myConnection, "update tb_tahap_akreditasi set status_aktif = '$status' where id_tahap = '$id_tahap'");
            if ($updateStatus) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Status Tahun berhasil diubah'})";
                echo "<script> window.location='stage'; </script>";
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Status Tahun gagal diubah'})";
                echo "<script> window.location='stage'; </script>";
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='stage'; </script>";
        }
    } elseif (isset($_POST['importMapping'])) {
        $created_by = $_SESSION['id'];
        $id_tahap = mysqli_escape_string($myConnection, decrypt($_POST['_key']));
        $sqlCek = mysqli_num_rows(mysqli_query($myConnection, "select id_tahap from tb_tahap_akreditasi where id_tahap = '$id_tahap'"));
        if ($sqlCek > 0) {
            $now = date("dmYHis");
            $type = explode(".", $_FILES['file_excel']['name']);
            $target_dir = "temp_folder_uploads/" . $now . "." . strtolower(end($type));
            move_uploaded_file($_FILES['file_excel']['tmp_name'], $target_dir);
            require('assets/vendor/libs/upload_excel/excel_reader2.php');
            require('assets/vendor/libs/upload_excel/SpreadsheetReader.php');
            $Reader = new SpreadsheetReader($target_dir);
            foreach ($Reader->Sheets() as $sheet) {
            }
            if ($sheet === 'import_mapping') {
                foreach ($Reader as $Key => $Row) {
                    $code2 = time() . '-' . uniqid();
                    $code = strtoupper($code2);
                    if ($Key < 1) continue;
                    $tim = htmlspecialchars(addslashes($Row[1]));
                    $nia = htmlspecialchars(addslashes($Row[2]));
                    $npsn = htmlspecialchars(addslashes($Row[3]));
                    $jab = htmlspecialchars(addslashes($Row[4]));
                    mysqli_query($myConnection, "insert into tb_mapping_visitasi (id, nama_tim, nia, npsn, jabatan_nia, id_tahap) values ('$code', '$tim','$nia','$npsn', '$jab', '$id_tahap')");
                    $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Mapping berhasil disimpan'})";
                    echo '<script> window.location="mappingStage?_token=' . encrypt($id_tahap) . '"; </script>';
                }
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Sheet import_mapping tidak ditemukan'})";
                echo '<script> window.location="mappingStage?_token=' . encrypt($id_tahap) . '"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='stage'; </script>";
        }
    } else {
        echo '<script type="text/javascript">
	window.location = "stage"
	</script>';
    }
} else {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
}
