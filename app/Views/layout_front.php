<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="elemis">
    <title>Indah Futsal Kupang</title>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/front') ?>/css/colors/violet.css">
    <link rel="preload" href="<?= base_url('assets/front') ?>/css/fonts/dm.css" as="style" onload="this.rel='stylesheet'">
    <link rel="shortcut icon" href="<?= base_url('assets/front') ?>/img/favicon.png">
    <link rel="stylesheet" href="<?= base_url('assets/front') ?>/css/plugins.css">
    <link rel="stylesheet" href="<?= base_url('assets/front') ?>/css/style.css">
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            /* Light grey */
            border-top: 16px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .star-rating {
            direction: rtl;
            display: inline-block;
            cursor: pointer;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #ddd;
            font-size: 24px;
            padding: 0 2px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .star-rating label svg:hover,
        .star-rating label svg:hover~label svg,
        .star-rating input:checked~label svg {
            fill: #ffc107;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <header class="wrapper mb-2 pt-1">
            <nav class="navbar navbar-expand-lg center-nav transparent navbar-light caret-none pt-lg-0">
                <div class="container flex-lg-row flex-nowrap align-items-center">
                    <div class="navbar-brand w-100">
                        <a href="./index.html">
                            <img src="<?= base_url('assets/front') ?>/img/logo-dark.png" srcset="<?= base_url('assets/front') ?>/img/logo-dark@2x.png 2x" alt="" />
                        </a>
                    </div>
                    <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                        <div class="offcanvas-header d-lg-none">
                            <h3 class="text-white fs-30 mb-0">Indah Futsal</h3>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url('jadwal') ?>">Jadwal</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url('booking') ?>">Booking</a></li>
                                <?php if (session()->has('user') && session('user')->user_type == 'pelanggan') : ?>
                                    <li class="nav-item"><a class="nav-link" href="<?= base_url('jadwal-saya') ?>">Jadwal Saya</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?= base_url('pesanan-saya') ?>">Riwayat Booking</a></li>
                                <?php endif ?>
                            </ul>
                            <!-- /.offcanvas-footer -->
                        </div>
                        <!-- /.offcanvas-body -->
                    </div>
                    <!-- /.navbar-collapse -->
                    <div class="navbar-other w-100 d-flex ms-auto">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item">
                                <nav class="nav social social-muted justify-content-end text-end">
                                    <?php if (session()->has('user') && session('user')->user_type == 'pelanggan') : ?>
                                        <a href="<?= base_url('profil') ?>"><i class="uil uil-user"></i></a>
                                    <?php endif ?>
                                    <?php if (session()->has('user')) : ?>
                                        <a href="<?= base_url('logout') ?>"><i class="uil uil-sign-out-alt"></i></a>
                                    <?php endif ?>
                                    <?php if (!session()->has('user')) : ?>
                                        <a href="<?= base_url('auth') ?>"><i class="uil uil-sign-in-alt"></i></a>
                                    <?php endif ?>
                                </nav>
                                <!-- /.social -->
                            </li>
                            <li class="nav-item d-lg-none">
                                <button class="hamburger offcanvas-nav-btn"><span></span></button>
                            </li>
                        </ul>
                        <!-- /.navbar-nav -->
                    </div>
                    <!-- /.navbar-other -->
                </div>
                <!-- /.container -->
            </nav>
            <!-- /.navbar -->
        </header>
        <?= $this->renderSection('content'); ?>
    </div>
    <!-- /.content-wrapper -->
    <?= $this->renderSection('footer'); ?>

    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <script src="<?= base_url('assets') ?>/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="<?= base_url('assets/front') ?>/js/plugins.js"></script>
    <script src="<?= base_url('assets/front') ?>/js/theme.js"></script>
    <?= $this->renderSection('scripts'); ?>
    <script>
        document.querySelectorAll('.star-rating:not(.readonly) label').forEach(star => {
            star.addEventListener('click', function() {
                this.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 200);
            });
        });
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

        function read(id) {
            // Get the JSON

            $.ajax({
                url: '<?= base_url('ajax/notifikasi/read/') ?>/' + id,
                type: 'post',
                success: function(data) {
                    // Retry after a second
                    // setTimeout(doPoll, 5000);
                },
                dataType: "json"
            });
        }

        function doPoll() {
            // Get the JSON

            $.ajax({
                url: '<?= base_url('ajax/notifikasi/pelanggan') ?>',
                type: 'post',
                success: function(data) {

                    if (data != null) {
                        // Yeah, there is a new notification! Show it to the user
                        data.forEach(row => {
                            const notification = new Notification(row.notifikasi_isi, {
                                body: row.notifikasi_isi
                            });
                            notification.onclick = function() {
                                window.open('<?= base_url('pesanan-saya') ?>');
                            };
                            read(row.notifikasi_id)
                        });

                    }
                    // Retry after a second
                    setTimeout(doPoll, 5000);
                },
                dataType: "json"
            });
        }
        if (Notification.permission !== "granted") {
            // Request permission to send browser notifications
            Notification.requestPermission().then(function(result) {
                if (result === 'default') {
                    // Permission granted
                    doPoll();
                }
            });
        } else {
            doPoll();
        }
    </script>
    <?php if (session()->has('message')) : ?>
        <script>
            <?= session('message') ?>
        </script>
    <?php endif; ?>
</body>

</html>