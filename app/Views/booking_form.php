<?php for ($i = 0; $i < $jumlah; $i++) : ?>
    <h3 class="mb-4">Pesanan <?= $i + 1 ?></h3>
    <div class="col-12" id="error<?= $i ?>" hidden>
        <div class="alert alert-danger alert-icon mb-6" role="alert">
            <i class="uil uil-exclamation-circle"></i> Jadwal sudah ada!
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="date" class="form-control" id="tanggal" placeholder="Pilih Tanggal" min="<?= date('Y-m-d'); ?>" name="tanggal[]" required>
            <label for="tanggal" class="form-label">Pilih Tanggal</label>
            <div class="invalid-feedback"> </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-floating">
            <input type="text" class="form-control time-picker" id="jamMulai" placeholder="Last name" value="" name="waktu_mulai[]" required>
            <label for="jamMulai" class="form-label">Jam Mulai</label>
            <div class="invalid-feedback"> </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-floating">
            <input type="number" class="form-control durasi" id="durasi" name="durasi[]" required>
            <label for="durasi" class="form-label">Durasi (Jam)</label>
            <div class="invalid-feedback"> </div>
        </div>
    </div>

<?php endfor; ?>