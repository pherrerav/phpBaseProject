<?php $this->load->view('includes/header.php') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Mi Perfil</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Mi Perfil</a></li>
                        <li class="breadcrumb-item active">Mi Perfil</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('assets/dist/images/user.png') ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">
                                <select id="usuarioIdPerfil" name="usuarioIdPerfil" class="form-control">
                                    <?php
                                    if (isset($usuarios))
                                        foreach ($usuarios as $row) {
                                            echo '<OPTION VALUE="' . $row['usuarioId'] . '">' . $row['usuario'] . '</OPTION>';
                                        }
                                    ?>
                                </select>
                            </h3>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Vac. Acumuladas</b> <a class="float-right" id="acumuladas">0</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Vac. Disfrutadas</b> <a class="float-right" id="disfrutadas">0</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Vac. Disponibles</b> <a class="float-right" id="disponibles">0</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#vacaciones" data-toggle="tab">Vacaciones</a></li>
                                <li class="nav-item"><a class="nav-link" href="#incapacidades" data-toggle="tab">Incapacidades</a></li>
                                <li class="nav-item"><a class="nav-link" href="#ausencias" data-toggle="tab">Ausencias</a></li>
                                <li class="nav-item"><a class="nav-link" href="#permisos" data-toggle="tab">Permisos</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="vacaciones">
                                    <div style="overflow-x: auto;">
                                        <table id="tblVacaciones" class="table table-bordered table-striped display compact nowrap" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Estado</th>
                                                    <th>Fecha Inicio</th>
                                                    <th>Fecha Fin</th>
                                                    <th>Total Días</th>
                                                    <th>Solicitante</th>
                                                    <th>Comentario</th>
                                                    <th>Estado</th>
                                                    <th>Id</th>
                                                    <th>UsuarioId</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="incapacidades">
                                    <div style="overflow-x: auto;">
                                        <table id="tblIncapacidades" class="table table-bordered table-striped display compact nowrap" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Estado</th>
                                                    <th>Fecha Inicio</th>
                                                    <th>Fecha Fin</th>
                                                    <th>Total Días</th>
                                                    <th>Horas Primer Día</th>
                                                    <th>Solicitante</th>
                                                    <th>Comentario</th>
                                                    <th>Estado</th>
                                                    <th>Id</th>
                                                    <th>UsuarioId</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="ausencias">
                                    <div style="overflow-x: auto;">
                                        <table id="tblAusencias" class="table table-bordered table-striped display compact nowrap" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Estado</th>
                                                    <th>Fecha Inicio</th>
                                                    <th>Fecha Fin</th>
                                                    <th>Total Días</th>
                                                    <th>Horas Primer Día</th>
                                                    <th>Solicitante</th>
                                                    <th>Comentario</th>
                                                    <th>Estado</th>
                                                    <th>Id</th>
                                                    <th>UsuarioId</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="permisos">
                                    <div style="overflow-x: auto;">
                                        <table id="tblPermisos" class="table table-bordered table-striped display compact nowrap" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Estado</th>
                                                    <th>Fecha Inicio</th>
                                                    <th>Fecha Fin</th>
                                                    <th>Total Días</th>
                                                    <th>Horas Primer Día</th>
                                                    <th>Tipo Permiso</th>
                                                    <th>Tipo Permiso</th>
                                                    <th>Solicitante</th>
                                                    <th>Comentario</th>
                                                    <th>Estado</th>
                                                    <th>Id</th>
                                                    <th>UsuarioId</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- /.control-sidebar -->
<?php $this->load->view('includes/footer.php') ?>
<script>
    APP.miPerfil.init();
</script>