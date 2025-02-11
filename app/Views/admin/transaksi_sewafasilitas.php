<?= $this->extend('layout_admin') ?>
<?= $this->section('content'); ?>
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><?= $title ?></div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="bx bx-home-alt"></i></a>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/transaksi-fasilitas') ?>">Transaksi Fasilitas</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Sewa</li>
            </ol>
        </nav>
    </div>
</div>
<h6 class="mb-0 text-uppercase">Sewa Fasilitas</h6>
<hr />
<div class="row d-flex justify-content-center">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Form Sewa</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-4">
                    <label for="fasilitas_id">Pilih Fasilitas</label>
                    <select class="form-select <?= (isset(session('errors')['fasilitas_id'])) ? 'is-invalid' : '' ?>" id="fasilitas" name="fasilitas_id">
                        <option value="">Pilih Fasilitas</option>
                        <?php foreach ($fasilitas as $row) : ?>
                            <option data-id="<?= $row->fasilitas_id ?>" data-harga="<?= $row->harga_sewa ?>" data-nama="<?= $row->nama_fasilitas ?>"><?= $row->nama_fasilitas ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['fasilitas_id'])) : ?>
                            <?= session('errors')['fasilitas_id'] ?>
                        <?php endif; ?>
                    </div>

                </div>
                <div class="form-group mb-4">
                    <label for="jumlah">Jumlah</label>
                    <input type="text" class="form-control <?= (isset(session('errors')['jumlah'])) ? 'is-invalid' : '' ?>" id="jumlah" name="jumlah" value="<?= old('jumlah') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['jumlah'])) : ?>
                            <?= session('errors')['jumlah'] ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="durasi">Durasi (Jam)</label>
                    <input type="text" class="form-control <?= (isset(session('errors')['durasi'])) ? 'is-invalid' : '' ?>" id="durasi" name="durasi" value="<?= old('durasi') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['durasi'])) : ?>
                            <?= session('errors')['durasi'] ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" id="tambahbtn" class="btn btn-primary">Tambah</button>
                </div>
            </div>

        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Daftar Order</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Fasilitas</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Durasi</th>
                                <th>SubTotal</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <form action="<?= base_url('admin/sewa') ?>" method="post" id="formOrder">
                    <button type="submit" class="btn btn-primary mt-4">Proses Order</button>
                </form>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script>
    $('#tambahbtn').on('click', function(event) {
        console.log('Here');
        var id = $('#fasilitas option:selected').data('id');
        var harga = $('#fasilitas option:selected').data('harga');
        var nama = $('#fasilitas option:selected').data('nama');

        var jumlah = $('#jumlah').val();
        var durasi = $('#durasi').val();

        var markup = "<tr><td>" + nama + "</td><td>" + harga + "</td><td>" + jumlah + "</td><td>" + durasi + "</td><td>" + (durasi * jumlah * harga) + "</td></tr>"
        $("table tbody").append(markup)

        $("<input type='hidden' value='" + id + "' />")
            // .attr("id", "")
            .attr("name", "fasilitas[]")
            .appendTo("#formOrder");
        $("<input type='hidden' value='" + jumlah + "' />")
            // .attr("id", "")
            .attr("name", "jumlah[]")
            .appendTo("#formOrder");
        $("<input type='hidden' value='" + durasi + "' />")
            // .attr("id", "")
            .attr("name", "durasi[]")
            .appendTo("#formOrder");
        $("<input type='hidden' value='" + harga + "' />")
            // .attr("id", "")
            .attr("name", "harga[]")
            .appendTo("#formOrder");

    });
</script>
<?= $this->endSection(); ?>