<section class="overflow-hidden">
      <div class="container-fluid p-0">
        <div class="row">
          <div class="col">
            <div class="mb-5 p-4 bg-white shadow-sm">
              <div id="stepper1" class="bs-stepper">
                <div class="bs-stepper-header" role="tablist">
                  <div class="step" data-target="#test-l-1">
                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                      <span class="bs-stepper-circle">1</span>
                    </button>
                  </div>
                  <div class="bs-stepper-line"></div>
                  <div class="step" data-target="#test-l-2">
                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                      <span class="bs-stepper-circle">2</span>
                    </button>
                  </div>
                  <div class="bs-stepper-line"></div>
                  <div class="step" data-target="#test-l-3">
                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
                      <span class="bs-stepper-circle">3</span>
                    </button>
                  </div>
                </div>
                <div class="bs-stepper-content">
                  <form onSubmit="return false">
                    <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                      <div class="form-group">
                        <div class="container pt-5">
                          <div class="row">
                            <div class="col text-center">
                              <h3 class="text-primary fw-bold">Booking information</h3>
                              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, illum!</p>
                            </div>
                          </div>
                          <div class="row justify-content-center">
                            <div class="col-lg-7 p-5">
                              <form>
                                <div class="mb-3">
                                  <label class="form-label">First Name</label>
                                  <input type="text" class="form-control bg-light" placeholder="Please type here.." />
                                </div>
                                <div class="mb-3">
                                  <label class="form-label">Last Name</label>
                                  <input type="text" class="form-control bg-light" placeholder="Please type here.." />
                                </div>
                                <div class="mb-3">
                                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                                  <input type="email" class="form-control bg-light" placeholder="Please type here.." id="exampleInputEmail1" aria-describedby="emailHelp" />
                                </div>
                                <div class="mb-3">
                                  <label class="form-label">Phone Number</label>
                                  <input type="number" class="form-control bg-light" placeholder="Please type here.." />
                                </div>
                              </form>
                              <!-- <form class="row g-3">
                                <div class="col-12">
                                  <label for="inputAddress" class="form-label">Address</label>
                                  <input type="text" class="form-control bg-light" id="inputAddress" placeholder="1234 Main St" />
                                </div>
                                <div class="col-md-6">
                                  <label for="inputCity" class="form-label">City</label>
                                  <input type="text" class="form-control bg-light" id="inputCity" />
                                </div>
                                <div class="col-md-4">
                                  <label for="inputState" class="form-label">State</label>
                                  <select id="inputState" class="form-select bg-light">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                  </select>
                                </div>
                                <div class="col-md-2">
                                  <label for="inputZip" class="form-label">Zip</label>
                                  <input type="text" class="form-control bg-light" id="inputZip" />
                                </div>
                              </form> -->
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="text-center">
                        <button class="btn btn-primary px-5 py-2" onclick="stepper1.next()">Next</button>
                      </div>
                    </div>
                    <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                      <div class="container">
                        <div class="row">
                          <div class="col text-center pt-5">
                            <h3 class="text-primary fw-bold">Address</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, illum!</p>
                          </div>
                        </div>
                        <div class="row justify-content-center">
                          <div class="col-7">
                            <form class="row g-3">
                              <div class="mb-3 col-12">
                                <label for="inputAddress" class="form-label">Address</label>
                                <input type="text" class="form-control bg-light" id="inputAddress" placeholder="1234 Main St" />
                              </div>
                              <div class="mb-3 col-md-6">
                                <label for="inputCity" class="form-label">City</label>
                                <input type="text" class="form-control bg-light" id="inputCity" />
                              </div>
                              <div class="mb-3 col-md-4">
                                <label for="inputState" class="form-label">State</label>
                                <select id="inputState" class="form-select bg-light">
                                  <option selected>Choose...</option>
                                  <option>...</option>
                                </select>
                              </div>
                              <div class="mb-3 col-md-2">
                                <label for="inputZip" class="form-label">Zip</label>
                                <input type="text" class="form-control bg-light" id="inputZip" />
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div class="pt-3 text-center">
                        <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                        <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                      </div>
                    </div>
                    <div id="test-l-3" role="tabpanel" class="bs-stepper-pane text-center" aria-labelledby="stepper1trigger3">
                      <div class="container">
                        <div class="row">
                          <div class="col text-center pt-5">
                            <h3 class="text-primary fw-bold">Order Complited</h3>
                            <p>Please screenshoot or remember this number</p>
                          </div>
                        </div>
                        <div class="row pt-3">
                          <div class="col">
                            <img src="./assets/img/form.png" height="300" width="300" alt="" />
                            <h2>No Transaksi:</h2>
                            <h1 class="fw-bold">1631256752382</h1>
                          </div>
                        </div>
                      </div>

                      <button class="btn btn-primary mt-5" onclick="stepper1.previous()">Previous</button>
                      <button type="submit" class="btn btn-primary mt-5">Submit</button>
                    </div>
                    <!-- <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                      <div class="container">
                        <div class="row">
                          <div class="col text-center pt-5">
                            <h3 class="text-primary fw-bold">Payment</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, illum!</p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-5 border-end p-5">
                            <h5>Transfer Payment</h5>
                            <p>Sub Total: $480 USD</p>
                            <p>Total: $580 USD</p>
                            <div class="row">
                              <div class="col-3">
                                <img src="./assets/img/BCA.png" class="img-fluid" height="50" alt="" />
                              </div>
                              <div class="col">
                                <p>Bank Central Asia</p>
                                <p>22206 1234</p>
                                <p>Tesla Inc.</p>
                              </div>
                            </div>
                            <div class="row pt-3">
                              <div class="col-3">
                                <img src="./assets/img/mandiri.png" class="img-fluid" alt="" />
                              </div>
                              <div class="col">
                                <p>Mandiri</p>
                                <p>22206 1234</p>
                                <p>Tesla Inc.</p>
                              </div>
                            </div>
                          </div>
                          <div class="col p-5">
                            <form>
                              <div class="mb-3">
                                <label for="formFile" class="form-label">Upload Transfer Proof</label>
                                <input class="form-control" type="file" id="formFile" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Bank Origin</label>
                                <input type="text" class="form-control bg-light" placeholder="Please type here.." />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Sender Name</label>
                                <input type="text" class="form-control bg-light" placeholder="Please type here.." />
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div class="pt-3 text-center">
                        <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                        <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                      </div>
                    </div>
                    <div id="test-l-3" role="tabpanel" class="bs-stepper-pane text-center" aria-labelledby="stepper1trigger3">
                      <div class="container">
                        <div class="row">
                          <div class="col text-center pt-5">
                            <h3 class="text-primary fw-bold">Order Complited</h3>
                            <p>Please screenshoot or remember this number</p>
                          </div>
                        </div>
                        <div class="row pt-3">
                          <div class="col">
                            <img src="./assets/img/form.png" height="300" width="300" alt="" />
                            <h2>No Transaksi:</h2>
                            <h1 class="fw-bold">1631256752382</h1>
                          </div>
                        </div>
                      </div>

                      <button class="btn btn-primary mt-5" onclick="stepper1.previous()">Previous</button>
                      <button type="submit" class="btn btn-primary mt-5">Submit</button>
                    </div> -->
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>