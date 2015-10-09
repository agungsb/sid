<?php
session_start();
$page = "DETAIL DOSEN";
if (!isset($_GET['nidn'])) {
    header("Location: index.php");
} else {
    $nidn = $_GET['nidn'];
    if (isset($_SESSION['nidn'])) { // Jika sudah login
        header("Location: ../user/detail/$nidn"); // Arahkan ke page yang sudah login
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $page ?> - <?php echo $nidn; ?> :: Sistem Informasi Dosen </title>
        <link rel="shortcut icon" href="/sid/gambar/unj_small.png" />
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="/sid/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="/sid/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="/sid/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="/sid/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="/sid/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="/sid/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="/sid/css/jQueryUI/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css"/>
        <!-- Typeahead -->
        <link rel="stylesheet" type="text/css" href="/sid/css/bootstrap-tagsinput.css">
        <link rel="stylesheet" type="text/css" href="/sid/js/plugins/rainbow-1.2.0/themes/github.css"/>  
        <link rel="stylesheet" href="/sid/js/assets/app.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-dark-green">
        <div class="loader"></div>
        <?php
        require_once 'header.php';
        ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <div class="loder"></div>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel"><!-- general form elements -->
                        <div class="box box-success">
                            <div class="box-header">
                                <h3 class="box-title">Login </h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="text" id="userid" name="userid" class="form-control" placeholder="NIDN" required="required"/>
                                </div>
                                <div class="form-group">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required"/>
                                </div>      
                                <button type="submit" class="btn btn-warning" id="blogin">Login</button> 
                            </div><!-- /.box-body -->

                            <div class="box-footer" id="log_message" style="display: none;">
                            </div>
                        </div><!-- /.box -->
                    </div><!-- /.user-panel -->
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo $page; ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/sid/index.php"><i class="fa fa-home"></i> BERANDA</a></li>
                        <li class="active"> <?php echo $page; ?></li>
                    </ol>
                </section>    

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- Custom Tabs (Pulled to the right) -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs pull-right">
                                    <li><a href="#riwayat_mengajar" data-toggle="tab">Riwayat Mengajar</a></li>
                                    <li><a href="#riwayat_pendidikan" data-toggle="tab">Riwayat Pendidikan</a></li>
                                    <li><a href="#status" data-toggle="tab">Status</a></li>
                                    <li><a href="#jabatan_akademik" data-toggle="tab">Jabatan Akademik</a></li>
                                    <li class="active"><a href="#data_diri" data-toggle="tab">Data Diri</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="data_diri">
                                        <div class="form-group">
                                            <label>Pas Foto</label>
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <img class="pasfoto"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>NIDN</label>
                                            <div class="form-control disabled_input_text nidn"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <div class="form-control disabled_input_text nama_dosen"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Gelar Akademik Depan</label>
                                            <div class="form-control disabled_input_text gelar_akademik_depan"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Gelar Akademik Belakang</label>
                                            <div class="form-control disabled_input_text gelar_akademik_belakang"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>NIP LAMA</label>
                                            <div class="form-control disabled_input_text nip_lama"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>NIP BARU</label>
                                            <div class="form-control disabled_input_text nip_baru"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>No KTP</label>
                                            <div class="form-control disabled_input_text no_ktp"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <div class="form-control disabled_input_text jenis_kelamin"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <div class="form-control disabled_input_text tempat_lahir"></div>
                                        </div>
                                        <!-- Date dd/mm/yyyy -->
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <div class="form-control disabled_input_text tanggal_lahir"></div>
                                        </div><!-- /.form group -->
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <div class="form-control disabled_input_text alamat"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kota</label>
                                            <div class="form-control disabled_input_text nama_kota"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Provinsi</label>
                                            <div class="form-control disabled_input_text nama_provinsi"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Pos</label>
                                            <div class="form-control disabled_input_text kode_pos"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Negara</label>
                                            <div class="form-control disabled_input_text nama_negara"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Telepon</label>
                                            <div class="form-control disabled_input_text telepon"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Hp</label>
                                            <div class="form-control disabled_input_text hp"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat E-mail</label>
                                            <div class="form-control disabled_input_text email"></div>
                                        </div>
                                    </div><!-- /.tab Data Diri -->
                                    <div class="tab-pane fade" id="jabatan_akademik">
                                        <form>
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Perguruan Tinggi</label>
                                                <div class="form-control disabled_input_text nama_perguruan_tinggi"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Fakultas</label>
                                                <div class="form-control disabled_input_text nama_fakultas"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Jurusan</label>
                                                <div class="form-control disabled_input_text nama_jurusan"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Program Studi</label>
                                                <div class="form-control disabled_input_text nama_program_studi"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Golongan</label>
                                                <div class="form-control disabled_input_text golongan"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Pangkat</label>
                                                <div class="form-control disabled_input_text pangkat"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Jabatan Fungsional</label>
                                                <div class="form-control disabled_input_text jabatan_fungsional"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Jabatan Struktural</label>
                                                <div class="form-control disabled_input_text jabatan_struktural"></div>
                                            </div>
                                        </form>
                                    </div><!-- /.tab Jabatan Akademik -->
                                    <div class="tab-pane fade" id="status">
                                        <form>
                                            <div class="form-group">
                                                <label>Status Aktif</label>
                                                <div class="form-control disabled_input_text status_aktif"></div>
                                            </div>
                                            <!-- Date dd/mm/yyyy -->
                                            <div class="form-group">
                                                <label>Mulai Masuk</label>
                                                <div class="input-group">
                                                    <div class="form-control disabled_input_text mulai_masuk_dosen"></div>
                                                </div><!-- /.input group -->
                                                <div class="form-group">
                                                    <label>No Sertifikasi Dosen</label>
                                                    <div class="form-control disabled_input_text no_sertifikasi_dosen"></div>
                                                </div>
                                                <!-- Date dd/mm/yyyy -->
                                                <div class="form-group">
                                                    <label>Tanggal Keluar Sertifikasi Dosen</label>
                                                    <div type="text" class="form-control disabled_input_text tanggal_keluar_sertifikasi_dosen"></div>
                                                </div><!-- /.form group -->
                                        </form>
                                    </div>
                                </div><!-- /.tab Status -->
                                <div class="tab-pane fade" id="riwayat_pendidikan">
                                    <table id="tabel_riwayat_pendidikan" class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Perguruan Tinggi</th>
                                                <th>Gelar Akademik</th>
                                                <th>Tanggal Ijazah</th>
                                                <th>Jenjang Pendidikan</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div><!-- /.tab Riwayat Pendidikan -->
                                <div class="tab-pane fade" id="riwayat_mengajar">
                                    <table id="tabel_riwayat_mengajar" class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Program Studi</th>
                                                <th>Jenjang Pendidikan</th>
                                                <th>Kode Mata Kuliah</th>
                                                <th>Nama Mata Kuliah</th>
                                                <th>SKS</th>
                                                <th>Semester</th>
                                                <th>Tahun Akademik</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div><!-- /.tab Riwayat Mengajar -->
                            </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->
                    </div> <!-- /.row -->
                    <!-- END CUSTOM TABS -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- jQuery 2.0.2 
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->
        <script src="/sid/js/jquery-2.0.2.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="/sid/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="/sid/js/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="/sid/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="/sid/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- Controllers' scripts -->
        <script src="/sid/controller/c_login.js" type="text/javascript"></script>
        <script src="/sid/controller/read/list_dosen/c_r_detail_dosen.js" type="text/javascript"></script>
        <script type="text/javascript">
            loginValidation();
            read_detail_dosen("<?php echo $nidn ?>");
        </script>
    </body>
</html>