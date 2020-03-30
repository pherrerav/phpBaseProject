<?php $this->load->view('includes/header.php') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Perfiles</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Seguridad</a></li>
                        <li class="breadcrumb-item active">Perfiles</li>
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
                            <table id="DataTables" class="table table-bordered table-striped display compact" width="100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Perfil</th>
                                        <th>Comandos</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div class="modal fade bs-example-modal-lg" id="perfilModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Datos del Perfil</h5>
                                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>

                                        </div>
                                        <div class="modal-body">
                                            <form method="post" role="form" id="frmPerfiles" name="frmPerfiles" class="form-horizontal" action="<?php base_url("Perfilescontroller/agregarPerfil") ?>">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="perfilNombre"> Perfil </label>
                                                    <div class="col-sm-5">
                                                        <input type="text" id="perfilNombre" name="perfilNombre" maxlength="20" placeholder="Perfil" class="form-control" />
                                                        <?php echo form_error('perfil'); ?>
                                                        <input type="hidden" id="perfilId" name="perfilId" />
                                                        <label for="perfilNombre" class="validation_error_message help-block"></label>
                                                    </div>
                                                </div>
                                                <div id="check">
                                                    <?php
                                                    $this->load->view('seguridad/paginas');
                                                    ?>
                                                </div>
                                                <br>
                                                <input type="submit" id="btnGuardar" value="Guardar" class="btn btn-success">
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
    APP.perfiles.init();
</script>