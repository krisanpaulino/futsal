<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="An impressive and flawless site template that includes various UI elements and countless features, attractive ready-made blocks and rich pages, basically everything you need to create a unique and professional website.">
    <meta name="keywords" content="bootstrap 5, business, corporate, creative, gulp, marketing, minimal, modern, multipurpose, one page, responsive, saas, sass, seo, startup, html5 template, site template">
    <meta name="author" content="elemis">
    <title><?= $title ?></title>
    <link rel="shortcut icon" href="<?= base_url('assets/front') ?>/img/favicon.png">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/front') ?>/css/plugins.css">
    <link rel="stylesheet" href="<?= base_url('assets/front') ?>/css/style.css">
</head>

<body>
    <div class="content-wrapper">
        <header class="wrapper bg-soft-primary">
            <nav class="navbar navbar-expand-lg center-nav transparent position-absolute navbar-dark">
                <div class="container flex-lg-row flex-nowrap align-items-center">
                    <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                        <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Jadwal</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Booking</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Riwayat Booking</a></li>
                            </ul>
                            <!-- /.offcanvas-footer -->
                        </div>
                        <!-- /.offcanvas-body -->
                    </div>
                    <!-- /.navbar-collapse -->
                    <!-- /.navbar-other -->
                </div>
                <!-- /.container -->
            </nav>
            <!-- /.navbar -->
        </header>
        <!-- /header -->
        <section class="wrapper bg-dark text-white">
            <div class="container pt-18 pt-md-20 pb-21 pb-md-21 text-center">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h1 class="display-1 text-white mb-3">Signup</h1>
                        <nav class="d-inline-block" aria-label="breadcrumb">
                            <ol class="breadcrumb text-white">
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
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
        <section class="wrapper bg-light">
            <div class="container pb-14 pb-md-16">
                <div class="row">
                    <div class="col mt-n19">
                        <div class="card shadow-lg">
                            <div class="row gx-0 text-center">
                                <div class="col-lg-6 image-wrapper bg-image bg-cover rounded-top rounded-lg-start d-none d-md-block" data-image-src="<?= base_url('assets/front') ?>/images/signup2.jpg">
                                </div>
                                <!--/column -->
                                <div class="col-lg-6">
                                    <div class="p-10 p-md-11 p-lg-13">
                                        <h2 class="mb-3 text-start">Daftar Sekarang</h2>
                                        <p class="lead mb-6 text-start">Masukkan data dirimu secara lengkap.</p>
                                        <form class="text-start mb-3" action="<?= base_url('sign-up') ?>" method="post">
                                            <div class="form-floating mb-4">
                                                <input type="email" class="form-control" placeholder="Email" name="username" id="loginEmail">
                                                <label for="loginEmail">Email</label>
                                            </div>
                                            <div class="form-floating mb-4">
                                                <input type="text" class="form-control" name="pelanggan_nama">
                                                <label for="loginEmail">Nama Lengkap</label>
                                            </div>
                                            <div class="form-floating mb-4">
                                                <input type="text" class="form-control" name="pelanggan_telepon">
                                                <label for="loginEmail">Nomor HP (WA)</label>
                                            </div>
                                            <div class="form-floating password-field mb-4">
                                                <input type="password" name="user_password" class="form-control" placeholder="Password" id="loginPassword">
                                                <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                                <label for="loginPassword">Password</label>
                                            </div>
                                            <div class="form-floating password-field mb-4">
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="Password" id="loginPassword">
                                                <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                                <label for="loginPassword">Konfirmasi Password</label>
                                            </div>
                                            <button class="btn btn-primary rounded-pill btn-login w-100 mb-2" type="submit">Sign Up</button>
                                        </form>
                                        <!-- /form -->
                                        <p class="mb-0">Sudah punya akun? <a href="<?= base_url('auth') ?>" class="hover">Log in</a></p>
                                        <!--/.social -->
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
        <!-- /section -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="bg-dark text-inverse">
        <div class="container py-13 py-md-15">
            <div class="row gy-6 gy-lg-0">
                <div class="col-md-4 col-lg-3">
                    <div class="widget">
                        <img class="mb-4" src="<?= base_url('assets/front') ?>/img/logo-light.png" srcset="<?= base_url('assets/front') ?>/img/logo-light@2x.png 2x" alt="" />
                        <p class="mb-4">© <script>
                                document.write(new Date().getUTCFullYear());
                            </script> Sandbox. <br class="d-none d-lg-block" />All rights reserved.</p>
                        <nav class="nav social social-white">
                            <a href="#"><i class="uil uil-twitter"></i></a>
                            <a href="#"><i class="uil uil-facebook-f"></i></a>
                            <a href="#"><i class="uil uil-dribbble"></i></a>
                            <a href="#"><i class="uil uil-instagram"></i></a>
                            <a href="#"><i class="uil uil-youtube"></i></a>
                        </nav>
                        <!-- /.social -->
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->
                <div class="col-md-4 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title text-white mb-3">Get in Touch</h4>
                        <address class="pe-xl-15 pe-xxl-17">Moonshine St. 14/05 Light City, London, United Kingdom</address>
                        <a href="mailto:#">info@email.com</a><br /> 00 (123) 456 78 90
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->
                <div class="col-md-4 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title text-white mb-3">Learn More</h4>
                        <ul class="list-unstyled  mb-0">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Our Story</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->
                <div class="col-md-12 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title text-white mb-3">Our Newsletter</h4>
                        <p class="mb-5">Subscribe to our newsletter to get our news & deals delivered to you.</p>
                        <div class="newsletter-wrapper">
                            <!-- Begin Mailchimp Signup Form -->
                            <div id="mc_embed_signup2">
                                <form action="https://elemisfreebies.us20.list-manage.com/subscribe/post?u=aa4947f70a475ce162057838d&amp;id=b49ef47a9a" method="post" id="mc-embedded-subscribe-form2" name="mc-embedded-subscribe-form" class="validate dark-fields" target="_blank" novalidate>
                                    <div id="mc_embed_signup_scroll2">
                                        <div class="mc-field-group input-group form-floating">
                                            <input type="email" value="" name="EMAIL" class="required email form-control" placeholder="Email Address" id="mce-EMAIL2">
                                            <label for="mce-EMAIL2">Email Address</label>
                                            <input type="submit" value="Join" name="subscribe" id="mc-embedded-subscribe2" class="btn btn-primary ">
                                        </div>
                                        <div id="mce-responses2" class="clear">
                                            <div class="response" id="mce-error-response2" style="display:none"></div>
                                            <div class="response" id="mce-success-response2" style="display:none"></div>
                                        </div> <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_ddc180777a163e0f9f66ee014_4b1bcfa0bc" tabindex="-1" value=""></div>
                                        <div class="clear"></div>
                                    </div>
                                </form>
                            </div>
                            <!--End mc_embed_signup-->
                        </div>
                        <!-- /.newsletter-wrapper -->
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </footer>
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <script src="<?= base_url('assets') ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="<?= base_url('assets/front') ?>/js/plugins.js"></script>
    <script src="<?= base_url('assets/front') ?>/js/theme.js"></script>
    <script>
        $(document).ready(function() {
            console.log('<?= current_url() ?>');
            $(".nav-menu").find("[href='<?= current_url() ?>']").addClass('active')
        });

        function dangerToast(message) {
            Toastify({
                'text': message,
                style: {
                    background: '#fd2e64',
                }
            }).showToast()
        }

        function successToast(message) {
            Toastify({
                'text': message,
            }).showToast()
        }
    </script>
    <?php if (session()->has('message')) : ?>
        <script>
            <?= session('message') ?>
        </script>
    <?php endif; ?>
</body>

</html>