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
    $arrayAkses = explode(",", $_SESSION['level']);
}
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
    exit;
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = mysqli_query($myConnection, "select * from akun_manajemen where soft_delete = 0 and id_manajemen = '$id'");
    if (mysqli_num_rows($sql) > 0) {
        $peg = mysqli_fetch_array($sql); ?>
        <form action="setAccount" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header">
                <h4><i class="bx bx-folder-plus"></i> Edit Akun Manajemen</h4>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Pegawai</label>
                    <input type="text" class="form-control" placeholder="nama akun" value="<?= $peg['nama_manajemen'] ?>" aria-describedby="defaultFormControlHelp" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" placeholder="nama akun" value="<?= $peg['user_manajemen'] ?>" aria-describedby="defaultFormControlHelp" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control" placeholder="kata sandi" value="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="defaultFormControlHelp" readonly>
                </div>

                <div class="">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="edit_akun" name="cek">
                            <label class="form-check-label" for="edit_akun">Saya yakin akan melakukan perubahan <strong>Data Akun</strong>.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= $peg['id_manajemen'] ?>" name="_token">
                <button type="submit" name="editAccount" class="btn btn-info" id="updateAkun" disabled>Update</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#guru_karyawan').selectpicker();
            });
            $('#edit_akun').click(function() {
                if ($(this).is(':checked')) {

                    $('#updateAkun').removeAttr('disabled');

                } else {
                    $('#updateAkun').attr('disabled', true);
                }
            });
        </script>
    <?php } else { ?>
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Error</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h2 class="text-center">Data Tidak Ditemukan</h2>
        </div>
<?php }
} else {
    echo '<script type="text/javascript">
    window.location = "../"
    </script>';
} ?>