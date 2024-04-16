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
if (isset($_SESSION['alert'])) : ?>
  <script>
    let Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true
    })
    <?php
    echo $_SESSION['alert'];
    unset($_SESSION['alert']);
    ?>
  </script>
<?php endif ?>
<?php
$arrayAkses = explode(",", $_SESSION['level']);
if (in_array(1, $arrayAkses)) { ?>
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card border border-primary">
      <div class="card-header ">
        <div class="row">
          <div class="col">
            <h5 class="card-title">Data Akun Manajemen</h5>
          </div>
          <div class="col text-end">
            <button type="button" class="btn btn-sm btn-primary" title="Tambah Akun" accesskey="w" data-bs-toggle="modal" data-bs-target="#addAccount">
              <span class="tf-icons bx bx-edit"></span> Tambah Akun
            </button>
            <button type="button" class="btn btn-sm btn-primary" title="Import Excel Akun" accesskey="w" data-bs-toggle="modal" data-bs-target="#importAccount">
              <span class="tf-icons bx bx-edit"></span> Import Akun
            </button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive text-nowrap mt-4">
          <table id="member_table" class="table table table-bordered table-hover" width="100%">
            <thead>
              <tr>
                <th class="text-center text-nowrap align-middle">No.</th>
                <th class="text-center text-nowrap align-middle">Username</th>
                <th class="text-center text-nowrap align-middle">Nama</th>
                <th class="text-center text-nowrap align-middle">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $sqlAkun = mysqli_query($myConnection, "select * from akun_manajemen where soft_delete = 0 and id_manajemen !='36daf4c0c9652712fd970ebacbe082fc'");
              while ($viewAkun = mysqli_fetch_array($sqlAkun)) { ?>
                <tr>
                  <td class="text-center"><?= $no++ ?></td>
                  <td><?= $viewAkun['user_manajemen'] ?></td>
                  <td><?= ucwords(mb_strtolower($viewAkun['nama_manajemen'])) ?></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-sm btn-icon btn-info me-2" data-bs-toggle="modal" data-bs-target="#editAccount" data-id="<?= $viewAkun['id_manajemen'] ?>">
                      <span class="tf-icons bx bx-edit"></span>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-danger">
                      <span class="tf-icons bx bx-trash "></span>
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
  <div class="modal fade" id="editAccount" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div id="load-edit-account" style="display: none;">
          <div class="modal-body">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            loading......
          </div>
        </div>
        <div class="edit-account" id="edit-account"></div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="importAccount" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div id="load-import-account" style="display: none;">
          <div class="modal-body">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            loading......
          </div>
        </div>
        <div class="import-account" id="import-account"></div>
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