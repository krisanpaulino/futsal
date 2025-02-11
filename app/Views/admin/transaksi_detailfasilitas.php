<?= $this->extend('layout_admin') ?>
<?= $this->section('content'); ?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><?= $title ?></div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/transaksi-fasilitas') ?>">Transaksi Fasilitas</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
<div class="card">
    <div class="card-body">
        <div id="invoice">
            <div class="invoice overflow-auto">
                <div style="min-width: 600px">
                    <main>
                        <div class="row contacts">
                            <div class="col invoice-to">
                                <div class="text-gray-light">Detail Transaksi:</div>
                                <div class="address">Tanggal Sewa : <?= $transaksi->tanggal_pesan ?></div>
                                <div class="address">Tanggal Bayar : <?= $transaksi->tanggal_bayar ?></div>
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-left">Fasilitas</th>
                                    <th class="text-right">Jumlah</th>
                                    <th class="text-right">Durasi (Jam)</th>
                                    <th class="text-right">Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($sewafasilitas as $row) : ?>
                                    <tr>
                                        <td class="no"><?= $i++ ?></td>
                                        <td class="text-left">
                                            <h3>
                                                <a target="_blank" href="javascript:;">
                                                    <?= $row->nama_fasilitas ?>
                                                </a>
                                            </h3>
                                        </td>
                                        <td class="unit"><?= $row->jumlah_sewa ?></td>
                                        <td class="qty"><?= $row->jumlah_jam ?></td>
                                        <td class="total">Rp <?= number_format($row->sub_total) ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>

                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">Total Bayar</td>
                                    <td> Rp <?= number_format($transaksi->total_bayar) ?></td>
                                </tr>
                            </tfoot>
                        </table>

                    </main>
                </div>
                <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('cssplugins'); ?>
<link href="<?= base_url() ?>assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<?= $this->endSection(); ?>
<?= $this->section('jsplugins'); ?>
<script src="<?= base_url() ?>assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<?= $this->endSection(); ?>