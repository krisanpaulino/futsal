<?= $this->extend('layout_admin') ?>
<?= $this->section('content'); ?>
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Lapangan</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Lapangan</li>
            </ol>
        </nav>
    </div>
</div>
<div class="d-flex justify-content-end mb-4">
    <a class=" btn btn-primary" href="<?= base_url('admin/lapangan/tambah') ?>">
        <i class="fadeIn animated bx bx-plus"></i> Tambah
    </a>
</div>
<?php if (!empty($lapangan)) : ?>
    <h6 class="mb-0 text-uppercase">Data Lapangan</h6>
    <hr />
    <?php foreach ($lapangan as $row) : ?>
        <div class="row d-flex justify-content-center row-cols-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3">
            <div class="col">
                <div class="card">
                    <img src="<?= base_url('assets/img/lapangan/') . $row->gambar ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Lapangan Indah Futsal Kupang</h5>
                        <p class="card-text">Informasi lapangan.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Ukuran :</b><?= $row->ukuran ?></li>
                        <li class="list-group-item"><b>Harga sewa :</b><?= $row->harga_sewa ?></li>
                    </ul>
                    <div class="card-body"> <a href="<?= base_url('admin/lapangan/edit/' . $row->lapangan_id) ?>" class="card-link">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php else: ?>
    <hr class="border-top" />
    <div class="row d-flex justify-content-center row-cols-1  row-cols-1 row-cols-md-3 row-cols-lg-3 row-cols-xl-3">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h5 class="card-title">Belum ada data lapangan tersedia</h5>
                    </div>
                    <a href="<?= base_url('admin/lapangan/form') ?>" class="btn btn-primary">Buat informasi lapangan</a>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
<?= $this->endSection(); ?>