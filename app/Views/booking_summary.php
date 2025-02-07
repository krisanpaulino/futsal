<div class="card">
    <div class="card-body">
        <h3 class="mb-4">Order Summary</h3>
        <hr class="mt-7 mb-6">
        <div class="shopping-cart mb-7">
            <?php for ($i = 0; $i < $jumlah; $i++) : ?>
                <div class="shopping-cart-item d-flex justify-content-between mb-4">
                    <div class="d-flex flex-row d-flex align-items-center">
                        <div class="w-100 ms-4">
                            <h3 class="post-title h6 lh-xs mb-1">Pesanan <?= $i + 1 ?></h3>
                            <div class="small">Jam: <span id="jam<?= $i ?>"></span></div>
                            <div class="small">Durasi: <span id="durasi<?= $i ?>"></span></div>
                        </div>
                    </div>
                    <div class="ms-2 d-flex align-items-center">
                        <p class="price fs-sm"><span class="amount">Rp <span id="total<?= $i ?>">0</span></span></p>
                    </div>
                </div>
            <?php endfor ?>
            <!--/.shopping-cart-item -->
            <!--/.shopping-cart-item -->
        </div>
        <!-- /.shopping-cart-->
        <hr class="my-4">
        <div class="table-responsive">
            <table class="table table-order">
                <tbody>
                    <tr>
                        <td class="ps-0"><strong class="text-dark">Total Rp</strong></td>
                        <td class="pe-0 text-end">
                            <p class="price text-dark fw-bold" id="sumtotal"></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button type="button" value="Pesan Sekarang" id="submitBtn" class="btn btn-primary rounded w-100 mt-4">Pesan Sekarang</button>
    </div>
</div>