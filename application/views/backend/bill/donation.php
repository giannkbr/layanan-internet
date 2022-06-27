<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">

</div>
<?php $this->view('messages') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold"> Data Donasi </h6>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <div class="col-md-0 mt-2">
                <label class="col-sm-12 col-form-label">Bulan</label>
            </div>
            <div class="col-sm-3 mt-2 ">
                <select id="month" name="month" class="form-control" required>
                    <option value="<?= date('m') ?>"><?= indo_month(date('m')) ?></option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            <div class="col-md-0 mt-2">
                <label class="col-sm-12 col-form-label">Tahun</label>
            </div>
            <div class="col-sm-3  mt-2">
                <select class="form-control " style="width: 100%;" type="text" id="year" name="year" autocomplete="off" required>
                    <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
                    <?php
                    for ($i = date('Y'); $i >= date('Y') - 2; $i -= 1) {
                    ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm-3 mt-2">
                <button class="btn btn-primary mb-2 my-2 my-sm-0" type="submit" onclick="cek_bill()">Cek Donasi</button>
            </div>
        </div>
        <div class="loading"></div>
        <div class="view_data"></div>
    </div>
</div>

<script>
    function cek_bill() {
        month = $('[name="month"]');
        year = $('[name="year"]');
        $.ajax({
            type: 'POST',
            data: "cek_bill=" + 1 + "&month=" + month.val() + "&year=" + year.val(),
            url: '<?= site_url('bill/view_donation') ?>',
            cache: false,

            beforeSend: function() {
                month.attr('disabled', true);
                year.attr('disabled', true);
                $('.loading').html(` <div class="container">
        <div class="text-center">
            <div class="spinner-border text-primary" style="width: 5rem; height: 5rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>`);
            },
            success: function(data) {
                month.attr('disabled', false);
                year.attr('disabled', false);
                $('.loading').html('');
                $('.view_data').html(data);
            }
        });
        return false;
    }
</script>