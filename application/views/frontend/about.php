<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col text-center pb-3">
        <h3 class="fw-bold text-primary">Our Story</h3>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="row">
          <p>
            <?= $company['our_story'] ?>
          </p>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>

<section class="bg-primary">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="row py-5 justify-content-between">
          <div class="col-5">
            <img src="<?= base_url('assets/frontend/') ?>img/bg.png" class="img-fluid" alt="" />
          </div>
          <div class="col-lg-6 text-white">
            <h3 class="fw-bold pb-4">Our Misions</h3>
            <p>
                Misi Kami :
            </p>
            <div>
            <?= $company['our_mission'] ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>