/**
 * Main
 */

'use strict';
$(window).on('load', function () {
  if ($('.cover').length) {
    $('.cover').parallax({
      imageSrc: $('.cover').data('image'),
      zIndex: '1'
    });
  }

  $("#preloader").animate({
    'opacity': '0'
  }, 600, function () {
    setTimeout(function () {
      $("#preloader").css("visibility", "hidden").fadeOut();
    }, 300);
  });
});


$('#formAuthentication').submit(function (e) {
  e.preventDefault();
  var valid = true;
  var username = $("#username").val();
  var password = $("#password").val();
  const btnLogin = document.querySelector('.btn-login');
  const btnLoading = document.querySelector('.btn-loading');
  $.ajax({
    url: "inc/checklogin",
    type: "POST",
    data: { 'username': username, 'password': password },
    success: function (data) {
      if (data == 0) {
        btnLogin.classList.toggle('d-none');
        btnLoading.classList.toggle('d-none');
        Swal.fire({
          title: 'Username dan Password \n tidak sesuai',
          text: "Cek kembali username dan password anda !",
          confirmButtonColor: '#696cff',
          confirmButtonText: 'Ok',
          allowOutsideClick: false
        }).then((result) => {
          if (result.isConfirmed) {
            btnLogin.classList.toggle('d-none');
            btnLoading.classList.toggle('d-none');

          }
        });

      } else if (data !== 1) {
        btnLogin.classList.toggle('d-none');
        btnLoading.classList.toggle('d-none');
        var username = $("#username").val();
        $.ajax({
          url: "inc/redirect",
          type: "POST",
          data: { 'username': username, 'password': password },
          dataType: "text",
          success: function (data) {
            Swal.fire({
              title: "Login Sukses",
              icon: "success",
              timer: 1500,
              showConfirmButton: false
            }).then(function () {
              if (true) {
                window.location = "./";
              }
            });

          }
        });
      } else {
        console.log("invalid");
      }
    }
  });
  //
});

var myLoadingPage
function loadingPage() {
  myLoadingPage = setTimeout(showPage, 100);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("content").style.display = "block";
}

$(document).ready(function () {
  $('[data-toggle="counter-up"]').counterUp({
    delay: 10,
    time: 1000
  });
});
var _validFileExtensions = [".jpg"];
function ValidateSingleInputJPG(oInput) {
  if (oInput.type == "file") {
    var sFileName = oInput.value;
    if (sFileName.length > 0) {
      var blnValid = false;
      for (var j = 0; j < _validFileExtensions.length; j++) {
        var sCurExtension = _validFileExtensions[j];
        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
          blnValid = true;
          break;

        }
      }

      if (!blnValid) {
        Swal.fire({
          icon: 'error',
          title: 'File format harus JPG !',
          showConfirmButton: true,
          timer: 5000
        });
        oInput.value = "";
        return false;
      }
    }
  }
  return true;
};

var _validFileExtensionpdf = [".pdf"];
function ValidateSingleInputpdf(oInput) {
  if (oInput.type == "file") {
    var sFileName = oInput.value;
    if (sFileName.length > 0) {
      var blnValid = false;
      for (var j = 0; j < _validFileExtensionpdf.length; j++) {
        var sCurExtension = _validFileExtensionpdf[j];
        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
          blnValid = true;
          break;

        }
      }

      if (!blnValid) {
        Swal.fire({
          icon: 'error',
          title: 'File format harus pdf !',
          showConfirmButton: true,
          timer: 5000
        });
        oInput.value = "";
        return false;
      }
    }
  }
  return true;
};

function ValidateSize(file) {
  var FileSize = file.files[0].size;
  if (FileSize > 1000000) {
    Swal.fire({
      icon: 'error',
      title: 'Ukuran file maks 1MB',
      showConfirmButton: true,
      timer: 5000
    });
    oInput.value = "";
    return false;
  } else {

  }
}

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
$(".custom-file-input").on("change", function () {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});


//sidebar
$(document).ready(function () {
  $('#commingSoon').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-dialog-centered modal-md');
    document.getElementById("load-comingsoon").style.display = "block";
    document.getElementById("comingsoon").style.display = "none";
    $.ajax({
      url: 'dashboard/modul/comingSoonPage',
      success: function (data) {
        document.getElementById("load-comingsoon").style.display = "none";
        document.getElementById("comingsoon").style.display = "block";
        $('.comingsoon').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

// akun
$(document).ready(function () {
  $('#importAccount').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-import-account").style.display = "block";
    document.getElementById("import-account").style.display = "none";
    $.ajax({
      url: 'dashboard/modul/manajemen/akun/import-akun',
      success: function (data) {
        document.getElementById("load-import-account").style.display = "none";
        document.getElementById("import-account").style.display = "block";
        $('.import-account').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

// $(document).ready(function () {
//   $('#editAccount').on('show.bs.modal', function (e) {
//     $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
//     document.getElementById("load-edit-account").style.display = "block";
//     document.getElementById("edit-account").style.display = "none";
//     const id = $(e.relatedTarget).data('id');
//     $.ajax({
//       type: 'post',
//       url: 'dashboard/modul/manajemen/akun/edit-akun',
//       data: 'id=' + id,
//       success: function (data) {
//         document.getElementById("load-edit-account").style.display = "none";
//         document.getElementById("edit-account").style.display = "block";
//         $('.edit-account').html(data);
//       }
//     });
//   });
//   $('.modal').on('hide.bs.modal', function (e) {
//     $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
//   });
// });

$('#uploadBC').click(function () {
  if ($(this).is(':checked')) {

    $('#setuju_upload_bc').removeAttr('disabled');

  } else {
    $('#setuju_upload_bc').attr('disabled', true);
  }
});

// tahap
$(document).ready(function () {
  $('#addStage').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-stage").style.display = "block";
    document.getElementById("add-stage").style.display = "none";
    $.ajax({
      url: 'dashboard/modul/manajemen/tahap_visitasi/tambah-tahap-visitasi',
      success: function (data) {
        document.getElementById("load-add-stage").style.display = "none";
        document.getElementById("add-stage").style.display = "block";
        $('.add-stage').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#activeYear').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-active-year").style.display = "block";
    document.getElementById("active-year").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const statusAwal = 0;
    const statusAkhir = 1;
    $.ajax({
      type: 'post',
      url: 'dashboard/modul/manajemen/tahap_visitasi/aktifkan-tahap',
      data: { 'id': id, 'statusAwal': statusAwal, 'statusAkhir': statusAkhir },
      success: function (data) {
        document.getElementById("load-active-year").style.display = "none";
        document.getElementById("active-year").style.display = "block";
        $('.active-year').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#deactiveYear').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-deactive-year").style.display = "block";
    document.getElementById("deactive-year").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const statusAwal = 1;
    const statusAkhir = 0;
    $.ajax({
      type: 'post',
      url: 'dashboard/modul/manajemen/tahap_visitasi/aktifkan-tahap',
      data: { 'id': id, 'statusAwal': statusAwal, 'statusAkhir': statusAkhir },
      success: function (data) {
        document.getElementById("load-deactive-year").style.display = "none";
        document.getElementById("deactive-year").style.display = "block";
        $('.deactive-year').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});






