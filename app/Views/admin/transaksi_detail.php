<?= $this->extend('layout_admin') ?>
<?= $this->section('content'); ?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><?= $title ?></div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/transaksi') ?>">Transaksi</a>
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
                                <h2 class="to">Pelanggan : <?= $transaksi->pelanggan_nama ?></h2>
                                <div class="address">Tanggal Booking : <?= $transaksi->tanggal_pesan ?></div>
                                <div class="address">Tanggal Bayar : <?= ($transaksi->status != 'Belum Bayar') ? '<a href="' . base_url('assets/img/bayar/' . $transaksi->bukti_bayar) . '" target="_blank" class="link-primary">' . $transaksi->tanggal_bayar . ' (Lihat Bukti)</a>' : 'Belum Bayar' ?></div>
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-left">Jadwal Main</th>
                                    <th class="text-right">Jam Mulai</th>
                                    <th class="text-right">Jam Selesai</th>
                                    <th class="text-right">Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($jadwal as $row) : ?>
                                    <tr>
                                        <td class="no"><?= $i++ ?></td>
                                        <td class="text-left">
                                            <h3>
                                                <a target="_blank" href="javascript:;">
                                                    <?= $row->tanggal ?>
                                                </a>
                                            </h3>
                                        </td>
                                        <td class="unit"><?= $row->waktu_mulai ?></td>
                                        <td class="qty"><?= $row->waktu_selesai ?></td>
                                        <td class="total">Rp <?= number_format($row->harga) ?></td>
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
                    <?php if ($row->status != "Butuh Verifikasi") : ?>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verifikasi" data-id="<?= $row->transaksi_id ?>">Verifikasi</button>
                        </div>
                    <?php endif ?>
                </div>
                <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="verifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="<?= base_url('admin/verifikasi') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="transaksi_id" id="" value="<?= $transaksi->transaksi_id ?>">
                <div class="modal-body">
                    <h5>Yakin ingin verifikasi ?</h5>
                    Pastikan sudah memeriksa bukti bayar.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-warning" type="submit">Verifikasi</button>
                </div>
            </form>
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