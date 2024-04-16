<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="./" class="app-brand-link">
            <span class="app-brand-logo demo"></span>
            <span class="app-brand-text demo demo2 menu-text fw-bolder ms-2"><img src="img/logo.png" alt="" width="5%"> BAN S/M</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <!-- <hr> -->
    <ul class="menu-inner py-1" id="ulMenu">
        <li class="menu-item" id="home">
            <a href="./" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>
        <?php
        $arrayAkses = explode(",", $_SESSION['level']);
        if (in_array(1, $arrayAkses)) { ?>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-server"></i>
                    <div data-i18n="Layouts">Manajemen</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="account" class="menu-link">
                            <div>Data Akun</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="asesor" class="menu-link">
                            <div>Data Asesor</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="school" class="menu-link">
                            <div>Data Sekolah</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-server"></i>
                    <div data-i18n="Layouts">Visitasi</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="stage" class="menu-link">
                            <div>Tahap Visitasi</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <div>Mapping Visitasi</div>
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>

    </ul>
</aside>
<div class="modal fade" id="commingSoon" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-comingsoon" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="comingsoon" id="comingsoon"></div>
        </div>
    </div>
</div>