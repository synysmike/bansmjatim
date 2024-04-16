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
              <h5 class="card-title">Berkas Berita Acara <?= $viewMapStage['tahap'] . ' Tahun ' . $viewMapStage['thn_tahap'] ?></h5>
            </div>
            <div class="col text-end">
              <a href="stage" title="Mapping Data Asesor" class="btn btn-sm btn-warning"><i class='bx bx-arrow-to-left'></i> Kembali</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive text-nowrap mt-4">
            <table id="member_table" class="table table table-bordered table-hover" width="100%">
              <thead>
                <tr>
                  <th class="text-center text-nowrap align-middle">No.</th>
                  <th class="text-center text-nowrap align-middle">Nama Sekolah</th>
                  <th class="text-center text-nowrap align-middle">Asesor 1</th>
                  <th class="text-center text-nowrap align-middle">Asesor 2</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $sqlTahap = mysqli_query($myConnection, "select tb_mapping_visitasi.*, tb_sekolah.nama_sek as nama_sek from tb_mapping_visitasi left join tb_sekolah on tb_sekolah.npsn = tb_mapping_visitasi.npsn where tb_mapping_visitasi.id_tahap = '$id_tahap' group by tb_mapping_visitasi.npsn");
                while ($viewTahap = mysqli_fetch_array($sqlTahap)) {
                  $npsn = $viewTahap['npsn'];
                  $viewA1 = mysqli_fetch_array(mysqli_query($myConnection, "select tb_mapping_visitasi.nia, tb_asesor.nama as nama1, tb_asesor.no_hp as no_hp1 from tb_mapping_visitasi left join tb_asesor on tb_asesor.nia = tb_mapping_visitasi.nia where tb_mapping_visitasi.id_tahap = '$id_tahap' and tb_mapping_visitasi.npsn = '$npsn' and tb_mapping_visitasi.jabatan_nia ='A1'"));
                  $viewA2 = mysqli_fetch_array(mysqli_query($myConnection, "select tb_mapping_visitasi.nia, tb_asesor.nama as nama2, tb_asesor.no_hp as no_hp2 from tb_mapping_visitasi left join tb_asesor on tb_asesor.nia = tb_mapping_visitasi.nia where tb_mapping_visitasi.id_tahap = '$id_tahap' and tb_mapping_visitasi.npsn = '$npsn' and tb_mapping_visitasi.jabatan_nia ='A2'"));
                ?>
                  <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td style="white-space:normal;"><?= $viewTahap['nama_sek'] ?></td>
                    <td class="text-center">
                      <?php
                      echo '<a href="https://api.whatsapp.com/send/?phone=' . $viewA1['no_hp1'] . '&text&type=phone_number&app_absent=0" target="_blank" class="btn btn-sm btn-success mb-2" title="Chat Whatsapp Asesor">(' . $viewA1['nia'] . ') ' . $viewA1['nama1'] . '</a><br><iframe src="file_upload/file_berita_acara/69986805_3522216046_1678868302.pdf" width="300" height="250"></iframe>';
                      ?>
                    </td>
                    <td class="text-center">
                      <?php
                      echo '<a href="https://api.whatsapp.com/send/?phone=' . $viewA2['no_hp2'] . '&text&type=phone_number&app_absent=0" target="_blank" class="btn btn-sm btn-success mb-2" title="Chat Whatsapp Asesor">(' . $viewA2['nia'] . ') ' . $viewA2['nama2'] . '</a><br><div><iframe src="file_upload/file_berita_acara/69986805_3522216046_1678868302.pdf" width="300" height="250"></iframe></div>';
                      ?>
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