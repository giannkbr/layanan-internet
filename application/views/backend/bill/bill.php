<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="" id="#addModal" data-toggle="modal" data-target="#addModal" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
</div>
<?php $this->view('messages') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold"> Data Tagihan </h6>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-lg-3 col-sm-6 mb-2 col-md-4">
                <a href="#" class="btn btn-primary"><input type='checkbox' id="selectAll"> Pilih Semua</a>
            </div>
            <div class="col-lg-3 col-sm-6 mb-2 col-md-4 text-left">
                <button href="" class="btn btn-secondary" id="btn-cetak"><i class="fa fa-print"></i> Cetak Yang Dipilih</button>
            </div>
            <div class="col-lg-3 col-sm-6 mb-2 col-md-4 text-left">
                <a href="<?= site_url('bill/printinvoiceunpaid') ?>" target="blank" class="btn btn-danger"><i class="fa fa-print"></i> Cetak Semua Belum Bayar</a>
            </div>
            <div class="col-lg-3 col-sm-6 mb-2 col-md-4 text-left">
                <a href="<?= site_url('bill/printinvoicepaid') ?>" target="blank" class="btn btn-success"><i class="fa fa-print"></i> Cetak Semua Sudah Bayar</a>
            </div>
        </div>
        <div class="table-responsive">
            <form method="post" action="<?php echo base_url('bill/printinvoiceselected') ?>" target="blank" id="submit-cetak">
                <input type="hidden" name='invoice[]' id="result" size="60">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="text-align: center">
                            <th style="text-align: center; width:20px">No</th>
                            <th>
                            </th>
                            <th>No Layanan</th>
                            <th>Nama Pelanggan</th>
                            <th>No. Telp.</th>
                            <th>Periode</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th style="text-align: center">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center">
                            <th style="text-align: center">No</th>
                            <th></th>
                            <th>No Layanan</th>
                            <th>Nama Pelanggan</th>
                            <th>No. Telp.</th>
                            <th>Periode</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th style="text-align: center">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1;
                        foreach ($bill as $r => $data) { ?>
                            <tr>
                                <td style="text-align: center"><?= $no++ ?>.</td>
                                <td>
                                    <?php if ($data->status == 'BELUM BAYAR') { ?>
                                        <input type='checkbox' class='check-item' name='invoice[]' value='<?= $data->invoice ?>'></td>
                            <?php } ?>
                            <td style="text-align: center"><?= $data->no_services ?> <br>
                                <?php if ($data->status == 'BELUM BAYAR') { ?>
                                    <a href="<?= site_url('bill/printinvoice/' . $data->invoice) ?>" target="blank" class="btn btn-danger" style="font-size: smaller">Cetak Invoice</a>
                                <?php } ?>
                                <?php if ($data->status == 'SUDAH BAYAR') { ?>
                                    <a href="<?= site_url('bill/printinvoice/' . $data->invoice) ?>" target="blank" class="btn btn-success" style="font-size: smaller">Cetak Invoice</a>
                                <?php } ?>
                            </td>
                            <td><?= $data->name ?></td>
                            <td><?= $data->no_wa ?></td>
                            <td>
                                <?= indo_month($data->month) ?>
                                <?= $data->year ?></td>
                            <td style="font-weight: bold;text-align: center"> <?php $query = "SELECT *
                                    FROM `invoice_detail`
                                        WHERE `invoice_detail`.`invoice_id` =  $data->invoice";
                                                                                $querying = $this->db->query($query)->result(); ?>
                                <?php $subtotal = 0;
                                foreach ($querying as  $dataa)
                                    $subtotal += (int) $dataa->total;
                                ?>
                                <?= indo_currency($subtotal + $data->code_unique) ?></td>
                            <?php if ($data->status == 'SUDAH BAYAR') { ?>
                                <td style="text-align: center; font-weight:bold; color:green; font-size:small"> <?= $data->status  ?></td>
                            <?php } ?>
                            <?php if ($data->status == 'BELUM BAYAR') { ?>
                                <td style="text-align: center; font-weight:bold; color:red; font-size:small"> <?= $data->status  ?></td>
                            <?php } ?>
                            <td style="text-align: center"><a href="<?= site_url('bill/detail/' . $data->invoice) ?>" title="Lihat"><i class="fa fa-eye" style="font-size:25px; color:gray"></i></a>
                                <?php $link = "https://$_SERVER[HTTP_HOST]"; ?>
                                <?php if ($data->status == 'BELUM BAYAR') { ?>
                                    <a href="https://api.whatsapp.com/send?phone=<?= indo_tlp($data->no_wa) ?>&text=Plg Yth, Tagihan Internet no <?= $data->no_services ?> a/n _<?= $data->name ?>_ bln <?= indo_month($data->month) ?> <?= $data->year ?> Sebesar  *<?= indo_currency($subtotal) ?>*, Mohon untuk melakukan pembayaran melalui ATM, Internet Banking atau langsung ke <?= $company['company_name'] ?>. Maks tgl <?= $company['due_date'] ?> <?= indo_month($data->month) ?> <?= $data->year ?>.%0A%0APembayan bisa cash atau via transfer ke :%0A<?= $bank['name'] ?> : <?= $bank['no_rek'] ?> A/N <?= $bank['owner'] ?>%0AAbaikan jika sudah melakukan pembayaran. Tks %0A%0A%0A<?= $company['company_name'] ?> %0A<?= $company['sub_name'] ?> %0A" target="blank" title="Kirim Notifikasi"><i class="fab fa-whatsapp" style="font-size:25px; color:green"></i></a>
                                <?php } ?>
                                <a href="" data-toggle="modal" data-target="#DeleteModal<?= $data->invoice_id ?>" title="Hapus"><i class="fa fa-trash" style="font-size:25px; color:red"></i></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<!-- Modal Add -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tagihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('bill/addBill') ?>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Bulan</label>
                            <input type="hidden" name="invoice" value="<?= $invoice ?>">
                            <select class="form-control select2" style="width: 100%;" name="month" required>
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
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Tahun</label>
                            <select class="form-control select2" style="width: 100%;" name="year" required>
                                <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
                                <?php
                                for ($i = date('Y'); $i >= date('Y') - 2; $i -= 1) {
                                ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">No Layanan - Nama Pelanggan</label>
                    <select class="form-control select2" name="no_services" id="no_services" onchange="cek_data()" style="width: 100%;" required>
                        <option value="">-Pilih-</option>
                        <?php
                        foreach ($customer as $r => $data) { ?>
                            <option value="<?= $data->no_services ?>"><?= $data->no_services ?> - <?= $data->name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nominal">Rincian Tagihan</label>
                    <div class="loading"></div>
                    <div class="view_data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<?php
foreach ($bill as $r => $data) { ?>
    <div class="modal fade" id="DeleteModal<?= $data->invoice_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Tagihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('bill/delete') ?>
                    <input type="hidden" name="invoice_id" value="<?= $data->invoice_id ?>" class="form-control">
                    <input type="hidden" name="invoice" value="<?= $data->invoice ?>" class="form-control">
                    Apakah yakin akan hapus Tagihan <?= $data->no_services ?> A/N <?= $data->name ?> ?
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

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    });

    function cek_data() {
        no_services = $('[name="no_services"]');
        $.ajax({
            type: 'POST',
            data: "cek_data=" + 1 + "&no_services=" + no_services.val(),
            url: '<?= site_url('bill/view_data') ?>',
            cache: false,

            beforeSend: function() {
                no_services.attr('disabled', true);
                $('.loading').html(` <div class="container">
        <div class="text-center">
            <div class="spinner-border text-primary" style="width: 5rem; height: 5rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>`);
            },
            success: function(data) {
                no_services.attr('disabled', false);
                $('.loading').html('');
                $('.view_data').html(data);
            }

        });
        return false;
    }
</script>
<script>
    $(document).ready(function() {
        $("#selectAll").click(function() {
            if ($(this).is(":checked"))
                $(".check-item").prop("checked", true);

            else // Jika checkbox all tidak diceklis
                $(".check-item").prop("checked", false);
        });

        $("#btn-cetak").click(function() {
            var confirm = window.confirm("Apakah Anda yakin ingin cetak tagihan yang terpilih ?");
            if (confirm)
                $("#submit-cetak").submit();
        });
    });
</script>