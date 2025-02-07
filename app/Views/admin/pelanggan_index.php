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
        <h6 class="mb-4 text-uppercase">Pelanggan</h6>
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pelanggan</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Total Transaksi</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($pelanggan as $row) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row->pelanggan_nama ?></td>
                            <td><?= $row->pelanggan_email ?></td>
                            <td><?= $row->pelanggan_telepon ?></td>
                            <td><?= $row->jumlah_transaksi ?></td>
                            <td>
                                <a href="<?= base_url('admin/transaksi-pelanggan/' . $row->pelanggan_id) ?>" class="badge bg-primary">Lihat Transaksi</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
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