<?= $this->extend('layout_front') ?>
<?= $this->section('content'); ?>
<!-- /header -->
<section class="wrapper bg-light position-relative min-vh-70 d-lg-flex align-items-center">
    <div class="rounded-4-lg-start col-lg-6 order-lg-2 position-lg-absolute top-0 end-0 image-wrapper bg-image bg-cover h-100 min-vh-50" data-image-src="<?= base_url('assets/front') ?>/images/home1.jpg">
    </div>
    <!--/column -->
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-10 mt-md-11 mt-lg-n10 px-10 px-md-11 ps-lg-0 pe-lg-13 text-center text-lg-start" data-cues="slideInDown" data-group="page-title" data-delay="600">
                    <h1 class="display-1 mb-5">Indah Futsal Kupang.</h1>
                    <p class="lead fs-25 lh-sm mb-7 pe-md-10">Membina persaudaraan di lapangan.</p>
                    <div class="d-flex justify-content-center justify-content-lg-start" data-cues="slideInDown" data-group="page-title-buttons" data-delay="900">
                        <span><a href="<?= base_url('booking') ?>" class="btn btn-lg btn-primary rounded-pill me-2">Booking sekarang</a></span>
                    </div>
                </div>
                <!--/div -->
            </div>
            <!--/column -->
        </div>
        <!--/.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->
<section class="wrapper bg-light">
    <div class="container py-14 py-md-18">
        <div class="row gx-lg-8 gx-xl-12 gy-12 align-items-center mb-5 mb-md-5">
            <div class="col-lg-6 position-relative">
                <div class="row gx-md-5 gy-5 align-items-center">
                    <div class="col-md-6">
                        <div class="row gx-md-5 gy-5">
                            <!--/column -->
                            <div class="col-md-12">
                                <figure class="rounded"><img src="<?= base_url('assets/front') ?>/images/home2.jpg" alt=""></figure>
                            </div>
                            <!--/column -->
                        </div>
                        <!--/.row -->
                    </div>
                    <!--/column -->
                    <div class="col-md-6">
                        <figure class="rounded"><img src="<?= base_url('assets/front') ?>/images/home2.jpg " alt=""></figure>
                    </div>
                    <!--/column -->
                </div>
                <!--/.row -->
            </div>
            <!--/column -->
            <div class="col-lg-6">
                <h3 class="display-4 mb-5">Mari berlaga.</h3>
                <p class="mb-7">Indah Futsal Kupang adalah tempat futsal modern yang terletak di Kelurahan Tuak Daun Merah, Oebobo, Kota Kupang. Dengan fasilitas yang nyaman dan lapangan berkualitas, kami menghadirkan pengalaman bermain futsal yang menyenangkan untuk semua kalangan. Mengusung motto "Membangun Persaudaraan di Lapangan", Indah Futsal Kupang menjadi tempat yang sempurna untuk berolahraga, menjalin persahabatan, dan mempererat kebersamaan. Ayo bergabung dan rasakan semangat kebersamaan di setiap permainan!</p>
                <!--/.row -->
            </div>
            <!--/column -->
        </div>
        <!--/.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->
