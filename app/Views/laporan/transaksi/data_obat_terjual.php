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
                            <form action="/laporan/sell" method="GET">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dari_tanggal">Dari Tanggal</label>
                                            <input type="date" class="form-control" id="dari_tanggal" name="dari_tanggal" value="<?= old('dari_tanggal') ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sampai_tanggal">Sampai Tanggal</label>
                                            <input type="date" class="form-control" id="sampai_tanggal" name="sampai_tanggal" value="<?= old('sampai_tanggal') ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-eye"></i> Tampilkan Filter Data</button>
                                        <a href="/laporan/sell" class="btn btn-secondary"><i class="fas fa-sync-alt"></i> Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <a href="/laporan/sellpdf" target="blank" class="btn btn-danger"><i class="fas fa-file"></i> Cetak Semua Data PDF</a>
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
                                Filter Data
                            </div>
                            <div class="card-body">
                                <a href="/laporan/sellpdfdate?dari_tanggal=<?= @$_GET['dari_tanggal']; ?>&sampai_tanggal=<?= @$_GET['sampai_tanggal']; ?>" target="blank" class="btn btn-danger"><i class="fas fa-file"></i> Cetak Filter Data PDF</a>
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Obat</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Sub Total</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($obat as $o) : ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $o['nama_obat']; ?></td>
                                                    <td>Rp <?= number_format($o['harga'], 2, ',', '.') ?></td>
                                                    <td><?= $o['jumlah_keluar']; ?></td>
                                                    <td>Rp <?= number_format($o['sub_total'], 2, ',', '.') ?></td>
                                                    <td><?= $o['tanggal_keluar']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Obat</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Sub Total</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection(); ?>