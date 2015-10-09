<?php
session_start();
if (!isset($_SESSION['nidn'])) {
    header("Location: ../index.php");
}
if ($_SESSION['level'] != "dosen") {
    header("Location: ../index.php");
}
$nidn = $_SESSION['nidn'];
$page = "DATA DOSEN";
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
                        <li><a href="#"><i class="fa fa-th"></i> Data</a></li>
                        <li class="active"> <?php echo ucwords(strtolower($page)) ?></li>
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
                                    <li id="c3"><a href="#tab_3-3" data-toggle="tab">Status</a></li>
                                    <li id="c2"><a href="#tab_2-2" data-toggle="tab">Jabatan Akademik</a></li>
                                    <li id="c1" class="active"><a href="#tab_1-1" data-toggle="tab">Data Diri</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab_1-1">
                                        <div class="form-group">
                                            <label>NIDN</label>
                                            <input type="text" class="form-control disabled_input_text nidn" name="nidn" disabled="disabled"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control editable_input_text nama_dosen" name="nama_dosen">
                                                <span class="btn btn-warning btn-google-plus input-group-addon submit">Simpan</span>
                                                <span class="btn btn-danger btn-google-plus input-group-addon csubmit">Batal</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Gelar Akademik Depan</label>
                                            <input type="text" class="form-control gelar_akademik_depan" name="gelar_akademik_depan"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Gelar Akademik Belakang</label>
                                            <input type="text" class="form-control gelar_akademik_belakang" name="gelar_akademik_belakang"/>
                                        </div>
                                        <div class="form-group">
                                            <label>NIP LAMA</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control editable_input_text nip_lama" name="nip_lama"/>
                                                <span class="btn btn-warning btn-google-plus input-group-addon submit">Simpan</span>
                                                <span class="btn btn-danger btn-google-plus input-group-addon csubmit">Batal</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>NIP BARU</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control editable_input_text nip_baru" name="nip_baru"/>
                                                <span class="btn btn-warning btn-google-plus input-group-addon submit">Simpan</span>
                                                <span class="btn btn-danger btn-google-plus input-group-addon csubmit">Batal</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>No KTP</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control editable_input_text no_ktp" name="no_ktp">
                                                <span class="btn btn-warning btn-google-plus input-group-addon submit">Simpan</span>
                                                <span class="btn btn-danger btn-google-plus input-group-addon csubmit">Batal</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-control editable_select jenis_kelamin" name="jenis_kelamin">
                                                <option id="L" value="L">Laki-laki</option>
                                                <option id="P" value="P">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <select class="form-control editable_select tempat_lahir" name="tempat_lahir"></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control editable_input_text tanggal_lahir" readonly="readonly"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control editable_input_text alamat" name="alamat">
                                                <span class="btn btn-warning btn-google-plus input-group-addon submit">Simpan</span>
                                                <span class="btn btn-danger btn-google-plus input-group-addon csubmit">Batal</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kota</label>
                                            <input type="text" class="form-control kode_kota" name="kode_kota"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Provinsi</label>
                                            <input type="text" class="form-control kode_provinsi" name="kode_provinsi"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Pos</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control editable_input_text kode_pos" name="kode_pos">
                                                <span class="btn btn-warning btn-google-plus input-group-addon submit">Simpan</span>
                                                <span class="btn btn-danger btn-google-plus input-group-addon csubmit">Batal</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Negara</label>
                                            <select class="form-control editable_select kode_negara" name="kode_negara"></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Telepon</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control editable_input_text telepon" name="telepon"/>
                                                <span class="btn btn-warning btn-google-plus input-group-addon submit">Simpan</span>
                                                <span class="btn btn-danger btn-google-plus input-group-addon csubmit">Batal</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Hp</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control editable_input_text hp" name="hp"/>
                                                <span class="btn btn-warning btn-google-plus input-group-addon submit">Simpan</span>
                                                <span class="btn btn-danger btn-google-plus input-group-addon csubmit">Batal</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat Akun E-mail di UNJ</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control editable_input_text email" name="email">
                                                <span class="btn btn-warning btn-google-plus input-group-addon submit">Simpan</span>
                                                <span class="btn btn-danger btn-google-plus input-group-addon csubmit">Batal</span>
                                            </div>
                                        </div>
                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane fade" id="tab_2-2">
                                        <form>
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Perguruan Tinggi</label>
                                                <select class="form-control editable_select kode_perguruan_tinggi" name="kode_perguruan_tinggi"></select>
                                            </div>
                                            <div class="form-group">
                                                <label>Fakultas</label>
                                                <select class="form-control editable_select kode_fakultas" name="kode_fakultas"></select>
                                            </div>
                                            <div class="form-group">
                                                <label>Jurusan</label>
                                                <input class="form-control kode_jurusan" name="kode_jurusan"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Program Studi</label>
                                                <input type="text" class="form-control kode_program_studi" name="kode_program_studi"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Golongan</label>
                                                <select class="form-control editable_select golongan" name="golongan">
                                                    <option id="IIIb" value="III/b">III/b</option>
                                                    <option id="IIIc" value="III/c">III/c</option>
                                                    <option id="IIId" value="III/d">III/d</option>
                                                    <option id="IVa" value="IV/a">IV/a</option>
                                                    <option id="IVb" value="IV/b">IV/b</option>
                                                    <option id="IVc" value="IV/c">IV/c</option>
                                                    <option id="IVd" value="IV/d">IV/d</option>
                                                    <option id="IVe" value="IV/e">IV/e</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Jabatan Fungsional</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control editable_select jabatan_fungsional" name="jabatan_fungsional">
                                                    <span class="btn btn-warning btn-google-plus input-group-addon submit">Simpan</span>
                                                    <span class="btn btn-danger btn-google-plus input-group-addon csubmit">Batal</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Jabatan Struktural</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control editable_select jabatan_struktural" name="jabatan_struktural">
                                                    <span class="btn btn-warning btn-google-plus input-group-addon submit">Simpan</span>
                                                    <span class="btn btn-danger btn-google-plus input-group-addon csubmit">Batal</span>
                                                </div>
                                            </div>
                                        </form>
                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane fade" id="tab_3-3">
                                        <form>
                                            <div class="form-group">
                                                <label>Status Aktif</label>
                                                <select class="form-control editable_select status_aktif" name="status_aktif"></select>
                                            </div>
                                            <!-- Date dd/mm/yyyy -->
                                            <div class="form-group">
                                                <label>Mulai Masuk</label>
                                                <input type="text" id="mulai_masuk_dosen" name="mulai_masuk_dosen" class="form-control editable_input_text mulai_masuk_dosen" readonly="readonly"/>
                                            </div>   
                                            <div class="form-group">
                                                <label>No Sertifikasi Dosen</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control editable_input_text no_sertifikasi_dosen" name="no_sertifikasi_dosen">
                                                    <span class="btn btn-warning btn-google-plus input-group-addon submit">Simpan</span>
                                                    <span class="btn btn-danger btn-google-plus input-group-addon csubmit">Batal</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Keluar Sertifikasi Dosen</label>
                                                <input type="text" id="tanggal_keluar_sertifikasi_dosen" name="tanggal_keluar_sertifikasi_dosen" class="form-control editable_input_text tanggal_keluar_sertifikasi_dosen" readonly="readonly"/>
                                            </div>
                                    </div>
                                </div><!-- /.tab-content -->
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
        <script src="/sid/js/jquery-ui.js" type="text/javascript"></script>
        <script src="/sid/js/style.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="/sid/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="/sid/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- Typeahead -->        
        <script type="text/javascript" src="/sid/js/bootstrap-tagsinput.min.js"></script>
        <script src="/sid/js/plugins/typeahead-0.10.4/typeahead-0.10.4.min.js" type="text/javascript"></script>
        <script src="/sid/js/plugins/rainbow-1.2.0/rainbow.min.js" type="text/javascript"></script>
        <script src="/sid/js/plugins/rainbow-1.2.0/language/generic.js" type="text/javascript"></script>
        <script src="/sid/js/plugins/rainbow-1.2.0/language/html.js" type="text/javascript"></script>
        <script src="/sid/js/plugins/rainbow-1.2.0/language/javascript.js" type="text/javascript"></script>
        <!-- Controllers' scripts -->
        <script src="/sid/controller/read/c_r_navigasi.js" type="text/javascript"></script>
        <script src="/sid/controller/read/data_dosen/c_r_data_dosen.js" type="text/javascript"></script>
        <script src="/sid/controller/update/data_dosen/c_u_data_dosen.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                read_data_navigasi();
                read_data_dosen();
            });
        </script>

    </body>
</html>