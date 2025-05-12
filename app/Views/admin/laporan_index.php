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
<?php

if (session()->has('success')) : ?>
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
<form class="row row-cols-1 g-3 mb-4 row-cols-lg-auto align-items-center">
    <div class="col">
        <input type="date" class="form-control" id="input51" name="dari" value="<?= $dari ?>" placeholder="Dari Tanggal">
    </div>
    <div class="col">
        <input type="date" class="form-control" id="input51" name="sampai" value="<?= $sampai ?>" placeholder="Sampai Tanggal">
    </div>
    <div class="col">
        <button type="submit" class="btn btn-primary px-4">Filter</button>
    </div>
    <div class="col">
        <a href="<?= base_url('admin/laporan/cetak?dari=' . $dari . '&sampai=' . $sampai) ?>" target="_blank" class="btn btn-warning px-4">Cetak</a>
    </div>
</form>
<div class="card">
    <div class="card-body">
        <h6 class="mb-4 text-uppercase">Laporan Keuangan</h6>
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Waktu Transaksi</th>
                        <th>Waktu Pembayaran</th>
                        <th>Pelanggan</th>
                        <th>Jenis Transaksi</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    $total = 0; ?>
                    <?php foreach ($transaksi as $row) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row->tanggal_pesan ?></td>
                            <td><?= $row->tanggal_bayar ?></td>
                            <td><?= $row->pelanggan_nama ?></td>
                            <td><?= $row->jenis ?></td>
                            <td><?= number_format($row->total_bayar) ?></td>
                        </tr>
                        <?php $total += $row->total_bayar ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            <b>Total = Rp<?= number_format($total) ?></b>
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