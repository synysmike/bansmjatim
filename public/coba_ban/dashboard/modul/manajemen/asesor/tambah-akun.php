<?php
session_start();
include_once '../../../../inc/inc.koneksi.php';
include_once '../../../../inc/inc.library.php';
if (empty($_SESSION['username'])) {
    header('location:../../../');
} else {
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];
    $level = $_SESSION['level'];
    $jabatan = $_SESSION['jabatan'];
}
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
    exit;
}
?>
<form action="setEmployee" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-header">
        <h4><i class="bx bx-folder-plus"></i> Tambah Akun Manajemen</h4>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" placeholder="nama akun" aria-describedby="defaultFormControlHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="text" class="form-control" placeholder="kata sandi" aria-describedby="defaultFormControlHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="text" class="form-control" placeholder="kata sandi" aria-describedby="defaultFormControlHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">No. HP</label>
            <input type="text" class="form-control" placeholder="nomor hp" aria-describedby="defaultFormControlHelp">
        </div>

    </div>
    <div class="modal-footer">
        <button type="submit" name="addEmployee" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
    </div>
</form>
<script>

</script>