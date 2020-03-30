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
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<div class="modal fade bs-example-modal-lg" id="vacacionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Vacaciones</h5>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" role="form" id="vacacionForm" name="vacacionForm" class="form-horizontal">
                    <div class="group">
                        <label class="col-sm-3 control-label no-padding-right" for="usuarioIdVacacion"> Usuario</label>
                        <div class="col-sm-12">
                            <select id="usuarioIdVacacion" name="usuarioIdVacacion" class="form-control" data-placeholder="Click to Choose...">
                                <option value="">Usuarios</option>
                                <?php
                                if (isset($usuarios))
                                    foreach ($usuarios as $row) {
                                        echo '<OPTION VALUE="' . $row['usuarioId'] . '">' . $row['usuario'] . '</OPTION>';
                                    }
                                ?>
                            </select>
                            <?php echo form_error('usuarioIdVacacion'); ?>
                            <label for="usuarioIdVacacion" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-3 control-label no-padding-right" for="fechaInicioVacacion"> Fecha Inicio </label>
                        <div class="col-sm-6">
                            <input type="hidden" name="vacacionId" id="vacacionId">
                            <input type="text" autocomplete="off" id="fechaInicioVacacion" name="fechaInicioVacacion" placeholder="Fecha Inicio" class="form-control" />
                            <?php echo form_error('fechaInicioVacacion'); ?>
                            <label for="fechaInicioVacacion" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-3 control-label no-padding-right" for="fechaFinVacacion"> Fecha Fin </label>
                        <div class="col-sm-6">
                            <input type="text" autocomplete="off" id="fechaFinVacacion" name="fechaFinVacacion" placeholder="Fecha Fin" class="form-control" />
                            <?php echo form_error('fechaFinVacacion'); ?>
                            <label for="fechaFinVacacion" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-8 control-label no-padding-right" for="totalDiasVacacion"> Cantidad de Días </label>
                        <div class="col-sm-6">
                            <input type="text" id="totalDiasVacacion" name="totalDiasVacacion" class="form-control" />
                            <?php echo form_error('totalDiasVacacion'); ?>
                            <label for="totalDiasVacacion" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-3 control-label no-padding-right" for="comentarioVacacion"> Comentario </label>
                        <div class="col-sm-12">
                            <textarea rows="3" cols="10" id="comentarioVacacion" name="comentarioVacacion" class="form-control"></textarea>
                            <?php echo form_error('comentarioVacacion'); ?>
                            <label for="comentarioVacacion" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div align="right">
                        <input type="submit" id="btnGuardarVacacion" value="Guardar" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>