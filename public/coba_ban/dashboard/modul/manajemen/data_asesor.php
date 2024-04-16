<?php
$time_start = microtime(true);
require_once './inc/inc.koneksi.php';
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
$arrayAkses = explode(",", $_SESSION['level']);
if (in_array(1, $arrayAkses)) { ?>
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card border border-primary">
      <div class="card-header ">
        <div class="row">
          <div class="col">
            <h5 class="card-title">Data Asesor</h5>
          </div>
          <div class="col text-end">
            <a href="#" class="btn btn-sm btn-primary" title="Tambah Akun" data-bs-toggle="modal" accesskey="w" data-bs-target="#addAccount"><i class="fa fa-plus"></i> Tambah Pegawai</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive text-nowrap mt-4">
          <table id="member_table" class="table table table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center text-nowrap align-middle">No.</th>
                <th class="text-center text-nowrap align-middle">NIA</th>
                <th class="text-center text-nowrap align-middle">Nama</th>
                <th class="text-center text-nowrap align-middle">Unit Kerja</th>
                <th class="text-center text-nowrap align-middle">No. HP</th>
                <th class="text-center text-nowrap align-middle">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $sqlGuru = mysqli_query($myConnection, "select * from tb_asesor where soft_delete = 0");
              while ($viewGuru = mysqli_fetch_array($sqlGuru)) { ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $viewGuru['nia'] ?></td>
                  <td><?= $viewGuru['nama'] ?></td>
                  <td><?= $viewGuru['unit_kerja'] ?></td>
                  <td><?= $viewGuru['no_hp'] ?></td>
                  <td>
                    <button type="button" class="btn btn-sm btn-icon btn-success">
                      <span class="tf-icons bx bx-search"></span>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-primary">
                      <span class="tf-icons bx bx-edit"></span>
                    </button>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <?= "Process took " . number_format(microtime(true) - $time_start, 2) . " seconds."; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="addAccount" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div id="load-add-account" style="display: none;">
          <div class="modal-body">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            loading......
          </div>
        </div>
        <div class="add-account" id="add-account"></div>
      </div>
    </div>
  </div>
<?php } else { ?>
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card border border-primary col-6">
      <div class="card-body">
        <h2>Nyari apa.... 🤣</h2>
        <p>Error 404<br>Object not found!<br>The requested URL was not found on this server.</p>
      </div>
    </div>
  </div>
<?php } ?>