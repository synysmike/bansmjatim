<?php
include_once '../../../../inc/inc.koneksi.php';
session_start();
if (!isset($_SESSION['status_login'])) {
  echo '<script type="text/javascript">
  window.location = "./"
  </script>';
  exit;
}
?>
<div class="modal-header">
  <h4>Import Data Akun Baru</h4>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
  <form action="setAccount" method="post" role="form" enctype="multipart/form-data">
    <div class="input-group">
      <input type="file" accept=".xls,.xlsx" onchange="ValidateSingleInputExcel(this);" name="file_excel" class="form-control custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
      <button class="btn btn-outline-primary cekButton" type="submit" id="inputGroupFileAddon04" name="importAccount" disabled>Upload</button>
    </div>
  </form>
</div>
<script>
  var _validFileExtensionsExcel = [".xls", ".xlsx"];

  function ValidateSingleInputExcel(oInput) {
    if (oInput.type == "file") {
      var sFileName = oInput.value;
      if (sFileName.length > 0) {
        var blnValid = false;
        for (var j = 0; j < _validFileExtensionsExcel.length; j++) {
          var sCurExtension = _validFileExtensionsExcel[j];
          if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
            blnValid = true;
            break;

          }
        }

        if (!blnValid) {
          Swal.fire({
            icon: 'error',
            title: 'File format harus Excel !',
            showConfirmButton: true,
            timer: 5000
          });
          oInput.value = "";
          return false;
          $('.cekButton').attr('disabled', true);
        } else {
          $('.cekButton').removeAttr('disabled');
        }
      }
    }
    return true;
  };
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
</script>