<?php
session_start();
if (!isset($_SESSION['nidn'])) {
    header("Location: ../index.php");
}
if ($_SESSION['level'] != "admin_sid") {
    header("Location: ../index.php");
}
$nidn = $_SESSION['nidn'];
$page = "DAFTAR PENGGUNA";
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
                        <li><a href="#"><i class="fa fa-home"></i> <?php echo ucwords(strtolower($page)) ?></a></li>
                    </ol>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>User ID</label>
                                        <!--select class="form-control kode_perguruan_tinggi" name="kode_perguruan_tinggi"</select-->
                                        <select type="text" class="form-control userid" name="userid"></select>
                                    </div>
                                    <div class="form-group">
                                        <label>Password (belum terenkripsi)</label>
                                        <input type="text" class="form-control password" name="password" placeholder="Password" disabled="disabled"/>
                                    </div>
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
                                                <th>User ID</th>
                                                <th>Password (terenkripsi)</th>
                                                <th>Level</th>
                                                <th>Status</th>
                                                <th>Edit</th>
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
        <!-- Bootstrap -->
        <script src="/sid/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="/sid/js/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="/sid/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="/sid/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- Controllers' script -->
        <script src="/sid/controller/create/daftar_pengguna/c_c_pengguna.js" type="text/javascript"></script>
        <script src="/sid/controller/read/daftar_pengguna/c_r_daftar_pengguna.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function () {
                validateForm();
                read_daftar_pengguna();
            });
        </script>
    </body>
</html>