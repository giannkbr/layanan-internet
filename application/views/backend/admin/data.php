<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <a href="<?= site_url('admin/add') ?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
      class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
</div>
<?php $this->view('messages') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold">Data Pelanggan</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr style="text-align: center">
            <th style="text-align: center; width:20px">No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Alamat</th>
            <th style="text-align: center">Aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr style="text-align: center">
            <th style="text-align: center">No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
        <tbody>
          <?php $no = 1;
                    foreach ($admin as $r => $data) { ?>
          <tr>
            <td><?= $no++ ?>.</td>
            <td><?= $data->name ?></td>
            <td><?= $data->email ?></td>
            <td><?= $data->address ?></td>
            <td><a href="<?= site_url('admin/edit/') ?><?= $data->id ?>" title="Edit"><i class="fa fa-edit"
                  style="font-size:25px"></i></a>
                <a href="" data-toggle="modal"
                data-target="#DeleteModal<?= $data->id ?>" title="Hapus"><i class="fa fa-trash"
                  style="font-size:25px; color:red"></i></a>
                </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Hapus -->
<?php
foreach ($admin as $r => $data) { ?>
    <div class="modal fade" id="DeleteModal<?= $data->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('admin/delete') ?>
                    <input type="hidden" name="id" value="<?= $data->id ?>" class="form-control">
                    Apakah yakin akan hapud admin <?= $data->name ?> ?
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
