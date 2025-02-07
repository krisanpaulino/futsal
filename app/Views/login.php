<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="<?= base_url('assets') ?>/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="<?= base_url('assets') ?>/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?= base_url('assets') ?>/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?= base_url('assets') ?>/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="<?= base_url('assets') ?>/css/pace.min.css" rel="stylesheet" />
    <script src="<?= base_url('assets') ?>/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets') ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/css/app.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/css/icons.css" rel="stylesheet">
    <title>Login | Futsal</title>
</head>

<body class="">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="p-4">
                                    <div class="mb-3 text-center">
                                        <div class="font-30 text-primary"> <i class="fadeIn animated bx bx-football"></i>
                                        </div>
                                    </div>
                                    <div class="text-center mb-4">
                                        <h5 class="">Indah Futsal Kupang</h5>
                                        <p class="mb-0">Silahkan login dengan akun anda</p>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" action="<?= base_url('login') ?>" method="post">
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="inputEmailAddress" name="username" placeholder="jhon@example.com">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="user_password" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-6 text-end"> <a href="authentication-forgot-password.html">Forgot Password ?</a>
                                            </div> -->
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Log in</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center ">
                                                    <p class="mb-0">Belum punya akun? <a href="<?= base_url('sign-up') ?>">Daftar disini</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="<?= base_url('assets') ?>/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="<?= base_url('assets') ?>/js/jquery.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="<?= base_url('assets') ?>/js/app.js"></script>
</body>

</html>