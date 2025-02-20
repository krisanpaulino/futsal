<?= $this->extend('layout_front') ?>
<?= $this->section('content'); ?>
<section class="wrapper bg-gray">
    <div class="container py-3 py-md-5">
        <nav class="d-inline-block" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
                <li class="breadcrumb-item active text-muted" aria-current="page">Pesanan Saya</li>
            </ol>
        </nav>
        <!-- /nav -->
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col-md-10 col-xl-8 mx-auto">
                <div class="post-header">
                    <!-- /.post-category -->
                    <h1 class="display-1 mb-4">Daftar Pesanan Saya</h1>
                    <!-- /.post-meta -->
                </div>
                <!-- /.post-header -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>

    <!-- /.container -->
</section>
<!-- /section -->
<section class="wrapper bg-light">
    <div class="container pt-12 pt-md-14 pb-14 pb-md-16">
        <div class="row gx-md-8 gx-xl-12 gy-12">
            <div class="col-lg-8">
                <div class="table-responsive">
                    <table class="table text-center shopping-cart">
                        <thead>
                            <tr>
                                <th class="ps-0 w-25">
                                    <div class="h4 mb-0 text-start">Waktu Transaksi</div>
                                </th>
                                <th>
                                    <div class="h4 mb-0">Harga</div>
                                </th>
                                <th>
                                    <div class="h4 mb-0">Status Pembayaran</div>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transaksi as $row) : ?>
                                <tr>
                                    <td>
                                        <div class="text-start">
                                            <h3 class="h6 lh-xs mb-1"><?= $row->tanggal_pesan ?></h3>
                                            <div class="small">Jumlah Booking : <?= $row->jumlah_jadwal ?></div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="price"><span class="amount">Rp <?= number_format($row->total_bayar) ?></span></p>
                                    </td>
                                    <td>
                                        <p class="price"><span class="amount"><?= $row->status ?></span></p>
                                    </td>
                                    <td class="pe-0">
                                        <a href="#" data-id="<?= $row->transaksi_id ?>" class="link-info det">Detail</a>
                                        <?php if ($row->status == 'Belum Bayar') : ?>
                                            <br> <a href="#" data-bs-toggle="modal" data-bs-target="#bayar" data-id="<?= $row->transaksi_id ?>" class="link-warning">Bayar</a>
                                        <?php else : ?>
                                            <br> <a href="<?= base_url('assets/img/bayar/' . $row->bukti_bayar) ?>" target="_blank" class="link-primary">Lihat Bukti</a>
                                        <?php endif ?>
                                        <?php if ($row->jumlah_selesai > 0 && $row->feedback_id == null) : ?>
                                            <br> <a href="#" data-bs-toggle="modal" data-bs-target="#feedback" data-id="<?= $row->transaksi_id ?>" class="link-warning">Berikan Feedback</a>
                                        <?php endif ?>
                                        <?php if ($row->feedback_id != null) : ?>
                                            <br> <a href="#" data-bs-toggle="modal" data-bs-target="#feedback" data-id="<?= $row->transaksi_id ?>" class="link-warning">Lihat Feedback</a>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /column -->
            <div class="col-lg-4" id="showDetail">

            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Upload Bukti Bayar</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form" action="<?= base_url('bayar') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="transaksi_id" id="kodeitem" value="">
                <div class="modal-body">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="file" class="form-control" id="file" placeholder="Pilih Tanggal" min="<?= date('Y-m-d'); ?>" name="file" required>
                            <label for="file" class="form-label">Bukti Bayar</label>
                            <div class="invalid-feedback"> </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Upload Bukti</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="feedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="feedback-content">

        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script>
    $('#bayar').on('show.bs.modal', function(event) {
        var kode = $(event.relatedTarget).data('id');
        $(this).find('#kodeitem').attr("value", kode);
    });
    $('#feedback').on('show.bs.modal', function(event) {
        var id = $(event.relatedTarget).data('id');
        $('#feedback-content').children().remove()
        $('#feedback-content').append('<div class="loader"></div>')
        $.ajax({
            url: '<?= base_url('ajax/get-feedback') ?>',
            type: 'POST',
            data: {
                id: id
            },
            success: function(data) {
                if (!jQuery.isEmptyObject(data)) {
                    $('#feedback-content').children().remove()
                    $('#feedback-content').append(data);
                } else {
                    $('#feedback-content').children().remove()
                    dangerToast('Tidak ada data')
                }
            },
            error: function(e) {
                console.log(e);
                $('#feedback-content').children().remove()
                dangerToast('gagal mengambil data')
            },
            dataType: "json"
        });
    });
    $('.det').on('click', function(event) {
        var id = $(event.currentTarget).data('id');
        $('#showDetail').children().remove()
        $('#showDetail').append('<div class="loader"></div>')
        $.ajax({
            url: '<?= base_url('ajax/detail-transaksi') ?>',
            type: 'POST',
            data: {
                id: id
            },
            success: function(data) {
                if (!jQuery.isEmptyObject(data)) {
                    $('#showDetail').children().remove()
                    $('#showDetail').append(data);
                } else {
                    $('#showDetail').children().remove()
                    dangerToast('Tidak ada data')
                }
            },
            error: function(e) {
                console.log(e);
                $('#showDetail').children().remove()
                dangerToast('gagal mengambil data')
            },
            dataType: "json"
        });
    });
</script>
<?= $this->endSection(); ?>