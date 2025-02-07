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
        <h6 class="mb-4 text-uppercase">Jadwal</h6>
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Main</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($transaksi as $row) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row->pelanggan_nama ?></td>
                            <td><?= $row->tanggal ?></td>
                            <td><?= $row->waktu_mulai ?></td>
                            <td><?= $row->waktu_selesai ?></td>
                            <td><?= $row->status ?></td>
                            <td>
                                <?php if ($row->status == "Pending") : ?>
                                    <button class="badge bg-primary border" data-bs-toggle="modal" data-bs-target="#checkin" data-id="<?= $row->jadwal_id ?>">Check In</button>
                                <?php endif ?>
                                <?php if ($row->status == "Aktif") : ?>
                                    <button class="badge bg-danger border" data-bs-toggle="modal" data-bs-target="#selesai" data-id="<?= $row->jadwal_id ?>">Selesai</button>
                                <?php endif ?>
                                <?php if ($row->status == "Selesai") : ?>
                                    <div class="badge rounded-pill text-primary bg-light-primary p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Selesai</div>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="checkin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="<?= base_url('admin/jadwal/checkin') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="jadwal_id" id="kodeitem" value="">
                <div class="modal-body">
                    <h5>Yakin ingin checkin ?</h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Checkin</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="selesai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="<?= base_url('admin/jadwal/selesai') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="jadwal_id" id="kodeitemselesai" value="">
                <div class="modal-body">
                    <h5>Yakin ingin ubah status jadwal ke 'Selesai' ?</h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-danger" type="submit">Selesai</button>
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
    $('#checkin').on('show.bs.modal', function(event) {
        var kode = $(event.relatedTarget).data('id');
        $(this).find('#kodeitem').attr("value", kode);
    });
    $('#selesai').on('show.bs.modal', function(event) {
        var kode = $(event.relatedTarget).data('id');
        $(this).find('#kodeitemselesai').attr("value", kode);
    });
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<?= $this->endSection(); ?>