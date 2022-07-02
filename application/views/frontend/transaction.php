<section class="overflow-hidden">
  <div class="container-fluid p-0">
    <div class="row">
      <div class="col">
        <div class="mb-5 p-4 bg-white shadow-sm">
        <div class="form-group">
                    <div class="container pt-5">
                      <div class="row">
                        <div class="col text-center">
                          <h3 class="text-primary fw-bold">Booking information</h3>
                          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, illum!</p>
                        </div>
                      </div>
                      <div class="row justify-content-center">
                        <div class="col-lg-12 p-5">
                          <form action="<?= base_url("transaction") ?>" method="POST">
                            <div class="mb-3">
                              <label class="form-label">Nama Lengkap</label>
                              <input type="text" name="name" value="<?= set_value('name') ?>"
                                class="form-control bg-light" placeholder="Please type here.." />
                              <input type="hidden" name="no_services" value="<?= Date('ymdHis') ?>">
                              <?= form_error('name', '<small class="text-danger pl-3 ">', '</small>') ?>
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Email address</label>
                              <input type="email" name="email" value="<?= set_value('email') ?>" class="form-control bg-light"
                                placeholder="Please type here.." id="exampleInputEmail1" aria-describedby="emailHelp" />
                              <?= form_error('email', '<small class="text-danger pl-3 ">', '</small>') ?>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Nomer Telepon atau Whatsapp</label>
                              <input type="number" name="no_wa" value="<?= set_value('no_wa') ?>"
                                class="form-control bg-light" placeholder="Please type here.." />
                              <?= form_error('no_wa', '<small class="text-danger pl-3 ">', '</small>') ?>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Nomer KTP</label>
                              <input type="number" name="no_ktp" value="<?= set_value('no_ktp') ?>"
                                class="form-control bg-light" placeholder="Please type here.." />
                              <?= form_error('no_ktp', '<small class="text-danger pl-3 ">', '</small>') ?>
                            </div>
                            <div class="mb-3 col-12">
                              <label for="inputAddress" class="form-label">Alamat</label>
                              <input type="text" value="<?= set_value('address') ?>" name="address"
                                class="form-control bg-light" id="inputAddress" placeholder="Masukkan alamatmu" />
                              <?= form_error('address', '<small class="text-danger pl-3 ">', '</small>') ?>
                            </div>
                            <button class="btn btn-primary btn-blocks">Submit</button>
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