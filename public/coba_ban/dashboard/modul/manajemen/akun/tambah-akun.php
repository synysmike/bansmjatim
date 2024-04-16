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
?>
<form action="setAccount" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-header">
        <h4><i class="bx bx-folder-plus"></i> Tambah Akun Manajemen</h4>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Nama Pegawai</label>
            <select class="form-control border border-default" title="Pilih Pegawai...." data-live-search="true" data-size="5" name="guru_karyawan" id="edit_guru_karyawan">
                <?php
                $sqlguru = mysqli_query($myConnection, "select tb_guru_karyawan.ptk_id, tb_guru_karyawan.nama
                from tb_guru_karyawan
                where tb_guru_karyawan.soft_delete = 0
                and tb_guru_karyawan.ptk_id not in (select ptk_id from akun_manajemen where soft_delete = 0 group by ptk_id)");
                while ($guruKar = mysqli_fetch_array($sqlguru)) {
                    echo '<option value="' . $guruKar['ptk_id'] . '">';
                    echo ucwords(strtolower($guruKar['nama']));
                    echo '</option>';
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" placeholder="nama akun" name="user" aria-describedby="defaultFormControlHelp" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="text" class="form-control" placeholder="kata sandi" name="pass" aria-describedby="defaultFormControlHelp" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Hak Akses</label>
            <div class="row">
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="2" name="akses[]" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1"> Admin Tata Usaha </label>
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="3" name="akses[]" id="defaultCheck2">
                        <label class="form-check-label" for="defaultCheck2"> Kepala Sekolah </label>
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="4" name="akses[]" id="defaultCheck3">
                        <label class="form-check-label" for="defaultCheck3"> Guru </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="5" name="akses[]" id="defaultCheck4">
                        <label class="form-check-label" for="defaultCheck4"> Wali Kelas </label>
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="6" name="akses[]" id="defaultCheck5">
                        <label class="form-check-label" for="defaultCheck5"> Guru BK </label>
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="7" name="akses[]" id="defaultCheck6">
                        <label class="form-check-label" for="defaultCheck6"> Operator PPDB </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" name="addAccount" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $('#edit_guru_karyawan').selectpicker();
    });
</script>