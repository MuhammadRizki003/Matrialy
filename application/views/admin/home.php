<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row text-center">
        <div class="col-4">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo $total_user; ?></h3>
              <p>User</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-4">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo $total_pesanan; ?></h3>
              <p>Pesanan</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-4">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo $total_produk; ?></h3>
              <p>Produk</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
  </section>
  <div class="pl-3 pr-3"><?php echo $this->session->flashdata('message'); ?></div>
  <section class="content">
    <div class="container-fluid table-responsive">
      <table class="table ">
        <thead>
          <tr>
            <th class="table-dark" scope="col">No</th>
            <th class="table-dark" scope="col">Nama User</th>
            <th class="table-dark" scope="col">Email</th>
            <th class="table-dark" scope="col">Aksi</th>
          </tr>
          <?php
          $no = 1;
          foreach ($user as $usr) : ?>
            <tr>
              <td><?php echo $no++ ?></td>
              <td><?php echo $usr->nama ?></td>
              <td><?php echo $usr->email ?></td>
              <td>
                <form action="<?php echo base_url('auth/reset_password/') ?>" method=post>
                  <input type="hidden" name="id" value="<?php echo $usr->id_user ?>">
                  <div class="row">
                    <input type="hidden" id="<?php echo $usr->id_user ?>" class="form-control text-center col-6" name="password">
                    <button type="button" class="btn btn-danger col-6" id="but<?php echo $usr->id_user ?>" onclick="gantiPassUser(<?php echo $usr->id_user ?>)">Reset Password</button>
                    <button type="submit" class="btn btn-danger col-6" style="visibility: hidden ;" id="sub<?php echo $usr->id_user ?>" onclick="return confirm('Reset Pasword User?')">Reset Password</button>
                  </div>
                </form>
            </tr>
          <?php endforeach; ?>
        </thead>
      </table>
    </div>
  </section>
</div>
