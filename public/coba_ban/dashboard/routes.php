<?php
$do = explode("/", $_REQUEST['do']);
$opsi = $do[0];

define('PUB_DIR', dirname(__FILE__) . '/');

switch ($opsi) {
    case 'home':
        require_once(PUB_DIR . 'modul/home.php');
        break;
        //manajemen
    case 'account':
        require_once(PUB_DIR . 'modul/manajemen/data_akun.php');
        break;
    case 'setAccount':
        require_once(PUB_DIR . 'modul/manajemen/akun/akun-aksi.php');
        break;
    case 'asesor':
        require_once(PUB_DIR . 'modul/manajemen/data_asesor.php');
        break;
    case 'setAsesor':
        require_once(PUB_DIR . 'modul/manajemen/asesor/asesor-aksi.php');
        break;
    case 'school':
        require_once(PUB_DIR . 'modul/manajemen/data_sekolah.php');
        break;
    case 'setSchool':
        require_once(PUB_DIR . 'modul/manajemen/sekolah/sekolah-aksi.php');
        break;
    case 'stage':
        require_once(PUB_DIR . 'modul/manajemen/data_tahap_visitasi.php');
        break;
    case 'mappingStage':
        require_once(PUB_DIR . 'modul/manajemen/tahap_visitasi/mapping-visitasi.php');
        break;
    case 'checkFileVisit':
        require_once(PUB_DIR . 'modul/manajemen/tahap_visitasi/cek-berita-acara-visitasi.php');
        break;
    case 'setStage':
        require_once(PUB_DIR . 'modul/manajemen/tahap_visitasi/tahap-visitasi-aksi.php');
        break;

        //asesor
    case 'uploadAsesor':
        require_once(PUB_DIR . 'modul/upload_asesor/aktifitas-asesor-aksi.php');
        break;

        //signout
    case 'logout':
        require_once(PUB_DIR . '../signout.php');
        break;

    default:
        require_once(PUB_DIR . 'modul/home.php');
}
