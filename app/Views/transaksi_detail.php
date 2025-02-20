                <h3 class="mb-4">Detail Pesanan</h3>
                <div class="table-responsive">
                    <?php if ($show != null) : ?>
                        <table class="table table-order">
                            <tbody>
                                <?php foreach ($show as $key => $row) : ?>
                                    <tr>
                                        <td class="ps-0"><strong class="text-dark">Pesanan <?= $key + 1 ?></strong></td>
                                        <td class="pe-0 text-end">
                                            <div class="small">Tanggal: <span><?= $row->tanggal ?></span></div>
                                            <div class="small">Jam: <span><?= $row->waktu_mulai ?></span></div>
                                            <div class="small">Sampai: <span><?= $row->waktu_selesai ?></span></div>
                                            <p class="price text-dark fw-bold">Jadwal : Rp <?= number_format($row->harga) ?></p>
                                        </td>
                                    </tr>
                                    <?php
                                    $fasilitas = getSewaFasilitas($row->jadwal_id);
                                    $totalfasilitas = 0;
                                    ?>
                                    <?php if ($fasilitas != null) : ?>
                                        <tr>
                                            <td colspan="2"><strong class="text-dark">Fasilitas yang disewa</strong></td>
                                        </tr>
                                        <?php foreach ($fasilitas as $key => $row) : ?>
                                            <?php $totalfasilitas += $row->harga_sewa ?>
                                            <tr>
                                                <td colspan="2" class="pe-0">
                                                    <div class="small"><span><?= $row->nama_fasilitas ?></span></div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                        <tr class="pe-0 text-end">
                                            <td colspan="2">
                                                <p class="price text-dark fw-bold">Fasilitas : Rp <?= number_format($totalfasilitas) ?></p>
                                            </td>
                                        </tr>
                                    <?php endif ?>
                                <?php endforeach ?>

                            </tbody>
                        </table>
                    <?php else : ?>
                        <p class="price text-danger">Tidak ada data.</p>
                        </p>

                    <?php endif ?>
                </div>