<!-- /section -->
<section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
        <!--/.row -->
        <hr class="mt-15 mt-md-18 mb-14 mb-md-17" />
        <h3 class="display-4 mb-3 text-center">Testimoni kustomer kami</h3>
        <p class="lead fs-lg mb-10 text-center">Ini yang kostumer katakan tentang kami.</p>
        <div class="row gx-lg-8 gx-xl-12 gy-6 mb-14 align-items-center">
            <div class="col-lg-7">
                <div class="row gx-md-5 gy-5">
                    <div class="col-md-6">
                        <figure class="rounded mt-md-10 position-relative"><img src="<?= base_url('assets/front') ?>/img/photos/g5.jpg" srcset="<?= base_url('assets/front') ?>/img/photos/g5@2x.jpg 2x" alt=""></figure>
                    </div>
                    <!--/column -->
                    <div class="col-md-6">
                        <div class="row gx-md-5 gy-5">
                            <div class="col-md-12 order-md-2">
                                <figure class="rounded"><img src="<?= base_url('assets/front') ?>/images/home4.jpeg" srcset="<?= base_url('assets/front') ?>/img/photos/g6@2x.jpg 2x" alt=""></figure>
                            </div>
                            <!--/column -->
                            <div class="col-md-10">
                                <div class="card bg-pale-primary text-center">

                                    <!--/.card-body -->
                                </div>
                                <!--/.card -->
                            </div>
                            <!--/column -->
                        </div>
                        <!--/.row -->
                    </div>
                    <!--/column -->
                </div>
                <!--/.row -->
            </div>
            <!--/column -->
            <div class="col-lg-5 mt-5">
                <div class="swiper-container dots-closer mb-6" data-margin="30" data-dots="true">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($feedback as $row) : ?>
                                <div class="swiper-slide">
                                    <blockquote class="icon icon-top fs-lg text-center">
                                        <p>“<?= $row->komentar ?>”</p>
                                        <div class="blockquote-details justify-content-center text-center">
                                            <div class="info ps-0">
                                                <h5 class="mb-1"><?= $row->pelanggan_nama ?></h5>
                                                <p class="mb-0">Pelanggan</p>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                            <?php endforeach ?>
                            <!--/.swiper-slide -->
                        </div>
                        <!--/.swiper-wrapper -->
                    </div>
                    <!--/.swiper -->
                </div>
                <!-- /.swiper-container -->
            </div>
            <!--/column -->
        </div>
        <!--/.row -->
        <div class="px-lg-5 mb-16 mb-md-22">
            <div class="row gx-0 gx-md-8 gx-xl-12 gy-8 align-items-center">
                <div class="col-4 col-md-2">
                    <figure class="px-5 px-md-0 px-lg-2 px-xl-3 px-xxl-4"><img src="<?= base_url('assets/front') ?>/img/brands/c1.png" alt="" /></figure>
                </div>
                <!--/column -->
                <div class="col-4 col-md-2">
                    <figure class="px-5 px-md-0 px-lg-2 px-xl-3 px-xxl-4"><img src="<?= base_url('assets/front') ?>/img/brands/c2.png" alt="" /></figure>
                </div>
                <!--/column -->
                <div class="col-4 col-md-2">
                    <figure class="px-5 px-md-0 px-lg-2 px-xl-3 px-xxl-4"><img src="<?= base_url('assets/front') ?>/img/brands/c3.png" alt="" /></figure>
                </div>
                <!--/column -->
                <div class="col-4 col-md-2">
                    <figure class="px-5 px-md-0 px-lg-2 px-xl-3 px-xxl-4"><img src="<?= base_url('assets/front') ?>/img/brands/c4.png" alt="" /></figure>
                </div>
                <!--/column -->
                <div class="col-4 col-md-2">
                    <figure class="px-5 px-md-0 px-lg-2 px-xl-3 px-xxl-4"><img src="<?= base_url('assets/front') ?>/img/brands/c5.png" alt="" /></figure>
                </div>
                <!--/column -->
                <div class="col-4 col-md-2">
                    <figure class="px-5 px-md-0 px-lg-2 px-xl-3 px-xxl-4"><img src="<?= base_url('assets/front') ?>/img/brands/c6.png" alt="" /></figure>
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /div -->
    </div>
    <!-- /.container -->
</section>


<!-- /section -->
<?= $this->endSection(); ?>
<?= $this->section('footer'); ?>
<footer class="bg-soft-primary">
    <div class="container">
        <div class="card shadow-lg mt-n16 mt-md-n21 mb-15 mb-md-14">
            <div class="row gx-0">
                <div class="col-lg-6 image-wrapper bg-image bg-cover rounded-top rounded-lg-start d-none d-md-block" data-image-src="<?= base_url('assets/front') ?>/images/home3.jpg">
                </div>
                <!--/column -->
                <div class="col-lg-6">
                    <div class="p-10 p-md-11 p-lg-13">
                        <h2 class="display-4 mb-3">Bertanding sekarang juga</h2>
                        <p class="">Ayo, tunjukkan skill futsal terbaikmu di Indah Futsal Kupang! Nikmati serunya pertandingan di lapangan berkualitas sambil mempererat persaudaraan bersama teman-teman. Pesan lapangan sekarang dan jadilah bagian dari semangat kebersamaan di setiap tendangan! </p>
                        <a href="<?= base_url('booking') ?>" class="btn btn-primary rounded-pill mt-2">Pesan Lapangan</a>
                    </div>
                    <!--/div -->
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.container -->
    <div class="container pb-12 text-center">
        <div class="row mt-n10 mt-lg-0">
            <div class="col-xl-10 mx-auto">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="widget">
                            <h4 class="widget-title">Alamat</h4>
                            <address>Tuak Daun Merah, Kec. Oebobo, <br class="d-none d-md-block" /> Kota Kupang, Nusa Tenggara Tim.</address>
                        </div>
                        <!-- /.widget -->
                    </div>
                    <!--/column -->
                    <div class="col-md-4">
                        <div class="widget">
                            <h4 class="widget-title">Telepon</h4>
                            <p>0812-4634-2745</p>
                        </div>
                        <!-- /.widget -->
                    </div>
                    <!--/column -->
                    <div class="col-md-4">
                        <div class="widget">
                            <h4 class="widget-title">E-mail</h4>
                            <p><a href="mailto:indahfutsalkupang@gmail.com" class="link-body">indahfutsalkupang@gmail.com</a></p>
                        </div>
                        <!-- /.widget -->
                    </div>
                    <!--/column -->
                </div>
                <!--/.row -->
                <p>© <script>
                        document.write(new Date().getUTCFullYear());
                    </script> Sandbox. All rights reserved.</p>

                <!-- /.social -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</footer>
<?= $this->endSection(); ?>