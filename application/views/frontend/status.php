<section class="py-5">
      <div class="container">
        <div class="row">
          <div class="col">
            <form action="<?= base_url("front/view_bill")?>" method="POST" class="d-flex">
              <input class="form-control me-2" type="search" name="no_services" placeholder="No Transaksi" aria-label="Search" />
              <button class="btn btn-outline-primary" name="cek_status" type="submit">Search</button>
            </form>
          </div>
        </div>
        <div class="row justify-content-center pt-5">
          <div class="col-lg-7">
            <div class="card">
              <?php if (!isset($_POST['cek_status'])) { ?>
                <div class="card-body">
                <h5 class="card-title small text-muted pb-3">No Transaksi: <span class="fw-bold h5 text-dark">012345</span></h5>
                <div class="row">
                  <div class="col">
                    <p>Status:</p>
                    <p>Pembayaran:</p>
                  </div>
                  <div class="col">
                    <p>Belum Bayar</p>
                    <a href="./transaktion.html" class="btn btn-primary px-5">Bayar</a>
                  </div>
                </div>
              </div>
              <?php } else { ?>

              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </section>