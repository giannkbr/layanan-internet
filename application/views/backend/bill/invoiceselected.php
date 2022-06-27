<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Cetak <?= date('d M Y') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/') ?>frontend/libraries/bootstrap/css/bootstrap.css">
</head>

<body onload="window.print()">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tahoma";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 21cm;
            min-height: 29.7cm;
            padding: 2cm;
            margin: 1cm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .invoice h3 {
            margin-top: -40px;
            font-weight: bold;
            font-size: 25px;
        }

        .invoice h6 {
            margin-top: -20px;
            font-size: 16px;
        }

        .invoice span {
            margin-top: -55px;
            font-size: 12px;
        }

        .invoice img {
            margin-top: -40px;
            max-height: 60px;
        }

        .invoice-title h3 {
            margin-top: -15px;
            font-size: 40px;
            font-weight: bold;
            color: darkblue;
        }

        .fromto h5 {
            font-weight: bold;
            font-size: 20px;
        }

        .lunas {
            text-align: center;
            font-weight: bold;
            color: green;
            border-width: 2px;
            border-style: dashed solid;
            position: relative;
            margin: 1em 0;
            transform: rotate(-20deg);
            -ms-transform: rotate(-20deg);
            -webkit-transform: rotate(-20deg);
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
    <?php
    foreach ($bill as $r => $data) { ?>
        <div class="book">
            <div class="page">
                <div class="row invoice">
                    <div class="col-8">
                        <h3><?= $company['company_name'] ?></h3>
                        <br>
                        <h6>
                            <?= $company['sub_name'] ?>
                        </h6>
                        <span>No HP : <?= $company['whatsapp'] ?> email : <?= $company['email'] ?></span> <br>
                        <span style="font-style: italic;">Alamat : <?= $company['address'] ?></span>
                    </div>
                    <div class="col-4 text-right">
                        <img src="<?= base_url('assets/images/' . $company['logo']) ?>" alt="logo">

                    </div>
                </div>
                <hr>
                <div class="row invoice-title">
                    <div class="col text-right">
                        <h3>INVOICE</h3>
                    </div>
                </div>
                <div class="row fromto">
                    <div class="col-6">
                        Kepada :
                        <h5><?= $data->customer_name ?></h5>
                        <h6><?= $data->no_wa ?></h6>
                        <h6><?= $data->address ?></h6>
                    </div>
                    <div class="col-4 text-right">
                        <h6 style="font-weight:bold">No Invoice : </h6>
                        <h6 style="font-weight:bold">Tanggal Invoice :</h6>
                        <h6 style="font-weight:bold">Jatuh Tempo :</h6>
                    </div>
                    <div class="col-2 text-left" style="margin-left:-15 ;">
                        <h6><?= $data->invoice ?></h6>
                        <h6><?= date('d-m-Y', $data->created) ?></h6>
                        <h6><?= $company['due_date'] ?>-<?= $data->month ?>-<?= $data->year ?></h6>
                    </div>
                </div>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="text-align: center; width:10px">No</th>
                            <th>Item</th>
                            <th style="text-align: center">Qty</th>
                            <th style="text-align: right">Harga</th>
                            <th style="text-align: center">Disc</th>
                            <th style="text-align: right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $query = "SELECT *
                                    FROM `invoice_detail`  JOIN `package_item` 
                                                                ON `invoice_detail`.`item_id` = `package_item`.`p_item_id`
                                        WHERE `invoice_detail`.`invoice_id` = $data->invoice  ";
                            $querying = $this->db->query($query)->result(); ?>
                            <?php $subtotal = 0;
                            foreach ($querying as  $dataa)
                                $subtotal += (int) $dataa->total;
                            ?>
                            <?php $no = 1;
                            foreach ($querying as  $dataa) {
                            ?>
                        <tr>

                            <td style="text-align: center;"><?= $no++ ?></td>
                            <td><?= $dataa->name ?></td>
                            <td style="text-align: center;"><?= $dataa->qty ?></td>
                            <td style="text-align: right;"><?= indo_currency($dataa->price) ?></td>
                            <td style="text-align: right;"> <?php if ($dataa->disc <= 0) { ?>
                                    -
                                <?php } ?>
                                <?php if ($dataa->disc > 0) { ?>

                                    <?= indo_currency($dataa->disc)  ?>
                                <?php } ?></td>
                            <td style="text-align: right;"><?= indo_currency($dataa->total) ?></td>
                        </tr>
                    <?php } ?>
                    </tr>
                    <!-- <tr>
                            <td>Tagihan Paket Internet Periode <?= indo_month($data->month) ?> <?= $data->year ?></td>
                            <td style="text-align: right;"><?php $no_invoice = $data->invoice ?> <?php $query = "SELECT *
                                    FROM `invoice_detail`
                                        WHERE `invoice_detail`.`invoice_id` =  $no_invoice ";
                                                                                                    $querying = $this->db->query($query)->result(); ?>
                                <?php $subtotal = 0;
                                foreach ($querying as  $dataa)
                                    $subtotal += (int) $dataa->total;
                                ?>
                                <?= indo_currency($subtotal) ?></td>
                        </tr> -->
                    </tbody>
                    <tfoot>
                        <tr class="text-right" style="font-size: small;">
                            <th colspan="5">Kode Unik</th>
                            <th><?= $data->code_unique ?></th>
                        </tr>
                        <tr style="text-align: right">
                            <th colspan="5">Total Tagihan</th>
                            <th><?= indo_currency($subtotal + $data->code_unique)  ?></th>
                        </tr>
                    </tfoot>
                </table>
                <span style="font-style: italic; ">* Terbilang : <?= to_word($subtotal + $data->code_unique) ?> rupiah</span>
                <br><br>
                <h6 style="font-weight: bold; color:red"> Catatan :</h6>
                Transfer tepat <b><?= indo_currency($subtotal + $data->code_unique)  ?></b> (Tagihan + Kode Unik) untuk meningkatkan pelayanan dan donasi. <br>
                <br><b> Cara Pembayaran Bisa Transfer :</b> <br>
                <?php
                foreach ($bank as $r => $data) { ?>
                    <?= $data->name ?> : <?= $data->no_rek ?> A/N <?= $data->owner ?>
                    <br>
                <?php } ?>
                <br><br>
                <b>Konfirmasi Pembayaran :</b> <br>
                Email : <?= $company['email'] ?>
                <br>
                WA : <?= $company['whatsapp'] ?>
                <style>
                    .container {
                        display: flex;
                        flex-direction: column;
                        height: 30vh;
                    }



                    footer {

                        flex-shrink: 0;
                    }

                    main {
                        flex: 1 0 auto;
                    }
                </style>
                <div class="container">

                    <main class="content">

                    </main>
                    <footer>
                        <div class="row">
                            <div class="col-5 text-right border-right border-primary">
                                <h3 style="margin-top: 5px;">Terimakasih</h3>
                            </div>
                            <div class="col-7 text-left">
                                <h6 style="color: red;">Syarat dan Ketentuan</h6>

                                <span>Mohon lakukan pembayaran tepat waktu</span>

                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- end page -->
    <script src="<?= base_url('assets/') ?>frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
    <script src="<?= base_url('assets/') ?>frontend/libraries/bootstrap/js/bootstrap.js"></script>
</body>

</html>