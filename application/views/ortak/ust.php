<header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url("program"); ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="<?php echo base_url("assets/img/logo.bmp") ?>" alt="logo" style="width:30px;"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img src="<?php echo base_url("assets/img/logo.bmp") ?>" alt="logo" style="width:30px; margin-right:10px;"></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <?php if($this->session->kullaniciAdi)
            { ?>
            <div class="navbar-custom-menu"   >
                <ul class="nav navbar-nav"  >
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu" >
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"  >
                    <span class="hidden-xs" style="font-size:11pt;" >Giriş Yaptınız.  <?php echo $this->session->kullaniciAdi; ?></span>
                    </a>
                    <ul class="dropdown-menu"  >
                    <!-- Menu Footer-->
                    <li class="user-footer" style="background-color:#838384; padding:10px;"   >
                        <a style="color:#ffffff; text-declore" href="<?php echo base_url("oturum/cikis"); ?>" class="btn btn-block btn-danger btn-flat" >Çıkış Yap</a>
                    </li>
                    </ul>
                </li>
                </ul>
            </div>
            <?php } ?>
        </nav>
    </header>