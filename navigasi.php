<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="row">
                <div class="image col-xs-6 col-md-8" style="float: none; margin: 0 auto;">
                    <img src="/sid/gambar/loader.gif" class="img-rounded pasfoto" alt="User Image"/>
                </div>
            </div>
            <div class="row">
                <div class="info col-md-12" style="text-align: center;">
                    <h3>
                        <span class="user_gelar_akademik_depan"></span>
                        <span class="nama_dosen">,</span>
                        <span class="user_gelar_akademik_belakang"></span>
                    </h3>
                    <h4>(<?php echo $_SESSION['nidn']; ?>)</h4>
                </div>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="<?php
            if ($page == "data_dosen") {
                echo 'active';
            }
            ?>">
                <a href="data_dosen.php">
                    <i class="fa fa-edit"></i> <span>Data Dosen</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>
            </li>
            <li class="treeview <?php
            if (($page == "upload_pasfoto")) {
                echo 'active';
            }
            ?>">
                <a href="#">
                    <i class="fa fa-upload"></i> <span>Upload</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" <?php
                if ($page == "u_pasfoto") {
                    echo 'style="display:block;"';
                }
                ?>>
                    <li class="<?php
                    if ($page == "u_pasfoto") {
                        echo 'active';
                    }
                    ?>"><a href="u_pasfoto.php"><i class="fa fa-user"></i> Pas Foto</a></li>
                    <li class=""><a href="#"><i class="fa fa-certificate"></i> Sertifikat</a></li>
                    <li class=""><a href="#"><i class="fa fa-trophy"></i> HKI</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>