<?php
include_once 'inc/inc.koneksi.php';
include_once 'inc/inc.library.php';
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "account"
    </script>';
    exit;
}
$arrayAkses = explode(",", $_SESSION['level']);

if (in_array(1, $arrayAkses)) {
    if (isset($_POST['addAccount'])) {
        $code2 = time() . '-' . uniqid();
        $code = strtoupper($code2);
        $created_by = $_SESSION['id'];
        $username = htmlspecialchars(mysqli_escape_string($myConnection, trim($_POST['user'])));
        $sqlCekUsernama = mysqli_query($myConnection, "select user_manajemen from akun_manajemen where user_manajemen = '$username'");
        if (mysqli_num_rows($sqlCekUsernama) > 0) {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Username telah terpakai'})";
            echo "<script> window.location='account'; </script>";
        } else {
            $password = encrypt($_POST['pass']);
            $ptk_id =  mysqli_escape_string($myConnection, $_POST['guru_karyawan']);
            $sqlCekGuru = mysqli_query($myConnection, "select ptk_id, nama from tb_guru_karyawan where ptk_id = '$ptk_id'");
            if (mysqli_num_rows($sqlCekGuru) > 0) {
                $nama_manajemen = mysqli_fetch_array($sqlCekGuru)['nama'];
                $akses = [];
                foreach ($_POST['akses'] as $arr) {
                    $akses[] = $arr;
                }
                if (in_array(1, $akses)) {
                    $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
                    echo "<script> window.location='account'; </script>";
                } else {
                    $listAkses = implode(',', $akses);
                    $insertAccount = mysqli_query($myConnection, "insert into akun_manajemen (id_manajemen, user_manajemen, pass_manajemen, nama_manajemen, ptk_id, level_manajemen, status_manajemen, created_by, created_date) values ('$code', '$username', '$password', '$nama_manajemen', '$ptk_id', '$listAkses', 'aktif', '$created_by', NOW())");
                    if ($insertAccount) {
                        $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Akun berhasil ditambahkan'})";
                        echo "<script> window.location='account'; </script>";
                    } else {
                        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Akun gagal ditambahkan'})";
                        echo "<script> window.location='account'; </script>";
                    }
                }
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
                echo "<script> window.location='account'; </script>";
            }
        }
    } elseif (isset($_POST['editAccount'])) {
        $created_by = $_SESSION['id'];
        $id_manajemen = mysqli_escape_string($myConnection, $_POST['_token']);
        $sqlCekID = mysqli_query($myConnection, "select user_manajemen from akun_manajemen where id_manajemen = '$id_manajemen'");
        if (mysqli_num_rows($sqlCekID) > 0) {
            $akses = [];
            foreach ($_POST['akses'] as $arr) {
                $akses[] = $arr;
            }
            if (in_array(1, $akses)) {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
                echo "<script> window.location='account'; </script>";
            } else {
                $listAkses = implode(',', $akses);
                $updateAccount = mysqli_query($myConnection, "update akun_manajemen set level_manajemen = '$listAkses' where soft_delete = 0 and id_manajemen = '$id_manajemen'");
                if ($updateAccount) {
                    $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Akun berhasil ditambahkan'})";
                    echo "<script> window.location='account'; </script>";
                } else {
                    $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Akun gagal ditambahkan'})";
                    echo "<script> window.location='account'; </script>";
                }
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='account'; </script>";
        }
    } elseif (isset($_POST['importAccount'])) {
        $created_by = $_SESSION['id'];

        $now = date("dmYHis");
        $type = explode(".", $_FILES['file_excel']['name']);
        $target_dir = "temp_folder_uploads/" . $now . "." . strtolower(end($type));
        move_uploaded_file($_FILES['file_excel']['tmp_name'], $target_dir);
        require('assets/vendor/libs/upload_excel/excel_reader2.php');
        require('assets/vendor/libs/upload_excel/SpreadsheetReader.php');
        $Reader = new SpreadsheetReader($target_dir);
        foreach ($Reader->Sheets() as $sheet) {
        }
        if ($sheet === 'import_akun') {
            foreach ($Reader as $Key => $Row) {
                $code2 = time() . '-' . uniqid();
                $code = strtoupper($code2);
                if ($Key < 1) continue;
                $user = $Row[0];
                $pass = encrypt($Row[1]);
                $nama = htmlspecialchars(addslashes($Row[2]));
                mysqli_query($myConnection, "insert into akun_manajemen (id_manajemen, user_manajemen, pass_manajemen, nama_manajemen, level_manajemen, status_manajemen, created_by) values ('$code', '$user', '$pass', '$nama', '2', 'aktif', '$created_by')");
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Akun berhasil ditambahkan'})";
                echo "<script> window.location='account'; </script>";
            }
        } else {
            echo 'tidak ada sheet';
        }
    } else {
        echo '<script type="text/javascript">
	window.location = "account"
	</script>';
    }
} else {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
}
