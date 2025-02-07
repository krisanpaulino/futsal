<?= $this->extend('layout_' . session('user')->user_type); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><?= $title ?></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="bx bx-home-alt"></i></a>
                    </li>
                    </li>
                    <li class="breadcrumb-item"><a href="<?= base_url(session('user')->user_type) ?>/tanaman">Data Tanaman</a>
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
    <div class="card">
        <div class="card-body">
            <h6 class="mb-0 text-uppercase"><?= $form_title ?></h6>
            <hr />
            <?php if ($tanaman->tanaman_id == null) : ?>
                <?= form_open(session('user')->user_type . '/tanaman/store') ?>
                <input type="hidden" name="tanaman_id" value="<?= $tanaman->tanaman_id ?>">
            <?php else : ?>
                <?= form_open(session('user')->user_type . '/tanaman/update') ?>
                <input type="hidden" name="tanaman_id" value="<?= $tanaman->tanaman_id ?>">
            <?php endif ?>
            <?php if (session('petani_logged_in')) : ?>
                <input type="hidden" name="petani_id" value="<?= petani()->petani_id ?>">

            <?php endif ?>

            <div class="form-group mb-4">
                <label for="tanaman_nama">Nama Tanaman</label>
                <input type="text" class="form-control <?= (isset(session('errors')['tanaman_nama'])) ? 'is-invalid' : '' ?>" id="tanaman_nama" name="tanaman_nama" value="<?= old('tanaman_nama', $tanaman->tanaman_nama) ?>">
                <div class="invalid-feedback">
                    <?php if (isset(session('errors')['tanaman_nama'])) : ?>
                        <?= session('errors')['tanaman_nama'] ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="tanaman_detail">Detail Tanaman</label>
                <textarea id="editor" name="tanaman_detail" aria-hidden="true" style="display: none;" required><?= old('tanaman_detail', $tanaman->tanaman_detail) ?></textarea>
                <div class="invalid-feedback">
                    <?php if (isset(session('errors')['tanaman_detail'])) : ?>
                        <?= session('errors')['tanaman_detail'] ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="tanaman_penyakit">Penyakit Tanaman</label>
                <textarea id="editor2" name="tanaman_penyakit" aria-hidden="true" style="display: none;" required><?= old('tanaman_penyakit', $tanaman->tanaman_penyakit) ?></textarea>
                <div class="invalid-feedback">
                    <?php if (isset(session('errors')['tanaman_penyakit'])) : ?>
                        <?= session('errors')['tanaman_penyakit'] ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="tanaman_perawatan">Perawatan</label>
                <textarea id="editor1" name="tanaman_perawatan" aria-hidden="true" style="display: none;" required><?= old('tanaman_perawatan', $tanaman->tanaman_perawatan) ?></textarea>
                <div class="invalid-feedback">
                    <?php if (isset(session('errors')['tanaman_perawatan'])) : ?>
                        <?= session('errors')['tanaman_perawatan'] ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan Tanaman</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script src="<?= base_url() ?>/assets/plugins/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor2');
</script>
<?= $this->endSection(); ?>