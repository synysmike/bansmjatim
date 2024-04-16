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
<form action="setStage" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-header">
        <h4><i class="bx bx-folder-plus"></i> Tambah Tahap Visitasi</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Tahun</label>
                    <select class="form-control border border-default" title="Pilih Tahun" data-live-search="true" data-size="5" name="thn" id="thn" required>
                        <?php
                        $sekarang = date('Y');
                        for ($i = $sekarang - 1; $i <= $sekarang + 1; $i++) {
                            $select = $sekarang == $i ? 'selected' : '';
                            echo '<option value="' . $i . '"' . $select . '>' . $i . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Nama Tahap</label>
                    <input type="text" class="form-control" placeholder="contoh. Tahap I" id="thp" name="thp" required>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" name="addStage" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $('#thn').selectpicker();
    });
</script>