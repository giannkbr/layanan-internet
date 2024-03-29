<div class="col-lg-12">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold">Edit Pelanggan</h6>
    </div>
    <div class="card-body">
      <?php echo form_open_multipart('') ?>
      <div class="form-group">
        <label for="name">Nama Pelanggan</label>
        <input type="hidden" name="customer_id" value="<?= $candidate->customer_id ?>" readonly>
        <input type="text" id="name" name="name" class="form-control" value="<?= $candidate->name ?>">
        <?= form_error('name', '<small class="text-danger pl-3 ">', '</small>') ?>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" class="form-control" value="<?= $candidate->email ?>">
        <?= form_error('email', '<small class="text-danger pl-3 ">', '</small>') ?>
      </div>
      <div class="form-group">
        <label for="no_ktp">No KTP</label>
        <input type="number" id="no_ktp" name="no_ktp" class="form-control" value="<?= $candidate->no_ktp ?>">
        <?= form_error('no_ktp', '<small class="text-danger pl-3 ">', '</small>') ?>
      </div>
      <div class="form-group">
        <label for="no_wa">No Telp.</label>
        <input type="number" id="no_wa" name="no_wa" class="form-control" value="<?= $candidate->no_wa ?>">
        <?= form_error('no_wa', '<small class="text-danger pl-3 ">', '</small>') ?>
      </div>
      <div class="form-group">
        <label for="address">Alamat</label>
        <textarea id="address" name="address" class="form-control"> <?= $candidate->address ?></textarea>
      </div>
      <!-- <div class="form-group">
                <label for="address">Status</label>
                <textarea id="address" name="c_status" class="form-control"> <?= $candidate->c_status ?></textarea>
            </div> -->
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <label class="input-group-text" for="inputGroupSelect01">Status</label>
        </div>
        <select class="custom-select" name="c_status" id="inputGroupSelect01">
          <option selected>Choose...</option>
          <?php
						foreach ($c_status as $data)
						{
							echo "<option value='$data->c_status_id'";
							echo $candidate->c_status==$data->c_status_id?'selected':'';
                    		echo ">$data->status_name</option>";
						}
						?>
        </select>
      </div>

      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      <?php echo form_close() ?>
    </div>
  </div>
</div>