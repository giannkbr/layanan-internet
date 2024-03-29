<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <!-- <a href="<?= site_url('customer/add') ?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a> -->
</div>
<?php $this->view('messages') ?>
<!-- DataTales Example -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
      aria-selected="true">Verifikasi Data</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
      aria-selected="false">Menunggu Pembayaran</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
      aria-selected="false">Proses</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <!-- <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold">Data Calon Pelanggan Menunggu Verifikasi Data</h6>
  </div> -->
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr style="text-align: center">
            <th style="text-align: center; width:20px">No</th>
            <th>No Layanan</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Pilihan Paket</th>
            <th>No KTP</th>
            <th>No Telp.</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
                    foreach ($candidate as $r => $data) { ?>
          <tr>
            <td style="text-align: center"><?= $no++ ?>.</td>
            <td><?= $data->no_services ?> <br>

            </td>
            <td><?= $data->name ?></td>
            <td><?= $data->email ?></td>
            <td><?= $data->category ?></td>
            <td><?= $data->no_ktp ?></td>
            <td><?= $data->no_wa ?></td>
            <td><?= $data->address ?></td>
            <td><span class="badge badge-secondary"><?= $data->status_name ?></span>
            </td>
            <td>
              <?php $link = "https://$_SERVER[HTTP_HOST]"; ?>
              <?php if ($data->c_status === '1') { ?>
              <a href="https://api.whatsapp.com/send?phone=<?= indo_tlp($data->no_wa) ?>&text=Plg Yth, Tagihan Internet no <?= $data->no_services ?> a/n _<?= $data->name ?>, sedang dilakukan verifikasi data, tunggu informasi selanjutnya dari admin. Tks %0A%0A%0A<?= $company['company_name'] ?> %0A<?= $company['sub_name'] ?> %0A"
                target="blank" title="Kirim Notifikasi"><i class="fab fa-whatsapp"
                  style="font-size:25px; color:green"></i></a>
              <?php } ?>
              <a href="<?= site_url('candidate/edit/') ?><?= $data->customer_id ?>" title="Edit"><i class="fa fa-edit"
                  style="font-size:25px"></i></a>
              <a href="" data-toggle="modal" data-target="#DeleteModal<?= $data->customer_id ?>" title="Hapus"><i
                  class="fa fa-trash" style="font-size:25px; color:red"></i></a></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <!-- <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold">Data Calon Pelanggan Menunggu Pembayaran</h6>
  </div> -->
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr style="text-align: center">
            <th style="text-align: center; width:20px">No</th>
            <th>No Layanan</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Pilihan Paket</th>
            <th>No KTP</th>
            <th>No Telp.</th>
            <th>Alamat</th>
            <th>Bukti Pembayaran</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
                    foreach ($candidatependingpayment as $r => $data) { ?>
          <tr>
            <td style="text-align: center"><?= $no++ ?>.</td>
            <td><?= $data->no_services ?> <br>

            </td>
            <td><?= $data->name ?></td>
            <td><?= $data->email ?></td>
            <td><?= $data->category ?></td>
            <td><?= $data->no_ktp ?></td>
            <td><?= $data->no_wa ?></td>
            <td><?= $data->address ?></td>
            <td><img src="<?= base_url('assets/images/bukti/') ?><?= $data->bukti_pembayaran ?>" alt=""
                style="width:100px; height:100px"></td>
            <td><span class="badge badge-warning"><?= $data->status_name ?></span></td>
            <td>
              <?php $link = "https://$_SERVER[HTTP_HOST]"; ?>
              <?php if ($data->c_status === '2') { ?>
              <a href="https://api.whatsapp.com/send?phone=<?= indo_tlp($data->no_wa) ?>&text=Plg Yth, Tagihan Internet no <?= $data->no_services ?> a/n _<?= $data->name ?>, Berhasil diverifikasi. Silakan melakukan pembayaran untuk melakukan proses installasi. Detail Pembayaran : - <?= $data->category ?>, dengan harga <?= indo_currency($data->price) ?>  Link pembayaran : <?= base_url("transaction/uploadbukti/") ?> dengan nomer services <?= $data->no_services ?>
              Tks %0A%0A%0A<?= $company['company_name'] ?> %0A<?= $company['sub_name'] ?> %0A" target="blank"
                title="Kirim Notifikasi"><i class="fab fa-whatsapp" style="font-size:25px; color:green"></i></a>
              <?php } ?>
              <a href="<?= site_url('candidate/editPendingPayment/') ?><?= $data->customer_id ?>" title="Edit"><i
                  class="fa fa-edit" style="font-size:25px"></i></a> <a href="" data-toggle="modal"
                data-target="#DeleteModal<?= $data->customer_id ?>" title="Hapus"><i class="fa fa-trash"
                  style="font-size:25px; color:red"></i></a></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
  <!-- <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold">Data Calon Pelanggan Proses</h6>
  </div> -->
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr style="text-align: center">
            <th style="text-align: center; width:20px">No</th>
            <th>No Layanan</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Pilihan Paket</th>
            <th>No KTP</th>
            <th>No Telp.</th>
            <th>Alamat</th>
            <th>Status</th>
            <th style="text-align: center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
                    foreach ($candidateproses as $r => $data) { ?>
          <tr>
            <td style="text-align: center"><?= $no++ ?>.</td>
            <td><?= $data->no_services ?> <br>
              <a href="<?= site_url('services/detail/') ?><?= $data->no_services ?>" class="btn btn-success"
                style="font-size: smaller">Rincian Paket</a>
            </td>
            <td><?= $data->name ?></td>
            <td><?= $data->email ?></td>
            <td><?= $data->category ?></td>
            <td><?= $data->no_ktp ?></td>
            <td><?= $data->no_wa ?></td>
            <td><?= $data->address ?></td>
            <td><span class="badge badge-info"><?= $data->status_name ?></span></td>
            <td>
              <?php $link = "https://$_SERVER[HTTP_HOST]"; ?>
              <?php if ($data->c_status === '3') { ?>
              <a href="https://api.whatsapp.com/send?phone=<?= indo_tlp($data->no_wa) ?>&text=Plg Yth, Tagihan Internet no <?= $data->no_services ?> a/n _<?= $data->name ?>, pembayaran berhsil dilakukan. Tks %0A%0A%0A<?= $company['company_name'] ?> %0A<?= $company['sub_name'] ?> %0A"
                target="blank" title="Kirim Notifikasi"><i class="fab fa-whatsapp"
                  style="font-size:25px; color:green"></i></a>
              <?php } ?>
              <a href="<?= site_url('candidate/editProses/') ?><?= $data->customer_id ?>" title="Edit"><i
                  class="fa fa-edit" style="font-size:25px"></i></a> <a href="" data-toggle="modal"
                data-target="#DeleteModal<?= $data->customer_id ?>" title="Hapus"><i class="fa fa-trash"
                  style="font-size:25px; color:red"></i></a></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  </div>
</div>



<!-- Modal Hapus -->
<?php
foreach ($candidate as $r => $data) { ?>
<div class="modal fade" id="DeleteModal<?= $data->customer_id ?>" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Pelanggan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart('candidate/delete') ?>
        <input type="hidden" name="customer_id" value="<?= $data->customer_id ?>" class="form-control">
        <input type="hidden" name="no_services" value="<?= $data->no_services ?>" class="form-control">
        Apakah yakin akan hapus No Layanan <?= $data->no_services ?> A/N <?= $data->name ?> ?
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>
<?php } ?>