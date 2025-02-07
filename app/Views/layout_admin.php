<!doctype html>
<html lang="en" class="color-sidebar sidebarcolor3">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="<?= base_url() ?>/assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="<?= base_url() ?>/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="<?= base_url() ?>/assets/css/pace.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <?= $this->renderSection('cssplugins'); ?>
    <link href="<?= base_url() ?>/assets/css/app.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/dark-theme.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/semi-dark.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/header-colors.css" />
    <title>Indah Futsal Admin</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                </div>
                <div>
                    <h4 class="logo-text">Indah Futsal Kupang</h4>
                </div>
                <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="<?= base_url('admin') ?>">
                        <div class="parent-icon"><i class='bx bx-home-alt'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/pelanggan') ?>">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-user-circle"></i>
                        </div>
                        <div class="menu-title">Data Pelanggan</div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/lapangan') ?>">
                        <div class="parent-icon"><i class="bx bx-football"></i>
                        </div>
                        <div class="menu-title">Lapangan</div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/fasilitas') ?>">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-user-circle"></i>
                        </div>
                        <div class="menu-title">Data Fasilitas</div>
                    </a>
                </li>
                <li class="menu-label">Transaksi</li>
                <li>
                    <a href="<?= base_url('admin/transaksi') ?>">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-money"></i>
                        </div>
                        <div class="menu-title">Transaksi</div>
                    </a>
                </li>

                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-timer"></i>
                        </div>
                        <div class="menu-title">Jadwal</div>
                    </a>
                    <ul>
                        <li> <a href="<?= base_url('admin/jadwal') ?>"><i class='bx bx-radio-circle'></i>Jadwal Akan Datang</a>
                        </li>
                        <li> <a href="<?= base_url('admin/jadwal/hari-ini') ?>"><i class='bx bx-radio-circle'></i>Hari Ini</a>
                        <li> <a href="<?= base_url('admin/jadwal/selesai') ?>"><i class='bx bx-radio-circle'></i>Selesai</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url('admin/laporan') ?>">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-receipt"></i>
                        </div>
                        <div class="menu-title">Laporan Keuangan</div>
                    </a>
                </li>

                <li class="menu-label">Log</li>
                <li>
                    <a href="<?= base_url('admin/log') ?>">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-file"></i>
                        </div>
                        <div class="menu-title">Log Data</div>
                    </a>
                </li>

            </ul>
            <!--end navigation-->
        </div>
        <!--end sidebar wrapper -->
        <!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand gap-3">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>

                    <div class="user-box dropdown px-3">
                        <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url() ?>assets/images/avatars/admin.png" class="user-img" alt="user avatar">
                            <div class="user-info">
                                <p class="user-name mb-0">Admin</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item d-flex align-items-center" href="<?= base_url('admin/ganti-password') ?>"><i class="bx bx-user fs-5"></i><span>Ganti Password</span></a>
                            <li><a class="dropdown-item d-flex align-items-center" href="<?= base_url('logout') ?>"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <?= $this->renderSection('content'); ?>
            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <!--end overlay-->
        <!--Start Back To Top Button-->
    </div>
    <!--end wrapper-->


    <!--end switcher-->
    <!-- Bootstrap JS -->
    <script src="<?= base_url('assets') ?>/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="<?= base_url('assets') ?>/js/jquery.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/metismenu/js/metisMenu.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <?= $this->renderSection('jsplugins'); ?>
    <!--app JS-->
    <script src="<?= base_url('assets') ?>/js/app.js"></script>
    <?= $this->renderSection('scripts'); ?>
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

        function read(id) {
            // Get the JSON

            $.ajax({
                url: '<?= base_url('ajax/notifikasi/read/') ?>' + id,
                type: 'post',
                success: function(data) {
                    console.log('kenapa ini?');

                    // Retry after a second
                    // setTimeout(doPoll, 5000);
                },
                dataType: "json"
            });
        }

        function doPoll() {
            // Get the JSON
            console.log('here');

            $.ajax({
                url: '<?= base_url('ajax/notifikasi/admin') ?>',
                type: 'post',
                success: function(data) {
                    console.log(data);

                    if (data != null) {
                        // Yeah, there is a new notification! Show it to the user
                        data.forEach(row => {
                            const notification = new Notification(row.notifikasi_isi, {
                                body: row.notifikasi_isi
                            });
                            notification.onclick = function() {
                                window.open('<?= base_url('admin/transaksi') ?>');
                            };
                            console.log('kenapa ini?');
                            read(row.notifikasi_id)
                        });
                    }
                    // Retry after a second
                    setTimeout(doPoll, 1000);
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