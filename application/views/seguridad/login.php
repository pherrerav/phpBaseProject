<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo base_url('assets/dist/images/imagenWR.png') ?>">
    <title>Consultores | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/librerias/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/adminlte.min.css') ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <div align="center">
                    <img src="<?php echo base_url('assets/dist/images/logoWR.png') ?>" alt="Logo">
                </div>
                <br>
                <form id="loginForm" name="loginForm" method="post" role="form">
                    <label class="col-sm-3 control-label no-padding-right" for="usuario"> Usuario </label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <?php echo form_error('usuario'); ?>
                    <label for="usuario" class="validation_error_message help-block danger"></label>
                    <label class="col-sm-3 control-label no-padding-right" for="usuario"> Clave </label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="Clave">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <?php echo form_error('clave'); ?>
                    <label for="clave" class="validation_error_message help-block danger"></label>
                    <div class="row" align="center">
                        <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    <script>
        var base_url = '<?php echo base_url() ?>';
        let APP = window || {};
    </script>
    <script src="<?php echo base_url('assets/dist/authentication.js') ?>"></script>
    <script src="<?php echo base_url('assets/dist/librerias/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/dist/adminlte.min.js') ?>"></script>
</body>

</html>