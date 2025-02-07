<?= $this->extend('layout_front') ?>
<?= $this->section('content'); ?>
<section class="wrapper bg-gray">
    <div class="container py-3 py-md-5">
        <nav class="d-inline-block" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
                <li class="breadcrumb-item active text-muted" aria-current="page">Jadwal</li>
            </ol>
        </nav>
        <!-- /nav -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->

<section class="wrapper bg-light">
    <div class="container pt-12 pt-md-14 pb-14 pb-md-16">
        <div class="row gx-md-8 gx-xl-12 gy-12">
            <div class="col-lg-12">
                <div class="author-info d-md-flex align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        <div>
                            <h3 class="mb-4">Jadwal Lapangan</h3>
                        </div>
                    </div>
                    <div class="mt-3 mt-md-0 ms-auto">
                        <a href="<?= base_url('booking') ?>" class="btn btn-sm btn-primary rounded-pill btn-icon btn-icon-start mb-0">Booking Sekarang</a>
                    </div>
                </div>
                <hr class="mt-7 mb-6">
                <?php if (!empty($jadwal)) : ?>
                    <table class="table mb-0 small">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal Main</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jadwal as $row) : ?>
                                <tr>
                                    <td class="p-0">
                                        <div class="d-flex align-items-center">
                                            <div class="ms-2">
                                                <?= $row->pelanggan_nama ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0"><?= $row->tanggal ?></td>
                                    <td class="p-0"><?= $row->waktu_mulai ?></td>
                                    <td class="p-0"><?= $row->waktu_selesai ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <div class="text-center">
                        <p class="text-dark">Belum ada jadwal yang akan datang.</p>
                    </div>
                <?php endif ?>
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<?= $this->endSection(); ?>