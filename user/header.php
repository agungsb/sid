
<!-- header logo: style can be found in header.less -->
<header class="header" style="z-index:100">
    <a href="#" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        Sistem Informasi Dosen
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="user user-menu">
                    <?php
                    if (isset($_SESSION['nidn'])) {
                        ?>
                        <a href="/sid/model/logout.php">
                            <i class="glyphicon glyphicon-log-out"></i>
                            <span>Logout </span>
                        </a>
                        <?php
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>
</header>