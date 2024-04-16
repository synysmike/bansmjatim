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

if (in_array(1, $arrayAkses) || in_array(2, $arrayAkses)) {
    if (isset($_POST['uploadPPDB'])) {
        $code2 = time() . '-' . uniqid();
        $code = strtoupper($code2);
        $created_by = $_SESSION['id'];
        $nia = decrypt($_POST['_token']);
        $npsn = $_POST['_key'];
        $file_bc = $_FILES['file']['name'];
        $tmp_file_bc = $_FILES['file']['tmp_name'];


        $total = count($npsn);
        for ($i = 0; $i < $total; $i++) {
            $code2 = time() . '-' . uniqid();
            $code = strtoupper($code2);
            $upload_npsn = decrypt($npsn[$i]);
            // var_dump($upload_npsn);
            $upload_file_bc = $file_bc[$i];
            $upload_tmp_file_bc = $tmp_file_bc[$i];
            $file_bc_type = explode(".", $upload_file_bc);
            $file_bc_name = $upload_npsn . '_' . $nia . '_' . time() . '.' . end($file_bc_type);
            $path_file_bc = 'file_upload/file_berita_acara/' . $file_bc_name;

            if ($upload_file_bc == '') {
                $upload_file_bc_name = '';
            } else {
                $upload_file_bc_name = $file_bc_name;
            }
            $cek_upload = mysqli_fetch_array(mysqli_query($myConnection, "select file_upload from tb_mapping_visitasi where nia = '$nia' and npsn = '$upload_npsn'"));
            if ($cek_upload['file_upload'] != '') {
                $upload_file_bc_name = $cek_upload['file_upload'];
            } else {
                $upload_file_bc_name = $upload_file_bc_name;
            }

            move_uploaded_file($upload_tmp_file_bc, $path_file_bc);
            $sqlUpload = mysqli_query($myConnection, "update tb_mapping_visitasi set file_upload = '$upload_file_bc_name' where nia = '$nia' and npsn = '$upload_npsn'");
        }
        $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'File berhasil diupload'})";
        echo "<script> window.location='./'; </script>";
    } else {
        echo '<script type="text/javascript">
	window.location = "/"
	</script>';
    }
} else {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
}
