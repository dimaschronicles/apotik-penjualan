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
                        <li class="breadcrumb-item active">Profile</li>
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
                <div class="col-md-4">
                    <div class="message my-1">
                        <?= session()->getFlashdata('message'); ?>
                    </div>
                    <div class="card text-center">
                        <div class="img mt-5">
                            <img src="/img/user.png" class="img-thumbnail rounded-circle" width="200px">
                        </div>
                        <div class="card-body">
                            <hr>
                            <h5 class="card-text"><?= $user['nama'] ?></h5>
                            <p class="card-text"><?= $user['email'] ?> | <?= $user['no_hp'] ?></p>
                            <a href="/editprofile" class="btn btn-primary">Edit Profil</a>
                            <a href="/changepassword" class="btn btn-danger">Ganti Password</a>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection(); ?>