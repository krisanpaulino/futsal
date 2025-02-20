<?= $this->extend('layout_front') ?>
<?= $this->section('content'); ?>

<!-- /section -->

<section class="wrapper bg-soft-primary">
    <div class="container pt-12 pt-10 pb-20 pt-md-14 pb-md-19 text-center">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <h1 class="display-1 mb-3">Booking Lapangan</h1>
            </div>
            <!-- /column -->
        </div>
        <div class="col-lg-12">
            <p class="text-start mb-2">Cek ketersediaan lapangan disini.</p>
            <div id="accordion-1" class="accordion-wrapper col-lg-12">
                <div class="card accordion-item">
                    <div class="card-header" id="accordion-heading-1-1">
                        <button type="button" class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-1-1" aria-expanded="false" aria-controls="accordion-collapse-1-1">Jadwal lapangan sudah dipesan</button>
                    </div>
                    <!-- /.card-header -->
                    <div id="accordion-collapse-1-1" class="collapse" aria-labelledby="accordion-heading-1-1" data-bs-target="#accordion-1">
                        <div class="card-body">
                            <table class="table mb-0 small">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Pelanggan</th>
                                        <th>Tanggal Main</th>
                                        <th>Mulai</th>
                                        <th>Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($jadwal as $row) : ?>
                                        <tr>
                                            <td class="p-0">
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-2">
                                                        <?= $row->pelanggan_nama ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-0"><?= $row->tanggal ?></td>
                                            <td class="p-0"><?= $row->waktu_mulai ?></td>
                                            <td class="p-0"><?= $row->waktu_selesai ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.collapse -->
                </div>
            </div>
            <!-- <hr class="mt-7 mb-6"> -->
        </div>
        <!-- /column -->
        <!-- /column -->
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>

