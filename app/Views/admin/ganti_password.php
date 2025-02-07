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
<div class="row">
    <div class="card col-md-6">
        <div class="card-body">
            <h6 class="text-uppercase">Ganti Password</h6>
            <small class="mb-4">Masukkan password sekarang dan password baru untuk mengubah password</small>
            <form action="<?= base_url('admin/ganti-password') ?>" method="post" class="mt-4">
                <?= csrf_field() ?>
                <div class="form-group mb-4">
                    <label for="user_password">Password Sekarang</label>
                    <input type="password" class="form-control <?= (isset(session('errors')['current_password'])) ? 'is-invalid' : '' ?>" id="current_password" name="current_password" value="<?= old('current_password') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['current_password'])) : ?>
                            <?= session('errors')['current_password'] ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="user_password">Password</label>
                    <input type="password" class="form-control <?= (isset(session('errors')['user_password'])) ? 'is-invalid' : '' ?>" id="user_password" name="user_password" value="<?= old('user_password') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['user_password'])) : ?>
                            <?= session('errors')['user_password'] ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" class="form-control <?= (isset(session('errors')['password_confirmation'])) ? 'is-invalid' : '' ?>" id="password_confirmation" name="password_confirmation">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['password_confirmation'])) : ?>
                            <?= session('errors')['password_confirmation'] ?>
                        <?php endif; ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-md">Ganti Password</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>