<?php
session_start();
if (!isset($_SESSION['nidn'])) {
    header("Location: ../index.php");
}
if ($_SESSION['level'] != "dosen") {
    header("Location: ../index.php");
}
$nidn = $_SESSION['nidn'];
$page = "RIWAYAT PENDIDIKAN";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $page ?> - <?php echo $nidn; ?> :: Sistem Informasi Dosen </title>
        <link rel="shortcut icon" href="/sid/gambar/unj_small.png" />
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="/sid/css/bootstrap.min_1.css" rel="stylesheet" type="text/css" />
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
        <link rel="stylesheet" type="text/css" href="/sid/css/bootstrap-tagsinput_2.css">
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
        <!-- header logo: style can be found in header.less -->
        <?php
        require_once '../header.php';
        ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php
            require_once '../navigasi.php';
            ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo ucwords(strtolower($page)) ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-upload"></i> Data</a></li>
                        <li class="active"> <?php echo ucwords(strtolower($page)) ?></li>
                    </ol>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Perguruan Tinggi</label>
                                        <!--select class="form-control kode_perguruan_tinggi" name="kode_perguruan_tinggi"</select-->
                                        <input type="text" class="form-control kode_perguruan_tinggi" name="kode_perguruan_tinggi" placeholder="Nama Perguruan Tinggi"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Gelar Akademik</label>
                                        <!--select type="text" class="form-control kode_gelar_akademik" name="kode_gelar_akademik" data-provide="typeahead"></select-->
                                        <input type="text" class="form-control kode_gelar_akademik" name="kode_gelar_akademik" placeholder="Nama Gelar Akademik Yang Diperoleh" disabled="disabled"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenjang Pendidikan</label>
                                        <input type="text" class="form-control kode_jenjang_pendidikan" name="kode_jenjang_pendidikan" required="required" placeholder="Jenjang Pendidikan Yang Ditempuh" disabled="disabled"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Ijazah</label>
                                        <input type="text" id="tanggal_ijazah" name="tanggal_ijazah" class="form-control tanggal_ijazah" required="required" placeholder="Tanggal Keluar Ijazah" disabled="disabled"/>
                                    </div><!-- /.form group -->
                                    <div class="form-group">
                                        <button class="btn btn-warning" id="bcreate">Tambahkan</button>
                                    </div>
                                </div><!-- /.box -->
                            </div>
                        </div>
                </section><!-- /.content -->

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <table id="list" class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Perguruan Tinggi</th>
                                                <th>Gelar Akademik</th>
                                                <th>Tanggal Ijazah</th>
                                                <th>Jenjang Pendidikan</th>
                                                <th>Edit</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- jQuery 2.0.2 -->
        <script src="/sid/js/jquery-2.0.2.min.js" type="text/javascript"></script>
        <script src="/sid/js/jquery-ui.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="/sid/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="/sid/js/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="/sid/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="/sid/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- Typeahead -->        
        <script type="text/javascript" src="/sid/js/bootstrap-tagsinput.min.js"></script>
        <script src="/sid/js/plugins/typeahead-0.10.4/typeahead-0.10.4.min.js" type="text/javascript"></script>
        <script src="/sid/js/plugins/rainbow-1.2.0/rainbow.min.js" type="text/javascript"></script>
        <script src="/sid/js/plugins/rainbow-1.2.0/language/generic.js" type="text/javascript"></script>
        <script src="/sid/js/plugins/rainbow-1.2.0/language/html.js" type="text/javascript"></script>
        <script src="/sid/js/plugins/rainbow-1.2.0/language/javascript.js" type="text/javascript"></script>
        <!-- Controllers' script -->
        <script src="/sid/controller/read/c_r_navigasi.js" type="text/javascript"></script>
        <script src="/sid/controller/read/riwayat_pendidikan/c_r_riwayat_pendidikan.js" type="text/javascript"></script>
        <script src="/sid/controller/create/riwayat_pendidikan/c_c_riwayat_pendidikan.js" type="text/javascript"></script>
        <script src="/sid/controller/delete/riwayat_pendidikan/c_d_riwayat_pendidikan.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                read_data_navigasi();
                read_riwayat_pendidikan();
                $("#tanggal_ijazah").datepicker({
                    //dateFormat: "yy-mm-dd",
                    dateFormat: "dd-mm-yy",
                    changeYear: true,
                    changeMonth: true,
                    yearRange: "-54:-0",
                    defaultDate: "2014-01-01"
                });
                create_riwayat_pendidikan();
                delete_riwayat_pendidikan();
            });
        </script>
    </body>
</html>