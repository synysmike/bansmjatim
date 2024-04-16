<?php
$time_start = microtime(true);
require_once './inc/inc.koneksi.php';
require_once './inc/inc.library.php';
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
            <h5 class="card-title">Data Tahap Visitasi</h5>
          </div>
          <div class="col text-end">
            <button type="button" class="btn btn-sm btn-primary" title="Tambah Tahap Akreditasi" accesskey="w" data-bs-toggle="modal" data-bs-target="#addStage">
              <span class="tf-icons bx bx-edit"></span> Tambah Tahap
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
                <th class="text-center text-nowrap align-middle">Tahun</th>
                <th class="text-center text-nowrap align-middle">Tahap</th>
                <th class="text-center text-nowrap align-middle">Status</th>
                <!-- <th class="text-center text-nowrap align-middle">Tanggal</th> -->
                <th class="text-center text-nowrap align-middle">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $sqlTahap = mysqli_query($myConnection, "select * from tb_tahap_akreditasi where soft_delete =0");
              while ($viewTahap = mysqli_fetch_array($sqlTahap)) { ?>
                <tr>
                  <td class="text-center"><?= $no++ ?></td>
                  <td class="text-center"><?= $viewTahap['thn_tahap'] ?></td>
                  <td><?= $viewTahap['tahap'] ?></td>
                  <td class="text-center">
                    <?php
                    if ($viewTahap['status_aktif'] == 0) { ?>
                      <button type="button" class="btn btn-sm btn-danger me-2" data-bs-toggle="modal" data-bs-target="#activeYear" data-id="<?= $viewTahap['id_tahap'] ?>">
                        <span class="tf-icons bx bx-x"></span> Non-Aktif
                      </button>
                    <?php } else { ?>
                      <button type="button" class="btn btn-sm btn-success me-2" data-bs-toggle="modal" data-bs-target="#deactiveYear" data-id="<?= $viewTahap['id_tahap'] ?>">
                        <span class="tf-icons bx bx-check"></span> Aktif
                      </button>
                    <?php } ?>
                  </td>
                  <!-- <td class="text-center"><?= $viewTahap['tgl_tahap'] ?></td> -->
                  <td class="text-center text-nowrap">
                    <a href="mappingStage?_token=<?= encrypt($viewTahap['id_tahap']) ?>" title="Mapping Data Asesor" class="btn btn-sm btn-primary"><i class='bx bxs-user-badge'></i></a>
                    <a href="checkFileVisit?_token=<?= encrypt($viewTahap['id_tahap']) ?>" title="Cek File Berita Acara Asesor" class="btn btn-sm btn-info"><i class='bx bx-file'></i></a>
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
  <div class="modal fade" id="addStage" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div id="load-add-stage" style="display: none;">
          <div class="modal-body">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            loading......
          </div>
        </div>
        <div class="add-stage" id="add-stage"></div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="activeYear" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div id="load-active-year" style="display: none;">
          <div class="modal-body">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            loading......
          </div>
        </div>
        <div class="active-year" id="active-year"></div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="deactiveYear" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div id="load-deactive-year" style="display: none;">
          <div class="modal-body">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            loading......
          </div>
        </div>
        <div class="deactive-year" id="deactive-year"></div>
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