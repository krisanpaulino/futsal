<?= $this->extend('layout_front') ?>
<?= $this->section('content'); ?>
<section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 text-white" data-image-src="<?= base_url() ?>/assets/img/photos/bg3.jpg">
    <div class="container pt-17 pb-20 pt-md-19 pb-md-21 text-center">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1 class="display-1 mb-3 text-white">Profil Saya</h1>
                <nav class="d-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb text-white">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil</li>
                    </ol>
                </nav>
                <!-- /nav -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->
<section class="wrapper bg-light angled upper-end">
    <div class="container pb-11">
        <div class="row mb-14 mb-md-16">
            <div class="col-xl-6 mx-auto mt-n19">
                <div class="card">
                    <div class="row gx-0">
                        <!--/column -->
                        <div class="col-lg-12">
                            <div class="p-10 p-md-11 p-lg-14">
                                <div class="d-flex flex-row">
                                    <div>
                                        <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-location-pin-alt"></i> </div>
                                    </div>
                                    <div class="align-self-start justify-content-start">
                                        <h5 class="mb-1">Nama</h5>
                                        <address><?= $pelanggan->pelanggan_nama ?></address>
                                    </div>
                                </div>
                                <!--/div -->
                                <div class="d-flex flex-row">
                                    <div>
                                        <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-phone-volume"></i> </div>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Telepon</h5>
                                        <p><?= $pelanggan->pelanggan_telepon ?></p>
                                    </div>
                                </div>

                                <!--/div -->
                                <div class="d-flex flex-row">
                                    <div>
                                        <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-envelope"></i> </div>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">E-mail</h5>
                                        <p class="mb-0"><a href="mailto:<?= $pelanggan->pelanggan_email ?>" class="link-body"><?= $pelanggan->pelanggan_email ?></a></p>
                                    </div>
                                </div>
                                <div class="d-flex flex-row mt-4">
                                    <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#edit">Edit Data</button>
                                    <button type="button" class="btn btn-warning m-2" data-bs-toggle="modal" data-bs-target="#pass">Ganti Password</button>
                                </div>
                                <!--/div -->
                            </div>
                            <!--/div -->
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="modal-title" id="exampleModalLabel2">Edit Profil</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form" action="<?= base_url('profil/update') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" placeholder="Nama" name="pelanggan_nama" value="<?= old('pelanggan_nama', $pelanggan->pelanggan_nama) ?>" required>
                            <label for="file" class="form-label">Nama</label>
                            <div class="invalid-feedback"> </div>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" placeholder="Email" name="pelanggan_email" value="<?= old('pelanggan_email', $pelanggan->pelanggan_email) ?>" required>
                            <label for="file" class="form-label">Email</label>
                            <div class="invalid-feedback"> </div>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" placeholder="Telepon" name="pelanggan_telepon" value="<?= old('pelanggan_telepon', $pelanggan->pelanggan_telepon) ?>" required>
                            <label for="file" class="form-label">Telepon</label>
                            <div class="invalid-feedback"> </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="modal-title" id="exampleModalLabel2">Ganti Password</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form" action="<?= base_url('profil/ganti-password') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" placeholder="Password Sekarang" name="current_password" value="" required>
                            <label for="file" class="form-label">Password Sekarang</label>
                            <div class="invalid-feedback"> </div>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" placeholder="Password Baru" name="user_password" required>
                            <label for="file" class="form-label">Password Baru</label>
                            <div class="invalid-feedback"> </div>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" placeholder="Konfirmasi Password" name="password_confirmation" required>
                            <label for="file" class="form-label">Konfirmasi Password</label>
                            <div class="invalid-feedback"> </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>