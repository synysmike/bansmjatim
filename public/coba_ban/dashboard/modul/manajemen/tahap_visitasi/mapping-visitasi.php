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
if (in_array(1, $arrayAkses) && isset($_GET['_token'])) {
  $id_tahap = decrypt($_GET['_token']);
  $sqlMapStage = mysqli_query($myConnection, "select * from tb_tahap_akreditasi where id_tahap = '$id_tahap'");
  if (mysqli_num_rows($sqlMapStage) > 0) {
    $viewMapStage = mysqli_fetch_array($sqlMapStage); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="card border border-primary">
        <div class="card-header ">
          <div class="row">
            <div class="col">
              <h5 class="card-title">Mapping Visitasi <?= $viewMapStage['tahap'] . ' Tahun ' . $viewMapStage['thn_tahap'] ?></h5>
            </div>
            <div class="col text-end">
              <a href="stage" title="Mapping Data Asesor" class="btn btn-sm btn-warning"><i class='bx bx-arrow-to-left'></i> Kembali</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="col-6">
            <div class="card bg-success">
              <div class="card-body">
                <form action="setStage" method="post" role="form" enctype="multipart/form-data">
                  <h5 class="text-white">Import Excel Mapping</h5>
                  <div class="input-group">
                    <input type="file" accept=".xls,.xlsx" onchange="ValidateSingleInputExcel(this);" name="file_excel" class="form-control custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
                    <button class="btn btn-primary cekButton" type="submit" id="inputGroupFileAddon04" name="importMapping" disabled>Upload</button>
                  </div>
                  <input type="hidden" name="_key" value="<?= encrypt($id_tahap) ?>">
                  <label class="mt-2 text-white fw-bold">Format Import Mapping bisa di <a href="temp_folder_uploads/format_mapping.xlsx" class="btn btn-sm btn-danger">Download Disini</a></label>
                </form>
              </div>
            </div>
          </div>
          <div class="table-responsive text-nowrap mt-4">
            <table id="member_table" class="table table table-bordered table-hover" width="100%">
              <thead>
                <tr>
                  <th class="text-center text-nowrap align-middle">No.</th>
                  <th class="text-center text-nowrap align-middle">Nama TIM</th>
                  <th class="text-center text-nowrap align-middle">Asesor 1</th>
                  <th class="text-center text-nowrap align-middle">Asesor 2</th>
                  <th class="text-center text-nowrap align-middle">Nama Sekolah</th>
                  <th class="text-center text-nowrap align-middle">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $sqlTahap = mysqli_query($myConnection, "select tb_mapping_visitasi.*, tb_sekolah.nama_sek as nama_sek from tb_mapping_visitasi left join tb_sekolah on tb_sekolah.npsn = tb_mapping_visitasi.npsn where tb_mapping_visitasi.id_tahap = '$id_tahap' group by tb_mapping_visitasi.npsn");
                while ($viewTahap = mysqli_fetch_array($sqlTahap)) { ?>
                  <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $viewTahap['nama_tim'] ?></td>
                    <td>
                      <?php
                      $npsn = $viewTahap['npsn'];
                      $viewA1 = mysqli_fetch_array(mysqli_query($myConnection, "select tb_mapping_visitasi.nia, tb_asesor.nama as nama1 from tb_mapping_visitasi left join tb_asesor on tb_asesor.nia = tb_mapping_visitasi.nia where tb_mapping_visitasi.id_tahap = '$id_tahap' and tb_mapping_visitasi.npsn = '$npsn' and tb_mapping_visitasi.jabatan_nia ='A1'"));
                      echo '(' . $viewA1['nia'] . ') ' . $viewA1['nama1'];
                      ?>
                    </td>
                    <td>
                      <?php
                      $viewA2 = mysqli_fetch_array(mysqli_query($myConnection, "select tb_mapping_visitasi.nia, tb_asesor.nama as nama2 from tb_mapping_visitasi left join tb_asesor on tb_asesor.nia = tb_mapping_visitasi.nia where tb_mapping_visitasi.id_tahap = '$id_tahap' and tb_mapping_visitasi.npsn = '$npsn' and tb_mapping_visitasi.jabatan_nia ='A2'"));
                      echo '(' . $viewA2['nia'] . ') ' . $viewA2['nama2'];
                      ?>
                    </td>
                    <td><?= $viewTahap['nama_sek'] ?></td>
                    <td class="text-center text-nowrap">
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
  <?php } else { ?>
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="card border border-primary col-6">
        <div class="card-body">
          <h2>Data Tidak Ditemukan</h2>
          <p>Error 404<br>Object not found!<br>The requested URL was not found on this server.</p>
        </div>
      </div>
    </div>
  <?php }
} else { ?>
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card border border-primary col-6">
      <div class="card-body">
        <h2>Nyari apa.... 🤣</h2>
        <p>Error 404<br>Object not found!<br>The requested URL was not found on this server.</p>
      </div>
    </div>
  </div>
<?php } ?>