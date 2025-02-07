<?= $this->extend('layout_admin') ?>
<?= $this->section('content'); ?>
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Lapangan</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Lapangan</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Form</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-xl-6 mx-auto">

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Form Lapangan</h5>
                <form class="row g-3" action="<?= base_url('admin/lapangan') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="lapangan_id" value="<?= $lapangan->lapangan_id ?>">
                    <div class="form-group mb-4">
                        <label for="ukuran">Ukuran Lapangan</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['ukuran'])) ? 'is-invalid' : '' ?>" id="ukuran" name="ukuran" value="<?= old('ukuran', $lapangan->ukuran) ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['ukuran'])) : ?>
                                <?= session('errors')['ukuran'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="harga_sewa">Harga Sewa</label>
                        <input type="number" class="form-control <?= (isset(session('errors')['harga_sewa'])) ? 'is-invalid' : '' ?>" id="harga_sewa" name="harga_sewa" value="<?= old('harga_sewa', $lapangan->harga_sewa) ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['harga_sewa'])) : ?>
                                <?= session('errors')['harga_sewa'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="file">Gambar <?= ($lapangan->gambar != null) ? ' *Biarkan kosong jika tidak ingin ubah gambar' : '' ?> </label>
                        <input type="file" class="form-control <?= (isset(session('errors')['file'])) ? 'is-invalid' : '' ?>" id="file" name="file">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['file'])) : ?>
                                <?= session('errors')['file'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<!--end row-->
<?= $this->endSection(); ?>