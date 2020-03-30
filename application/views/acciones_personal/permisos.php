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
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<div class="modal fade bs-example-modal-lg" id="permisoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Permisos</h5>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" role="form" id="permisoForm" name="permisoForm" class="form-horizontal">
                    <div class="group">
                        <label class="col-sm-3 control-label no-padding-right" for="usuarioIdAusencia"> Usuario</label>
                        <div class="col-sm-12">
                            <select id="usuarioIdPermiso" name="usuarioIdPermiso" class="form-control" data-placeholder="Click to Choose...">
                                <option value="">Usuarios</option>
                                <?php
                                if (isset($usuarios))
                                    foreach ($usuarios as $row) {
                                        echo '<OPTION VALUE="' . $row['usuarioId'] . '">' . $row['usuario'] . '</OPTION>';
                                    }
                                ?>
                            </select>
                            <?php echo form_error('usuarioIdPermiso'); ?>
                            <label for="usuarioIdPermiso" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-3 control-label no-padding-right" for="fechaInicioPermiso"> Fecha Inicio </label>
                        <div class="col-sm-6">
                            <input type="hidden" name="permisoId" id="permisoId">
                            <input type="text" id="fechaInicioPermiso" name="fechaInicioPermiso" placeholder="Fecha Inicio" class="form-control" />
                            <?php echo form_error('fechaInicioPermiso'); ?>
                            <label for="fechaInicioPermiso" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-3 control-label no-padding-right" for="fechaFinPermiso"> Fecha Fin </label>
                        <div class="col-sm-6">
                            <input type="text" id="fechaFinPermiso" name="fechaFinPermiso" placeholder="Fecha Fin" class="form-control" />
                            <?php echo form_error('fechaFinPermiso'); ?>
                            <label for="fechaFinPermiso" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-8 control-label no-padding-right" for="horasPrimerDiaPermiso"> Horas Primer Día </label>
                        <div class="col-sm-6">
                            <input type="text" id="horasPrimerDiaPermiso" name="horasPrimerDiaPermiso" placeholder="Horas Primer Día" class="form-control" />
                            <?php echo form_error('horasPrimerDiaPermiso'); ?>
                            <label for="horasPrimerDiaPermiso" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-8 control-label no-padding-right" for="totalDiasPermiso"> Cantidad de Días </label>
                        <div class="col-sm-6">
                            <input type="number" id="totalDiasPermiso" name="totalDiasPermiso" class="form-control" />
                            <?php echo form_error('totalDiasPermiso'); ?>
                            <label for="totalDiasPermiso" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-3 control-label no-padding-right" for="tipoPermisoPermiso"> Tipo Permiso</label>
                        <div class="col-sm-12">
                            <select id="tipoPermisoPermiso" name="tipoPermisoPermiso" class="form-control" data-placeholder="Click to Choose...">
                                <option value="">Tipo Permiso</option>
                                <option value="1">Permiso con Goce de Salario</option>
                                <option value="2">Permiso sin Goce de Salario</option>
                            </select>
                            <?php echo form_error('tipoPermisoPermiso'); ?>
                            <label for="tipoPermisoPermiso" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-8 control-label no-padding-right" for="comentarioPermiso"> Comentario </label>
                        <div class="col-sm-12">
                            <textarea rows="3" cols="10" id="comentarioPermiso" name="comentarioPermiso" class="form-control"></textarea>
                            <?php echo form_error('comentarioPermiso'); ?>
                            <label for="comentarioPermiso" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div align="right">
                        <input type="submit" id="btnGuardar" value="Guardar" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>