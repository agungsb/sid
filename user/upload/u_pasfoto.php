<?php
session_start();
$page = "UPLOAD PAS FOTO";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistem Informasi Dosen</title>
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
        <link href="/sid/css/upload_pasfoto.css" rel="stylesheet" type="text/css"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-dark-green">
        <?php
        require_once '../header.php';
        ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <div class="loader"></div>
            <!-- Left side column. contains the logo and sidebar -->
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
                        <li><a href="#"><i class="fa fa-upload"></i> Upload</a></li>
                        <li class="active"> <?php echo ucwords(strtolower($page)) ?></li>
                    </ol>
                </section>     

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-6 col-md-3" style="float: none; margin: 0 auto;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-8">
                                        <input type="file" id="file" class="form-control flUpload" style="border: none; background: transparent">
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="imageBox col-md-12">
                                    <div class="thumbBox"></div>
                                    <div class="spinner" id="progressBar" style="display: none;"></div>
                                    <div class="movement_tools col-md-12">
                                        <div class="pull-left">
                                            <button id="btnMoveUp" value="+" class="upload_tools btn btn-primary"><i class="glyphicon glyphicon-chevron-up"></i></button>
                                            <button id="btnMoveBottom" value="+" class="upload_tools btn btn-primary"><i class="glyphicon glyphicon-chevron-down"></i></button>
                                            <button id="btnMoveLeft" value="+" class="upload_tools btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                            <button id="btnMoveRight" value="+" class="upload_tools btn btn-primary"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                            <button id="btnZoomOut" value="-" class="upload_tools btn btn-warning"><i class="glyphicon glyphicon-minus-sign"></i></button>
                                            <button id="btnZoomIn" value="+" class="upload_tools btn btn-warning"><i class="glyphicon glyphicon-plus-sign"></i></button>
                                            <button type="button" id="btnCancel" value="Cancel" class="upload_tools btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                                            <button type="button" id="btnCrop" value="Crop" class="upload_tools btn btn-success"><i class="glyphicon glyphicon-check"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script> -->
        <script src="/sid/js/jquery-2.0.2.min.js" type="text/javascript"></script>
        <script src="/sid/js/jquery-ui.js" type="text/javascript"></script>
        <script src="/sid/js/style.js" type="text/javascript"></script>
        <script src="/sid/js/cropbox.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="/sid/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="/sid/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- page script -->
        <script src="/sid/controller/read/c_r_navigasi.js" type="text/javascript"></script>
        <script src="/sid/controller/read/data_dosen/c_r_pasfoto.js" type="text/javascript"></script>
        <script src="/sid/controller/update/data_dosen/c_u_pasfoto.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function(){
                read_data_navigasi();
            });
        </script>
    </body>
</html>