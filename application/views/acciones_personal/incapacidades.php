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
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<div class="modal fade bs-example-modal-lg" id="incapacidadModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Incapacidades</h5>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" role="form" id="incapacidadForm" name="incapacidadForm" class="form-horizontal">
                    <div class="group">
                        <label class="col-sm-3 control-label no-padding-right" for="usuarioIdIncapacidad"> Usuario</label>
                        <div class="col-sm-12">
                            <select id="usuarioIdIncapacidad" name="usuarioIdIncapacidad" class="form-control" data-placeholder="Click to Choose...">
                                <option value="">Usuarios</option>
                                <?php
                                if (isset($usuarios))
                                    foreach ($usuarios as $row) {
                                        echo '<OPTION VALUE="' . $row['usuarioId'] . '">' . $row['usuario'] . '</OPTION>';
                                    }
                                ?>
                            </select>
                            <?php echo form_error('usuarioIdIncapacidad'); ?>
                            <label for="usuarioIdIncapacidad" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-3 control-label no-padding-right" for="fechaInicioIncapacidad"> Fecha Inicio </label>
                        <div class="col-sm-6">
                            <input type="hidden" name="incapacidadId" id="incapacidadId">
                            <input type="text" id="fechaInicioIncapacidad" name="fechaInicioIncapacidad" placeholder="Fecha Inicio" class="form-control" />
                            <?php echo form_error('fechaInicioIncapacidad'); ?>
                            <label for="fechaInicioIncapacidad" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-3 control-label no-padding-right" for="fechaFinIncapacidad"> Fecha Fin </label>
                        <div class="col-sm-6">
                            <input type="text" id="fechaFinIncapacidad" name="fechaFinIncapacidad" placeholder="Fecha Fin" class="form-control" />
                            <?php echo form_error('fechaFinIncapacidad'); ?>
                            <label for="fechaFinIncapacidad" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-3 control-label no-padding-right" for="horasPrimerDiaIncapacidad"> Horas Primer Día </label>
                        <div class="col-sm-6">
                            <input type="text" id="horasPrimerDiaIncapacidad" name="horasPrimerDiaIncapacidad" placeholder="Fecha Fin" class="form-control" />
                            <?php echo form_error('horasPrimerDiaIncapacidad'); ?>
                            <label for="horasPrimerDiaIncapacidad" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-8 control-label no-padding-right" for="totalDiasIncapacidad"> Cantidad de Días </label>
                        <div class="col-sm-6">
                            <input type="number" id="totalDiasIncapacidad" name="totalDiasIncapacidad" class="form-control" />
                            <?php echo form_error('totalDiasIncapacidad'); ?>
                            <label for="totalDiasIncapacidad" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-8 control-label no-padding-right" for="comentarioIncapacidad"> Comentario </label>
                        <div class="col-sm-12">
                            <textarea rows="3" cols="10" id="comentarioIncapacidad" name="comentarioIncapacidad" class="form-control"></textarea>
                            <?php echo form_error('comentarioIncapacidad'); ?>
                            <label for="comentarioIncapacidad" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div align="right">
                        <input type="submit" id="btnGuardarIncapacidad" value="Guardar" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>