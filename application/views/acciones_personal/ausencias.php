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
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<div class="modal fade bs-example-modal-lg" id="ausenciaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ausencias</h5>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" role="form" id="ausenciaForm" name="ausenciaForm" class="form-horizontal">
                    <div class="group">
                        <label class="col-sm-3 control-label no-padding-right" for="usuarioIdAusencia"> Usuario</label>
                        <div class="col-sm-12">
                            <select id="usuarioIdAusencia" name="usuarioIdAusencia" class="form-control" data-placeholder="Click to Choose...">
                                <option value="">Usuarios</option>
                                <?php
                                if (isset($usuarios))
                                    foreach ($usuarios as $row) {
                                        echo '<OPTION VALUE="' . $row['usuarioId'] . '">' . $row['usuario'] . '</OPTION>';
                                    }
                                ?>
                            </select>
                            <?php echo form_error('usuarioIdAusencia'); ?>
                            <label for="usuarioIdAusencia" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-3 control-label no-padding-right" for="fechaInicioAusencia"> Fecha Inicio </label>
                        <div class="col-sm-6">
                            <input type="hidden" name="ausenciaId" id="ausenciaId">
                            <input type="text" id="fechaInicioAusencia" autocomplete="off" name="fechaInicioAusencia" placeholder="Fecha Inicio" class="form-control" />
                            <?php echo form_error('fechaInicioAusencia'); ?>
                            <label for="fechaInicioAusencia" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-3 control-label no-padding-right" for="fechaFinAusencia"> Fecha Fin </label>
                        <div class="col-sm-6">
                            <input type="text" id="fechaFinAusencia" autocomplete="off" name="fechaFinAusencia" placeholder="Fecha Fin" class="form-control" />
                            <?php echo form_error('fechaFinAusencia'); ?>
                            <label for="fechaFinAusencia" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-5 control-label no-padding-right" for="horasPrimerDiaAusencia"> Horas Primer Día </label>
                        <div class="col-sm-6">
                            <input type="text" id="horasPrimerDiaAusencia" autocomplete="off" name="horasPrimerDiaAusencia" placeholder="Horas Primer Día" class="form-control" />
                            <?php echo form_error('horasPrimerDiaAusencia'); ?>
                            <label for="horasPrimerDiaAusencia" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-8 control-label no-padding-right" for="totalDiasAusencia"> Cantidad de Días </label>
                        <div class="col-sm-6">
                            <input type="number" id="totalDiasAusencia" name="totalDiasAusencia" placeholder="Cantidad de Días" class="form-control" />
                            <?php echo form_error('totalDiasAusencia'); ?>
                            <label for="totalDiasAusencia" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div class="group">
                        <label class="col-sm-8 control-label no-padding-right" for="comentarioAusencia"> Comentario </label>
                        <div class="col-sm-12">
                            <textarea rows="3" cols="10" id="comentarioAusencia" name="comentarioAusencia" class="form-control"></textarea>
                            <?php echo form_error('comentarioAusencia'); ?>
                            <label for="comentarioAusencia" class="validation_error_message help-block"></label>
                        </div>
                    </div>
                    <div align="right">
                        <input type="submit" id="btnGuardarAusencia" value="Guardar" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>