<div class="container">
    <div class="row">
        <div class="col-6">
            <h2 class="">Produk Unggulan</h2>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end"><a href="list-produk.php">
                <span class=" text-primary fw-semibold">Produk Lainnya <i class="fa fa-arrow-right"></i></span>
            </a></div>
    </div>
    <div class="row">
        <?php
        foreach ($data as $row) {
            $gambar = explode(',', $row['gambar'])
        ?>
            <div class="col-lg-4 col-12">
                <div class="card product-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="product-price">Rp. <?= rupiah($row['harga']); ?></div>
                        <div class="product-sale"><?= $row['harga']; ?> Terjual</div>
                    </div>
                    <div class="product-image" style="min-height: 230px;">
                        <img src="admin/assets/images/produk/<?= $gambar[0]; ?>" alt=" <?= $row['nama_produk']; ?>">
                    </div>
                    <div class="product-rating text-end">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <hr>
                    <h4 class="product-name"><?= $row['nama_produk']; ?></h4>
                    <a href="cart.php?id_produk=<?= $row['id_produk']; ?>&quantity=1"><button class="btn w-100 btn-primary">Tambah ke keranjang</button></a>
                    <a href="detail-produk.php?id_produk=<?= $row['id_produk']; ?>"><button class="btn w-100 btn-primary mt-2">Detail Produk</button></a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>