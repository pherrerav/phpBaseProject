<?php $this->load->view('includes/header.php') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Usuarios</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Seguridad</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="DataTables" class="table table-bordered table-striped display compact">
                                <thead>
                                    <tr>
                                        <th>Estado</th>
                                        <th>Usuario</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Fecha Ingreso</th>
                                        <th>Perfil</th>
                                        <th>Estado</th>
                                        <th>UsuarioId</th>
                                        <th>Comandos</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div class="modal fade bs-example-modal-lg" id="usuarioModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Datos del Usuarios</h5>
                                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" role="form" id="userForm" name="userForm" class="form-horizontal">
                                                <div class="group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="usuario"> Usuario </label>
                                                    <div class="col-sm-4">
                                                        <input type="hidden" name="usuarioId" id="usuarioId">
                                                        <input type="text" id="usuario" name="usuario" maxlength="20" placeholder="Usuario" class="form-control" />
                                                        <?php echo form_error('usuario'); ?>
                                                        <label for="usuario" class="validation_error_message help-block"></label>
                                                    </div>
                                                </div>
                                                <div class="group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="nombre"> Nombre </label>
                                                    <div class="col-sm-6">
                                                        <input type="text" id="nombre" name="nombre" maxlength="50" placeholder="Nombre" class="form-control" />
                                                        <?php echo form_error('nombre'); ?>
                                                        <label for="nombre" class="validation_error_message help-block"></label>
                                                    </div>
                                                </div>
                                                <div class="group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="apellidos"> Apellidos </label>
                                                    <div class="col-sm-6">
                                                        <input type="text" id="apellidos" name="apellidos" maxlength="50" placeholder="Apellidos" class="form-control" />
                                                        <?php echo form_error('apellidos'); ?>
                                                        <label for="apellidos" class="validation_error_message help-block"></label>
                                                    </div>
                                                </div>
                                                <div class="group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="fechaIngreso"> Fecha Ingreso </label>
                                                    <div class="col-sm-6">
                                                        <input type="text" id="fechaIngreso" name="fechaIngreso" placeholder="Fecha Ingreso" class="form-control" />
                                                        <?php echo form_error('fechaIngreso'); ?>
                                                        <label for="fechaIngreso" class="validation_error_message help-block"></label>
                                                    </div>
                                                </div>
                                                <div class="group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="perfiles"> Perfiles </label>
                                                    <div class="col-sm-4">
                                                        <select id="perfiles" name="perfiles" class="form-control" data-placeholder="Click to Choose...">
                                                            <option value="">Perfiles</option>
                                                            <?php
                                                            if (isset($perfiles))
                                                                foreach ($perfiles as $row) {
                                                                    echo '<OPTION VALUE="' . $row['perfilId'] . '">' . $row['perfilNombre'] . '</OPTION>';
                                                                }
                                                            ?>
                                                        </select>
                                                        <?php echo form_error('perfiles'); ?>
                                                        <label for="perfiles" class="validation_error_message help-block"></label>
                                                    </div>
                                                </div>
                                                <div class="group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="perfiles"> Estado </label>
                                                    <div class="col-sm-4">
                                                        <select id="estado" name="estado" class="form-control">
                                                            <option value="1">Activo</option>
                                                            <option value="0">Inactivo</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>
                                                <div align="right">
                                                    <input type="submit" id="btnGuardar" value="Guardar" class="btn btn-success">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    APP.usuarios.init();
</script>