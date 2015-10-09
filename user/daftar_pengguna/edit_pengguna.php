<?php
session_start();
if (!isset($_POST['userid'])) {
    header("Location: index.php");
}
if (!isset($_SESSION['nidn'])) {
    header("Location: ../index.php");
}
if ($_SESSION['level'] != "admin_sid") {
    header("Location: ../index.php");
}
$nidn = $_SESSION['nidn'];
$userid = $_POST['userid'];
$page = "EDIT PENGGUNA";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $page ?> - <?php echo $userid; ?> :: Sistem Informasi Dosen </title>
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
                        <li><a href="index.php"><i class="fa fa-home"></i> Data Pengguna</a></li>
                        <li class="active"> <?php echo ucwords(strtolower($page)) ?></li></ol>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>User ID</label>
                                        <!--select class="form-control kode_perguruan_tinggi" name="kode_perguruan_tinggi"</select-->
                                        <input type="text" class="form-control userid" value="<?php echo $userid; ?>" name="userid" disabled="disabled"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Status Aktif</label>
                                        <select class="form-control status" name="status" required="required">
                                            <option value="1">Aktif</option>
                                            <option value="0">Non Aktif</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-warning" id="bactive">Ubah Status</button>
                                    </div>
                                    <div class="form-group">
                                        <label>Password Baru (belum terenkripsi)</label>
                                        <input type="text" class="form-control password" name="password" placeholder="Password" required="required"/>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-warning" id="bgenerate">Generate Password</button>
                                    </div>
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
        <script src="/sid/controller/update/daftar_pengguna/c_u_daftar_pengguna.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function () {
                update_daftar_pengguna(<?php echo $userid; ?>);
            });
        </script>
    </body>
</html>