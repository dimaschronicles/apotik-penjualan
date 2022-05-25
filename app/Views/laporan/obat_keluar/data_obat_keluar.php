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
                            <form action="/laporanobatkeluar" method="GET">
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
                                        <button type="submit" class="btn btn-primary">Tampilkan Data</button>
                                        <a href="/laporanobatmasuk" class="btn btn-secondary">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php if ($obat == '') : ?>
                        <div class="card">
                            <div class="card-body">
                                Silahkan isikan tanggalnya terlebih dahulu.
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="card">
                            <div class="card-header">
                                Hasil
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <a href="/obatkeluarpdf?dari_tanggal=<?= @$_GET['dari_tanggal']; ?>&sampai_tanggal=<?= @$_GET['sampai_tanggal']; ?>" target="_blank" class="btn btn-success mb-3"><i class="fas fa-file"></i> Cetak Laporan</a>
                                <table id="example" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Batch</th>
                                            <th>Nama Obat</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($obat as $o) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $o['no_batch']; ?></td>
                                                <td><?= $o['nama_obat']; ?></td>
                                                <td><?= $o['jumlah_keluar']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>No Batch</th>
                                            <th>Nama Obat</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
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