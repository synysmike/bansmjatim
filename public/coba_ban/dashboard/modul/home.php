<?php
require_once './inc/inc.koneksi.php';
require_once './inc/inc.library.php';
$hariIni = date('Y-m-d');
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
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-lg-8 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary">Selamat Datang, <?php echo $_SESSION['nama_akun']; ?> !</h5>
              <p class="mb-4">
                Manajemen Asesor<br>BAN S/M Provinsi Jawa Timur<br>Tahun <?= date('Y') ?>
              </p>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img src="assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  if ($_SESSION['level'] == 2) { ?>
    <div class="row">
      <div class="col-lg-8 mb-4 order-0">
        <div class="card">
          <div class="card-body">
            <?php
            $nia = $_SESSION['username'];
            $sqlMap = mysqli_query($myConnection, "select tb_mapping_visitasi.*, tb_sekolah.nama_sek as nama_sek
            from tb_mapping_visitasi
            left join tb_tahap_akreditasi on tb_tahap_akreditasi.id_tahap = tb_mapping_visitasi.id_tahap
            left join tb_sekolah on tb_sekolah.npsn = tb_mapping_visitasi.npsn
            where tb_tahap_akreditasi.status_aktif = 1
            and tb_mapping_visitasi.nia = '$nia'");
            if (mysqli_num_rows($sqlMap) > 0) { ?>
              <form action="uploadAsesor" method="post" role="form" enctype="multipart/form-data">
                <?php while ($viewSekolah = mysqli_fetch_array($sqlMap)) {
                  if ($viewSekolah['file_upload'] == '') {
                    $cekFile = '<i class="display-6 bx bx-x text-danger"></i></strong>';
                  } else {
                    $cekFile = '<i class="display-6 bx bx-check text-success"></i></strong>';
                  } ?>
                  <div class="mb-4">
                    <label><?= '<strong>' . $viewSekolah['nama_sek'] . ' ' . $cekFile ?></label>
                    <div class="input-group">
                      <input type="file" accept=".pdf" onchange="ValidateSingleInputpdf(this);ValidateSize(this);" name="file[]" class="form-control custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    </div>
                    <input type="hidden" name="_key[]" value="<?= encrypt($viewSekolah['npsn']) ?>">
                  </div>

                <?php } ?>
                <div class="">
                  <div class="form-check">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="form-check-input" id="uploadBC" name="cek">
                      <label class="form-check-label" for="uploadBC">Saya yakin berkas yang dilampirkan akan diunggah.</label>
                    </div>
                  </div>
                </div>
                <div class="pt-2 text-end">
                  <input type="hidden" name="_token" value="<?= encrypt($nia) ?>">
                  <button type="submit" name="uploadPPDB" class="btn btn-info" id="setuju_upload_bc" disabled>Simpan</button>
                </div>
              </form>
              <script type="text/javascript">

              </script>
            <?php } else {
              echo 'tidak ada visitasi';
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  <?php }
  ?>
</div>