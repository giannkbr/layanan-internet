 <!-- Carousel -->
 <?php $this->view('messages') ?>
 <section id="carousel">
      <div id="carouselExampleIndicators" class="carousel slide overflow-hidden" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="py-1 bg-secondary active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class="py-1 bg-secondary" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner border border-1">
          <?php
          $i=1;
          foreach ($carousel as $r => $data) { ?>
            <div class="carousel-item <?php echo ($i==1) ? "active" : "" ?>">
            <img src="<?= base_url('assets/images/') ?><?= $data->images ?>" class="img-fluid w-100" alt="..." />
          </div>
          <?php $i++;} ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon text-secondary p-4 rounded-circle" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon text-secondary p-4 rounded-circle" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>
    <!-- Carousel Akhir -->

    <!-- Why Us -->
    <section class="py-5" id="benefit">
      <div class="container py-5">
        <div class="row">
          <div class="col text-center">
            <h3>Kenapa memilih kita?</h3>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi recusandae odio voluptate tempora saepe neque quod excepturi corrupti, totam voluptatem consectetur tenetur fugiat aspernatur commodi dicta distinctio ea
              architecto facere.
            </p>
          </div>
        </div>
        <div class="row justify-content-center pt-4 grid">
          <div class="col-lg-4 py-2">
            <div class="bg-light hover">
              <div class="card-body p-5 text-center">
                <i class="h1 bi bi-wallet2"></i>
                <h5 class="card-title my-4">Garansi hasil</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 py-2">
            <div class="bg-light hover">
              <div class="card-body p-5 text-center">
                <i class="h1 bi bi-people-fill"></i>
                <h5 class="card-title my-4">Tim berpengalaman</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 py-2">
            <div class="bg-light hover">
              <div class="card-body p-5 text-center">
                <i class="h1 bi bi-hand-thumbs-up"></i>
                <h5 class="card-title my-4">Profesional</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Why Us Akhir -->

    <!-- Paket -->
    <section class="py-5 bg-primary">
      <div class="container">
        <div class="row justify-content-center pb-5">
          <div class="col-lg-7 text-center text-white">
            <h2 class="fw-bold">SOSIAL.NET</h2>
            <p>Pilih paket Internet WiFi tercepat untuk kamu.</p>
          </div>
        </div>
        <div class="row">
         <?php foreach($item as $r => $data) { ?>
          <div class="col-4">
            <div class="bg-light rounded-3 text-center">
              <div class="card-body">
                <div class="text-end">
                  <h5 class="card-title bg-danger text-white btn rounded-pill" style="cursor: text"><?= $data->category ?></h5>
                </div>
                <h6 class="card-subtitle py-3 text-primary fw-bold"><?= $data->name ?></h6>
                <h3>Rp <?= number_format($data->price, 0, ',', '.' ); ?><span class="small" style="font-size: 12px">/ bulan</span></h3>
                <p class="card-text text-muted py-3"><?= $data->description_item ?></p>
                <div>
                  <p class="m-0 text-center"><?= $data->description ?></p>
                </div>
                <div class="text-center pt-3 pb-5">
                  <a href="<?= base_url('transaction')?>" class="btn btn-outline-primary">BELANJA SEKARANG</a>
                </div>
              </div>
            </div>
          </div>
         <?php } ?>
        </div>
      </div>
    </section>
    <!-- Paket Akhir -->