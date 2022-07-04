<section class="overflow-hidden">
  <div class="container-fluid p-0">
    <div class="row pt-3">
      <div class="row">
        <div class="col">
          <div class="mb-5 p-4">
            <?php $this->view('messages') ?>
            <div>
              <div class="form-group">
                <div class="container pt-5">
                  <div class="row">
                    <div class="col-5 border-end p-5">
                      <h5>Total Pembayaran</h5>
                      <p>Biaya Pemasangan : Rp 250.000</p>
                      <p>Biaya Layanan : </p>
                      <p>Total: $580 USD</p>
                      <br>
                      <div class="row">
                        <h5>Transfer ke : </h5>
                        <div class="col">
                          <p> <?= $bank['name'] ?></p>
                          <p> <?= $bank['no_rek'] ?></p>
                          <p> <?= $bank['owner'] ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col p-5">
                      <form action="<?= base_url("transaction/uploadbuktibayar") ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                          <label for="formFile" class="form-label">Upload Transfer Proof</label>
                          <input class="form-control" name="bukti_pembayaran" type="file" id="bukti_pembayaran" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Nama Bank</label>
                          <input type="text" name="nama_bank" class="form-control bg-light"
                            placeholder="Masukkan Nama Bank" />
                          <?= form_error('nama_bank', '<small class="text-danger pl-3 ">', '</small>') ?>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Nama Pemilik</label>
                          <input type="text" name="nama_pengirim" class="form-control bg-light"
                            placeholder="Masukkan Nama Pemilik" />
                          <?= form_error('nama_pengirim', '<small class="text-danger pl-3 ">', '</small>') ?>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">No Services </label>
                          <input type="text" name="no_services" class="form-control bg-light"
                            placeholder="Masukkan Nomer Services" />
                          <?= form_error('nama_pengirim', '<small class="text-danger pl-3 ">', '</small>') ?>
                        </div>
                        <div class="d-grid">
                          <button class="btn btn-primary btn-block mt-5 px-5">Submit</button>
                        </div>
                      </form>
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