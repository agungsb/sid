<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="row">
                <div class="image col-xs-6 col-md-8" style="float: none; margin: 0 auto;">
                    <?php if ($_SESSION['level'] == "dosen") { ?>
                        <img src="/sid/gambar/loader.gif" class="img-rounded nav_pasfoto" alt="User Image"/>
                    <?php } else if ($_SESSION['level'] == "admin_sid") { ?>
                        <img src="/sid/gambar/foto_default.png" class="img-rounded nav_pasfoto" alt="Admin Image"/>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="info col-md-12" style="text-align: center;">
                    <h3>
                        <span class="nav_user_gelar_akademik_depan"></span>
                        <span class="nav_nama_dosen"></span>
                        <span class="nav_user_gelar_akademik_belakang"></span>
                    </h3>
                    <h4><span class="nav_nidn"></span></h4>
                </div>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="<?php
            if ($page == "BERANDA") {
                echo 'active';
            }
            ?>">
                <a href="/sid/user/beranda">
                    <i class="fa fa-home"></i> <span>Beranda</span>
                </a>
            </li>
            <?php if ($_SESSION['level'] == "dosen") { ?>
                <li class="treeview <?php
                if (($page == "DATA DOSEN") || ($page == "RIWAYAT PENDIDIKAN") || ($page == "RIWAYAT MENGAJAR")) {
                    echo 'active';
                }
                ?>">
                    <a href="">
                        <i class="fa fa-th"></i> <span>Data</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu" <?php
                    if ($page == "DATA DOSEN") {
                        echo 'style="display:block;"';
                    }
                    ?>>
                        <li class="<?php
                        if ($page == "DATA DOSEN") {
                            echo 'active';
                        }
                        ?>"><a href="/sid/user/data/data_dosen"><i class="fa fa-angle-right"></i> Data Dosen</a></li>
                        <li class="<?php
                        if ($page == "RIWAYAT PENDIDIKAN") {
                            echo 'active';
                        }
                        ?>"><a href="/sid/user/data/riwayat_pendidikan"><i class="fa fa-angle-right"></i> Riwayat Pendidikan</a></li>
                        <li class="<?php
                        if ($page == "RIWAYAT MENGAJAR") {
                            echo 'active';
                        }
                        ?>"><a href="/sid/user/data/riwayat_mengajar"><i class="fa fa-angle-right"></i> Riwayat Mengajar</a></li>
                    </ul>
                </li>
                <li class="treeview <?php
                if (($page == "UPLOAD PAS FOTO")) {
                    echo 'active';
                }
                ?>">
                    <a href="">
                        <i class="fa fa-upload"></i> <span>Upload</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu" <?php
                    if ($page == "UPLOAD PAS FOTO") {
                        echo 'style="display:block;"';
                    }
                    ?>>
                        <li class="<?php
                        if ($page == "UPLOAD PAS FOTO") {
                            echo 'active';
                        }
                        ?>"><a href="/sid/user/upload/u_pasfoto"><i class="fa fa-angle-right"></i> Pas Foto</a></li>
                        <li class=""><a href="#"><i class="fa fa-angle-right"></i> Sertifikat</a></li>
                        <li class=""><a href="#"><i class="fa fa-angle-right"></i> HKI</a></li>
                    </ul>
                </li>
            <?php } else if ($_SESSION['level'] == "admin_sid") { ?>
                <li class="<?php
                if ($page == "BERANDA") {
                    echo 'active';
                }
                ?>">
                    <a href="/sid/user/daftar_pengguna">
                        <i class="fa fa-home"></i> <span>Daftar Pengguna</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>