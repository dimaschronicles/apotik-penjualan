<?= $this->extend('layout/templates'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Transaksi Obat</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="row">
            <div class="col mr-3 ml-3">
                <?= session()->getFlashdata('message'); ?>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form action="/transaksi/addcart" method="POST">
                <?= csrf_field(); ?>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_obat">Nama Obat</label>
                                    <select class="form-control <?= ($validation->hasError('nama_obat')) ? 'is-invalid' : ''; ?>" id="nama_obat" name="nama_obat">
                                        <option value="">=== Pilih Obat ===</option>
                                        <?php foreach ($obat as $o) : ?>
                                            <option value="<?= $o['id_obat']; ?>"><?= $o['nama_obat']; ?> - <?= number_format($o['harga'], 2, ',', '.') ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_obat'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_beli">Jumlah</label>
                                    <input type="number" class="form-control <?= ($validation->hasError('jumlah_beli')) ? 'is-invalid' : ''; ?>" id="jumlah_beli" name="jumlah_beli" placeholder="Masukan jumlah...">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_pembeli'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_pembeli">Nama Pembeli</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('nama_pembeli')) ? 'is-invalid' : ''; ?>" id="nama_pembeli" name="nama_pembeli" placeholder="Masukan nama pembeli...">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_pembeli'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Keranjang</button>
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <?php if (!empty($cart)) : ?>
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Pembeli</th>
                                        <th scope="col">Nama Obat</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Sub Total</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($cart as $c) : ?>
                                        <tr>
                                            <th scope="row"><?= $i++; ?></th>
                                            <td><?= $c['nama_pembeli']; ?></td>
                                            <td><?= $c['nama_obat']; ?></td>
                                            <td><?= $c['jumlah_keluar']; ?></td>
                                            <td>Rp <?= number_format($c['harga'], 2, ',', '.') ?></td>
                                            <td>Rp <?= number_format($c['sub_total'], 2, ',', '.') ?></td>
                                            <td>
                                                <a href="/transaksi/deletecart/<?= $c['id_transaksi']; ?>" class="btn btn-danger" onclick="return confirm('Apakah data ini akan dihapus?')">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="5" style="text-align: right;"><strong>Total Harga</strong></td>
                                        <td colspan="2">Rp <?= number_format($total['sub_total'], 2, ',', '.') ?></td>
                                    </tr>
                                <?php else : ?>
                                    Data tidak tersedia.
                                <?php endif; ?>
                                </tbody>
                            </table>
                            <?php if (!empty($cart)) : ?>
                                <form action="/transaksi/savecart" method="POST">
                                    <?= csrf_field(); ?>
                                    <?php foreach ($cart as $c) : ?>
                                        <input type="hidden" name="nama_pembeli" value="<?= $c['nama_pembeli']; ?>">
                                    <?php endforeach; ?>
                                    <button type="submit" class="btn btn-success">Simpan Penjualan</button>
                                </form>
                            <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>