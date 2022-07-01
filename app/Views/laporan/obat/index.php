<?= $this->extend('layout/templates'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Obat</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section>
        <div class="row">
            <div class="col mr-3 ml-3">
                <?= session()->getFlashdata('message'); ?>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Filter Laporan Per Tanggal
                        </div>
                        <div class="card-body">
                            <form action="/laporan" method="GET">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="id_obat">Nama Obat</label>
                                            <select class="form-control" id="id_obat" name="id_obat" required>
                                                <option value="">=== Pilih Obat ===</option>
                                                <?php foreach ($idObat as $o) : ?>
                                                    <?php if ($o['stok'] > 1) : ?>
                                                        <option value="<?= $o['id_obat']; ?>" <?= (old('id_obat') == $o['id_obat']) ? 'selected' : ''; ?>><?= $o['nama_obat']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dari_tanggal">Dari Tanggal</label>
                                            <input type="date" class="form-control" id="dari_tanggal" name="dari_tanggal" value="<?= old('dari_tanggal') ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sampai_tanggal">Sampai Tanggal</label>
                                            <input type="date" class="form-control" id="sampai_tanggal" name="sampai_tanggal" value="<?= old('sampai_tanggal') ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Tampilkan Data</button>
                                        <a href="/laporan" class="btn btn-secondary">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php if ($obat == '') : ?>
                        <div class="card">
                            <div class="card-body">
                                Silahkan isikan datanya terlebih dahulu.
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="card">
                            <div class="card-header">
                                Hasil
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <a href="/obatpdf?id_obat=<?= @$_GET['id_obat']; ?>&dari_tanggal=<?= @$_GET['dari_tanggal']; ?>&sampai_tanggal=<?= @$_GET['sampai_tanggal']; ?>" target="_blank" class="btn btn-success mb-3"><i class="fas fa-file"></i> Cetak Laporan</a>
                                <table id="example" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Obat</th>
                                            <th>No Batch</th>
                                            <th>Masuk</th>
                                            <th>Keluar</th>
                                            <th>Sisa</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($obat as $o) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $o['nama_obat']; ?></td>
                                                <td><?= $o['no_batch']; ?></td>
                                                <td><?= ($o['jumlah_masuk'] == null) ? '-' : $o['jumlah_masuk']; ?></td>
                                                <td><?= ($o['jumlah_keluar'] == null) ? '-' : $o['jumlah_keluar']; ?></td>
                                                <td><?= $o['jumlah_sisa']; ?></td>
                                                <td><?= $o['tanggal_transaksi']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Obat</th>
                                            <th>No Batch</th>
                                            <th>Masuk</th>
                                            <th>Keluar</th>
                                            <th>Sisa</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    <?php endif; ?>
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection(); ?>