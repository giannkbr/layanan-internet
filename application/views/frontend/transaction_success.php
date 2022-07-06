<section class="overflow-hidden">
  <div class="container-fluid p-0">
    <div class="row">
      <div class="col">
        <div class="mb-5 p-4 bg-white shadow-sm">
          <div class="form-group">
            <div class="container">
            <?php $this->view('messages') ?>
              <div class="row justify-content-center">
                <div class="col-lg-12 p-5">
                  <div class="row">
                    <div class="col text-center pt-5">
                      <h3 class="text-primary fw-bold">Order Complited</h3>
                      <p>Please screenshoot or remember this number</p>
                    </div>
                  </div>
                  <div class="row pt-3">
                    <div class="col text-center">
                      <img src="<?= base_url('assets/frontend/')?>img/form.png" height="300" width="300" alt="" />
                      <h2>No Transaksi:</h2>
                      <h1 class="fw-bold"><?= $no_services ?></h1>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>