<section class="wrapper bg-light">
    <div class="container pt-12 pt-md-14 pb-14 pb-md-16">
        <form action="<?= base_url('booking') ?>" id="form1" method="post">
            <div class="pricing-wrapper position-relative mt-n18 mt-md-n21 mb-12 mb-md-15">
                <div class="shape bg-dot primary rellax w-16 h-18" data-rellax-speed="1" style="top: -1.5rem; right: -2.4rem;"></div>
                <div class="shape rounded-circle bg-line red rellax w-18 h-18 d-none d-lg-block" data-rellax-speed="1" style="bottom: -1.5rem; left: -2.5rem;"></div>
                <div class="row gy-6 mt-3 mt-md-5">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="mb-4">Booking Lapangan</h3>
                                <hr class="mt-7 mb-6">

                                <div class="row g-3">
                                    <div class="col-sm-9 form-inline" id="choose">
                                        <div class="form-floating form-group">
                                            <input type="number" class="form-control" id="sesi" placeholder="First name" value="" required>
                                            <label for="sesi" class="form-label">Jumlah Sesi</label>
                                            <div class="invalid-feedback"> </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" id="execute" class="btn btn-primary rounded w-100 mt-4 align-top">Buat Pesanan</button>
                                        </div>
                                    </div>
                                    <div id="forms" class="row g-3">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /column -->
                    <div class="col-lg-4" id="summary">

                    </div>
                </div>
                <!-- /column -->
            </div>
        </form>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script>
    $(".time-picker").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
    });
    $('#execute').on('click', function(e) {
        var jumlah = $('#sesi').val()
        if (jumlah > 0) {
            $('#choose').remove();

            $.ajax({
                url: '<?= base_url('ajax/booking-form') ?>',
                type: 'POST',
                data: {
                    count: jumlah
                },
                success: function(data) {

                    $('#forms').append(data.form);
                    $('#summary').append(data.summary);
                    $("body .time-picker").flatpickr({
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        time_24hr: true,
                    });
                },
                error: function(e) {
                    console.log(e);

                },
                dataType: "json"
            });
        } else {
            $('#forms').children().remove();
            $('#summary').children().remove();
        }
    })

    $('body').on('change', '#durasi', function(e) {
        var dur = $('body #durasi').map(function() {
            return $(this).val();
        }).get();
        var total = 0;
        $.each(dur, function(key, val) {
            var fas = $('body #fasilitas[data-transaksi="' + key + '"]:checked').map(function() {
                return $(this);
            }).get();
            var totalfasilitas = 0;
            $('body #durasi' + key).text(val);
            var totaldurasi = <?= $lapangan->harga_sewa ?> * val //totaldurasi
            var out = (totaldurasi / 1000).toFixed(3)
            $('body #totaldurasi' + key).text(out);

            $.each(fas, function(index, row) {
                // console.log(val);

                totalfasilitas += val * row.data("harga")
            })
            var subtotal = totaldurasi + totalfasilitas
            total += subtotal
            $('body #totalfasilitas' + key).text((totalfasilitas / 1000).toFixed(3))
            $('body #error' + key).attr('hidden', true)
        });
        var totalout = (total / 1000).toFixed(3);
        $('body #sumtotal').text(totalout);
    })
    $('body').on('change', '#jamMulai', function(e) {
        var jam = $('body #jamMulai').map(function() {
            return $(this).val();
        }).get();
        // console.log(jam);

        $.each(jam, function(key, val) {
            $('body #jam' + key).text(val)
            $('body #error' + key).attr('hidden', true)
        });
    })

    //Fasilitas
    $('body').on('change', '#fasilitas', function(e) {
        // var key = $(this).data('transaksi');
        // var fas = $('body #fasilitas[data-transaksi="' + key + '"]:checked').map(function() {
        //     return $(this);
        // }).get();
        // var durasi = parseInt($('#durasi' + key).text())
        // var totalfasilitas = 0;
        // $.each(fas, function(index, row) {
        //     // console.log(val);

        //     totalfasilitas += durasi * row.data("harga")
        // })
        // $('body #totalfasilitas' + key).text((totalfasilitas / 1000).toFixed(3))
        // var subtotal = totalfasilitas
        var dur = $('body #durasi').map(function() {
            return $(this).val();
        }).get();
        var total = 0;
        $.each(dur, function(key, val) {
            var fas = $('body #fasilitas[data-transaksi="' + key + '"]:checked').map(function() {
                return $(this);
            }).get();
            var totalfasilitas = 0;
            $('body #durasi' + key).text(val);
            var totaldurasi = <?= $lapangan->harga_sewa ?> * val //totaldurasi
            var out = (totaldurasi / 1000).toFixed(3)
            $('body #totaldurasi' + key).text(out);

            $.each(fas, function(index, row) {
                // console.log(val);

                totalfasilitas += val * row.data("harga")
            })
            var subtotal = totaldurasi + totalfasilitas
            total += subtotal
            $('body #totalfasilitas' + key).text((totalfasilitas / 1000).toFixed(3))
            $('body #error' + key).attr('hidden', true)
        });
        var totalout = (total / 1000).toFixed(3);
        $('body #sumtotal').text(totalout);

    })

    $('body').on('click', '#submitBtn', function() {
        if ($('body #form1')[0].reportValidity()) {
            var dur = $('body #durasi').map(function() {
                return $(this).val();
            }).get();
            var jam = $('body #jamMulai').map(function() {
                return $(this).val();
            }).get();
            var tanggal = $('body #jadwal_tanggal').map(function() {
                return $(this).val();
            }).get();

            $.each(jam, function(key, val) {
                $.ajax({
                    url: '<?= base_url('ajax/cek-jadwal') ?>',
                    type: 'POST',
                    data: {
                        waktu_mulai: val,
                        durasi: dur[key],
                        tanggal: tanggal[key]
                    },
                    success: function(res) {
                        console.log(res);

                        if (!res)
                            $('body #error' + key).attr('hidden', false)
                        else
                        if ($('body #form1')[0].reportValidity()) {
                            $('body #form1').submit()
                        }
                    },
                    dataType: "json"
                });

            });
        }
    })
</script>
<?= $this->endSection(); ?>