<?= $this->extend('layout_admin') ?>
<?= $this->section('content'); ?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><?= $title ?></div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
<?php if (session()->has('success')) : ?>
    <div class="alert alert-success border-0 bg-success alert-dismissible fade show">
        <div class="text-white"><?= session('success') ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>
<?php if (session()->has('danger')) : ?>
    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
        <div class="text-white"><?= session('danger') ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>
<hr />
<div class="card">
    <div class="card-body">
        <h6 class="mb-4 text-uppercase">Data Transaksi</h6>
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Waktu Pesan</th>
                        <th>Nama Pelanggan</th>
                        <th>Jumlah Booking</th>
                        <th>Total Bayar</th>
                        <th>Waktu Bayar</th>
                        <th>Bukti</th>
                        <th>Status Pembayaran</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($transaksi as $row) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row->tanggal_pesan ?></td>
                            <td><?= $row->pelanggan_nama ?></td>
                            <td><?= $row->jumlah ?></td>
                            <td><?= number_format($row->total_bayar) ?></td>
                            <td><?= $row->tanggal_bayar ?></td>
                            <td><a target="_blank" href="<?= base_url('assets/img/bayar/' . $row->bukti_bayar) ?>"><?= ($row->tanggal_bayar != null) ? 'Lihat Bukti' : '' ?></a></td>
                            <td><?= $row->status ?></td>
                            <td>
                                <a href="<?= base_url('admin/transaksi/' . $row->transaksi_id) ?>" class="badge bg-primary">Lihat Detail</a>
                                <?php if ($row->status == "Butuh Verifikasi") : ?>
                                    <button class="badge bg-warning border" data-bs-toggle="modal" data-bs-target="#verifikasi" data-id="<?= $row->transaksi_id ?>">Verifikasi</button>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="verifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="<?= base_url('admin/verifikasi') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="transaksi_id" id="kodeitem" value="">
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
<?= $this->section('scripts'); ?>
<script>
    $('#verifikasi').on('show.bs.modal', function(event) {
        var kode = $(event.relatedTarget).data('id');
        $(this).find('#kodeitem').attr("value", kode);
    });
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<?= $this->endSection(); ?>