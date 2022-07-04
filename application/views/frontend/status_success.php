<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col">
        <form action="<?= base_url("front/view_bill")?>" method="POST" class="d-flex">
          <input class="form-control me-2" type="search" name="no_services" value="<?= $no_services; ?>" placeholder="No Transaksi"
            aria-label="Search" />
          <button class="btn btn-outline-primary" name="cek_status" type="submit">Search</button>
        </form>
      </div>
    </div>
    <div class="row justify-content-center pt-5">
      <div class="col-lg-7">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title small text-muted pb-3">No Transaksi: <span class="fw-bold h5 text-dark"><?= $no_services; ?></span>
            </h5>
            <?php foreach($customer as $data) { ?>
              <div class="row">
              <div class="col">
                <p>Status:</p>
                <?php if($data->c_status == 2) { ?>
                  <p>Pembayaran</p>
                <?php } ?>
              </div>
              <div class="col">
                <p><?= $data->status_name?></p>
                <?php if($data->c_status == 2) { ?>
                  <a href="<?= base_url("transaction/uploadbukti") ?>" class="btn btn-primary px-5">Bayar</a>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>