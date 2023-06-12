<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo base_url('home') ?>" class="brand-link">
    <img src="<?php echo base_url('assets/gambar/logo/logoicon.png') ?>" alt="AdminLTE Logo" class="brand-image">
    <img src="<?php echo base_url('assets/gambar/logo/logo.png') ?>" class="brand-image">
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php
        if (empty($this->session->userdata('email'))) :
        ?>
          <li class="nav-item">
            <a href="<?php echo base_url('auth') ?>" class="nav-link nav-success">
              <i class="text-green nav-icon fa fa-sign-in " aria-hidden="true"></i>
              <p>Log In</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('auth/registrasi') ?>" class="nav-link">
              <i class="text-green nav-icon fa fa-user-plus"></i>
              <p>Sign Up</p>
            </a>
          </li>
        <?php
        else :
        ?>
          <li class="nav-item">
            <a href="<?php echo base_url('auth/info_akun/') ?>" class="nav-link">
              <i class="text-green nav-icon fas fa-user"></i>
              <p><?php echo $this->session->userdata('nama'); ?></p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('order/pesanan/') ?>" class="nav-link">
              <i class="text-green nav-icon fa fa-truck"></i>
              <p>
                Pesanan Saya
              </p>
            </a>
          </li>
        <?php
        endif;
        ?>
      </ul>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon classwith font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?php echo base_url('home') ?>" class="nav-link">
            <i class="text-green nav-icon fa fa-home"></i>
            <p>
              Menu Utama
            </p>
          </a>
        </li>

        <!-- Kategori -->
        <li class="nav-header">Kategori</li>
        <li class="nav-item">
          <a href="<?php echo base_url('kategori/peralatan') ?>" class="nav-link">
            <i class="text-green nav-icon fas fa-wrench"></i>
            <p>Peralatan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('kategori/cat') ?>" class="nav-link">
            <i class="text-green nav-icon fas fa-paint-brush"></i>
            <p>Cat</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('kategori/lainnya') ?>" class="nav-link">
            <i class="text-green nav-icon fas fa-tags"></i>
            <p>Lainya</p>
          </a>
        </li>
        <?php
        if (!empty($this->session->userdata('email'))) :
        ?>
          <li class="nav-item user-panel ">
            <a href="<?php echo base_url('auth/logout') ?>" class="nav-link bg-danger">
              <i class="nav-icon fa fa-sign-out"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        <?php
        endif;
        ?>
      </ul>
    </nav>
    <!-- /.sidebar -->
  </div>
</aside>