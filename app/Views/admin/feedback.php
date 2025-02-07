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
        <h6 class="mb-4 text-uppercase">Data Fasilitas</h6>
        <div class="d-flex justify-content-end mb-4">
            <button class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                <i class="fadeIn animated bx bx-plus"></i> Tambah
            </button>
        </div>
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pelanggan</th>
                        <th>Rating</th>
                        <th>Komentar</th>
                        <th>Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($feedback as $row) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row->nama_fasilitas ?></td>
                            <td><?= number_format($row->harga_sewa) ?></td>
                            <td><?= $row->status ?></td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit" data-id="<?= $row->fasilitas_id ?>" data-nama="<?= $row->nama_fasilitas ?>" data-harga="<?= $row->harga_sewa ?>" class="badge bg-primary">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="<?= base_url('admin/fasilitas/hapus') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="fasilitas_id" id="kodeitemhapus" value="">
                <div class="modal-body">
                    <h5>Yakin ingin mengapus fasilitas ?</h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="<?= base_url('admin/fasilitas/save') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="nama_fasilitas">Nama Fasilitas</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['nama_fasilitas'])) ? 'is-invalid' : '' ?>" id="nama_fasilitas" name="nama_fasilitas" value="<?= old('nama_fasilitas') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['nama_fasilitas'])) : ?>
                                <?= session('errors')['nama_fasilitas'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="harga_sewa">Harga Sewa</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['harga_sewa'])) ? 'is-invalid' : '' ?>" id="harga_sewa" name="harga_sewa" value="<?= old('harga_sewa') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['harga_sewa'])) : ?>
                                <?= session('errors')['harga_sewa'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="<?= base_url('admin/fasilitas/update') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="fasilitas_id" id="kodeitemedit" value="">
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="nama_fasilitas">Nama Fasilitas</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['nama_fasilitas'])) ? 'is-invalid' : '' ?>" id="nama_fasilitas_edit" name="nama_fasilitas" value="">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['nama_fasilitas'])) : ?>
                                <?= session('errors')['nama_fasilitas'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="harga_sewa">Harga Sewa</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['harga_sewa'])) ? 'is-invalid' : '' ?>" id="harga_sewa_edit" name="harga_sewa">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['harga_sewa'])) : ?>
                                <?= session('errors')['harga_sewa'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="<?= base_url('admin/fasilitas/update') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="fasilitas_id" id="kodeitemstatus" value="">
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="nama_fasilitas">Status</label>
                        <select class="form-select <?= (isset(session('errors')['nama_fasilitas'])) ? 'is-invalid' : '' ?>" id="status_edit" name="status">
                            <option value="Tersedia">Tersedia</option>
                            <option value="Tidak Tersedia">Tidak Tersedia</option>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['nama_fasilitas'])) : ?>
                                <?= session('errors')['nama_fasilitas'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Update</button>
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
    $('#hapus').on('show.bs.modal', function(event) {
        var kode = $(event.relatedTarget).data('id');
        $(this).find('#kodeitemhapus').attr("value", kode);
    });
    $('#edit').on('show.bs.modal', function(event) {
        var kode = $(event.relatedTarget).data('id');
        var nama = $(event.relatedTarget).data('nama');
        var harga = $(event.relatedTarget).data('harga');
        $(this).find('#kodeitemedit').attr("value", kode);
        $(this).find('#nama_fasilitas_edit').attr("value", nama);
        $(this).find('#harga_sewa_edit').attr("value", harga);
    });
    $('#status').on('show.bs.modal', function(event) {
        console.log('here');
        var kode = $(event.relatedTarget).data('id');
        var status = $(event.relatedTarget).data('status');
        $(this).find('#kodeitemstatus').attr("value", kode);
        $('#status_edit option[value="' + status + '"]').attr('selected', 'selected');
    });
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<?= $this->endSection(); ?>