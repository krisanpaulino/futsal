<?= $this->extend('layout_admin') ?>
<?= $this->section('content'); ?>
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
<div class="row">
    <h1>Selamat Datang Admin!</h1>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
    <div class="col">
        <div class="card radius-10 border-start border-0 border-4 border-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Booking</p>
                        <h4 class="my-1 text-info"><?= $total_booking ?></h4>
                        <p class="mb-0 font-13"><a href="<?= base_url('admin/transaksi') ?>"></a></p>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class="bx bxs-cart"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-start border-0 border-4 border-danger">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Jadwal Hari Ini</p>
                        <h4 class="my-1 text-danger"><?= $jadwal_hariini ?></h4>
                        <p class="mb-0 font-13"><a href="<?= base_url('admin/jadwal/hari-ini') ?>"></a></p>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class="bx bx-timer"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>