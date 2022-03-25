<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>/lte/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <p><b>Selamat Datang</b> Apotek Buaran</p>
        </div>
        <!-- /.login-logo -->

        <?= session()->getFlashdata('message'); ?>

        <div class="card">
            <div class="card-body">
                <p class="login-box-msg">Silahkan login terlebih dahulu</p>

                <form action="/login/login" method="POST">
                    <?= csrf_field(); ?>
                    <div class="input-group <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?> mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                        </div>
                        <input name="username" type="text" class="input form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" />
                        <div class="invalid-feedback">
                            <?= $validation->getError('username'); ?>
                        </div>
                    </div>
                    <div class="input-group <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?> mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                        </div>
                        <input name="password" type="password" class="input form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" placeholder="password" aria-label="password" aria-describedby="basic-addon1" />
                        <div class="input-group-append">
                            <span class="input-group-text" onclick="password_show_hide();">
                                <i class="fas fa-eye" id="show_eye"></i>
                                <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                            </span>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('password'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <br>

                <p class="mb-1">
                    <a href="">Lupa password?</a>
                </p>
                <p class="mb-0">
                    <a href="/register" class="text-center">Belum punya akun? Daftar disini</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- My Javascript -->
    <script src="<?= base_url(); ?>/js/myscript.js"></script>
    <!-- jQuery -->
    <script src="<?= base_url(); ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>/lte/js/adminlte.min.js"></script>
</body>

</html>