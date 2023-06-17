<section class="content">
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <!-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active"> -->
        <img class="col-12" src="<?php echo base_url('/assets/gambar/gif.gif') ?>" alt="First slide">
        <!-- </div>
        </div>
      </div> -->
      </div>
    </div>

    <?php echo $this->session->flashdata('message'); ?>
    <div class="container-fluid">
      <form class="form-inline pl-2 mb-2 pr-2" action="<?php echo base_url() . 'home/cari_barang' ?>" method='post'>
        <div class="input-group input-group-l">
          <input class="form-control form-control bg-dark" type="search" placeholder="Cari Barang" name="cari" autocomplete="off">
          <div class="input-group-append">
            <button class="btn btn-dark" type="submit">
              <i class="fas fa-search"></i>
            </button>
            <?php
            if ($this->uri->segment('2') == 'cari_barang') {
            ?>
              <a href="<?php echo base_url('home') ?>"><button class="btn text-muted" type="button">
                  Reset
                </button>
              </a>
            <?php
            }
            ?>
          </div>
        </div>
      </form>
      <div class="row">
        <?php
        if ($produk != false) :
          foreach ($produk as $prd) : ?>
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
              <div class="card" id="<?php echo $prd->id_produk; ?>">
                <img class="card-img-top" src="<?php echo base_url('/assets/gambar/upload/') . $prd->gambar ?>" alt="...">
                <div class="card-body">
                  <div class="row">
                    <h5 class="overflow-ellipsis card-title  col-12"><?php echo $prd->nama_produk ?></h5>
                  </div>
                  Rp.<?php echo number_format($prd->harga, 0, ',', '.') ?>
                  <br>
                  <span class="badge badge-warning mb-2"> Stok | <?php echo $prd->stok ?></span>
                  <br>
                  <form action="<?php echo base_url() . 'cart/tambah_ke_keranjang/' . $prd->id_produk ?>" method='post'>
                    <input type="hidden" name="id_produk" value="<?php echo $prd->id_produk ?>">
                    <div class="input-group">
                      <?php
                      if (empty($this->session->userdata('email'))) :
                      ?>
                        <button class="btn btn-primary text-white col-12 mt-2 " data-toggle="modal" data-target="#exampleModalCenter" type="button">Belanja Sekarang</button>

                      <?php
                      else :
                      ?>
                       <div class="row">
                          <button class="btn btn-outline-secondary text-light col-3" type="button" onclick="javascript: min('input<?php echo $prd->id_produk; ?>');" style="border: none;">-</button>
                          <input type=" number" min="1" name="qty" value=1 id="input<?php echo $prd->id_produk; ?>" class="form-control col-6 text-center" style="border: none;">
                          <button class="btn  btn-outline-secondary text-light col-3 " type="button" onclick="javascript: plus('input<?php echo $prd->id_produk; ?>',<?php echo $prd->stok; ?>);" style="border: none;">+</button>
                          <button class=" btn btn-primary text-white col-12 mt-2 " type=" submit"><i class="fas fa-shopping-cart"></i>+Keranjang</button>
                        </div>
                      <?php
                      endif;
                      ?>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <?php
          endforeach;
        else : ?>
          <div class="mx-auto pt-5">
            <img style="width: 16rem;" src="<?php echo base_url('/assets/gambar/cari.png') ?>">

          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row mb-4 mt-4">
          <img src="<?php echo base_url('assets/gambar/logo/logoload.png') ?>" class="col-5 mx-auto">
        </div>
        <h5 class="text-center mb-3">Selamat datang di Matrialy <br> Log In dengan akun Matrialy untuk melanjutkan</h5>
        <div class="row">
          <div class="col-6">
            <a href="<?php echo base_url('auth') ?>" class="btn btn-sm btn-block btn-success">Log in</a>
          </div>
          <div class="col-6">
            <a href="<?php echo base_url('auth/registrasi') ?>" class="btn btn-sm btn-block btn-success ">Sign Up</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="iklan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop='static' data-keyboard='true'>
  <div class="modal-dialog modal-dialog-centered" role="document" id="iklan">
    <div class="modal-content" id="iklan">
      <div class="row">
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-5 col-6 mx-auto">
          <img class="card-img-top" id="gambarIklan" src="<?php echo base_url('/assets/gambar/promo.gif') ?> " onclick="ketOngkir();" alt="...">
          <button class="btn btn-sm  btn-block btn-primary mt-1 mx-auto" data-dismiss="modal" id="buttonIklan">
            <strong>Tutup Iklan</strong>
          </button>
        </div>

      </div>

    </div>
  </div>
</div>
</div>
</div>
