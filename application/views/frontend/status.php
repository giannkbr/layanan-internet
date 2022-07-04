<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col">
        <form action="<?= base_url("front/view_status")?>" method="POST" class="d-flex">
          <input class="form-control me-2" type="search" name="no_services" placeholder="No Transaksi"
            aria-label="Search" />
          <button class="btn btn-outline-primary" name="cek_status" type="submit">Search</button>
        </form>
      </div>
    </div>

</section>