<?php

class AccionesPersonalController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("AccionesPersonalModel");
        $this->load->model("UsuariosModel");
        $this->load->model("AuthenticationModel");
    }
    function index($IdPagina)
    {
        $perfil = ($this->session->userdata['UserData']['Perfil']);
        $Resultado = $this->AuthenticationModel->validarAccesos($IdPagina, $perfil);
        if ($Resultado == 1) {
            $data['usuarios'] =  $this->UsuariosModel->listarUsuarios();
            $this->load->view('acciones_personal/accionesPersonal', $data);
        } else    $this->load->view('Seguridad/AccesoDenegado');
    }
    //********************************************************************************* 
    //VACACIONES
    //*********************************************************************************
    function llenarTablaVacaciones()
    {
        echo json_encode($this->AccionesPersonalModel->LlenarTablaVacaciones());
    }
    function llenarTablaVacacionesUsuario()
    {
        $data = array(
            'usuario' => $this->input->post('usuario')
        );
        echo json_encode($this->AccionesPersonalModel->consultarVacacionesUsuario($data));
    }
    function agregarVacacion()
    {
        try {
            $usuario = $this->input->post('usuarioIdVacacion');
            $fechaInicio = $this->input->post('fechaInicioVacacion');
            $fechaFin = $this->input->post('fechaFinVacacion');
            $traslape = 0; //$this->AccionesPersonalModel->validarTraslapeVacacion($usuario, $fechaInicio, $fechaFin, $id);
            if ($traslape == 0) {
                $data = array(
                    'fechaInicio' => $fechaInicio,
                    'fechaFin' => $fechaFin,
                    'usuario' => $usuario,
                    'cantidad' => $this->input->post('totalDiasVacacion'),
                    'comentario' => $this->input->post('comentarioVacacion')
                );
                $resultado = $this->AccionesPersonalModel->agregarVacacion($data);
            } else
                $resultado = -2;
        } catch (Exception $e) {
            log_message('error', $e->getMessage() . 'in' . $e->getFile() . ':' . $e->getLine());
            $resultado = -1;
        }
        echo $resultado;
    }
    function modificarVacacion()
    {
        try {
            $id = $this->input->post('vacacionId');
            $usuario = $this->input->post('usuarioIdVacacion');
            $fechaInicio = $this->input->post('fechaInicioVacacion');
            $fechaFin = $this->input->post('fechaFinVacacion');
            $traslape = 0; //$this->AccionesPersonalModel->validarTraslapeVacacion($usuario, $fechaInicio, $fechaFin, $id);
            if ($traslape == 0) {
                $data = array(
                    'id' => $id,
                    'fechaInicio' => $fechaInicio,
                    'fechaFin' => $fechaFin,
                    'usuario' => $usuario,
                    'cantidad' => $this->input->post('totalDiasVacacion'),
                    'comentario' => $this->input->post('comentarioVacacion')
                );
                $resultado = $this->AccionesPersonalModel->modificarVacacion($data);
            } else
                $resultado = -2;
        } catch (Exception $e) {
            log_message('error', $e->getMessage() . 'in' . $e->getFile() . ':' . $e->getLine());
            $resultado = -1;
        }
        echo $resultado;
    }
    //********************************************************************************* 
    //INCAPACIDADES
    //*********************************************************************************
    function llenarTablaIncapacidades()
    {
        echo json_encode($this->AccionesPersonalModel->llenarTablaIncapacidades());
    }
    function llenarTablaIncapacidadesUsuario()
    {
        $data = array(
            'usuario' => $this->input->post('usuario')
        );
        echo json_encode($this->AccionesPersonalModel->consultarIncapacidadesUsuario($data));
    }
    function agregarIncapacidad()
    {
        try {
            $usuario = $this->input->post('usuarioIdIncapacidad');
            $fechaInicio = $this->input->post('fechaInicioIncapacidad');
            $fechaFin = $this->input->post('fechaFinIncapacidad');
            $traslape = 0; //$this->AccionesPersonalModel->validarTraslapeIncapacidad($usuario, $fechaInicio, $fechaFin, $id);
            if ($traslape == 0) {
                $data = array(
                    'fechaInicio' => $fechaInicio,
                    'fechaFin' => $fechaFin,
                    'usuario' => $usuario,
                    'cantidad' => $this->input->post('totalDiasIncapacidad'),
                    'comentario' => $this->input->post('comentarioIncapacidad'),
                    'horas' => $this->input->post('horasPrimerDiaIncapacidad')
                );
                $resultado = $this->AccionesPersonalModel->agregarIncapacidad($data);
            } else
                $resultado = -2;
        } catch (Exception $e) {
            log_message('error', $e->getMessage() . 'in' . $e->getFile() . ':' . $e->getLine());
            $resultado = -1;
        }
        echo $resultado;
    }
    function modificarIncapacidad()
    {
        try {
            $id = $this->input->post('incapacidadId');
            $usuario = $this->input->post('usuarioIdIncapacidad');
            $fechaInicio = $this->input->post('fechaInicioIncapacidad');
            $fechaFin = $this->input->post('fechaFinIncapacidad');
            $traslape = 0; //$this->AccionesPersonalModel->validarTraslapeIncapacidad($usuario, $fechaInicio, $fechaFin, $id);
            if ($traslape == 0) {
                $data = array(
                    'id' => $id,
                    'fechaInicio' => $fechaInicio,
                    'fechaFin' => $fechaFin,
                    'usuario' => $usuario,
                    'cantidad' => $this->input->post('totalDiasIncapacidad'),
                    'comentario' => $this->input->post('comentarioIncapacidad'),
                    'horas' => $this->input->post('horasPrimerDiaIncapacidad')
                );
                $resultado = $this->AccionesPersonalModel->modificarIncapacidad($data);
            } else
                $resultado = -2;
        } catch (Exception $e) {
            log_message('error', $e->getMessage() . 'in' . $e->getFile() . ':' . $e->getLine());
            $resultado = -1;
        }
        echo $resultado;
    }

    //********************************************************************************* 
    //AUSENCIAS
    //*********************************************************************************
    function llenarTablaAusencias()
    {
        echo json_encode($this->AccionesPersonalModel->llenarTablaAusencias());
    }
    function llenarTablaAusenciasUsuario()
    {
        $data = array(
            'usuario' => $this->input->post('usuario')
        );
        echo json_encode($this->AccionesPersonalModel->consultarAusenciasUsuario($data));
    }
    function agregarAusencia()
    {
        try {
            $usuario = $this->input->post('usuarioIdAusencia');
            $fechaInicio = $this->input->post('fechaInicioAusencia');
            $fechaFin = $this->input->post('fechaFinAusencia');
            $traslape = $this->AccionesPersonalModel->validarTraslapeAusencia($usuario, $fechaInicio, $fechaFin);
            if ($traslape == 0) {
                $data = array(
                    'fechaInicio' => $fechaInicio,
                    'fechaFin' => $fechaFin,
                    'usuario' => $usuario,
                    'cantidad' => $this->input->post('totalDiasAusencia'),
                    'comentario' => $this->input->post('comentarioAusencia'),
                    'horas' => $this->input->post('horasPrimerDiaAusencia')
                );
                $resultado = $this->AccionesPersonalModel->agregarAusencia($data);
            } else
                $resultado = -2;
        } catch (Exception $e) {
            log_message('error', $e->getMessage() . 'in' . $e->getFile() . ':' . $e->getLine());
            $resultado = -1;
        }
        echo $resultado;
    }
    function modificarAusencia()
    {
        try {
            $id = $this->input->post('ausenciaId');
            $usuario = $this->input->post('usuarioIdAusencia');
            $fechaInicio = $this->input->post('fechaInicioAusencia');
            $fechaFin = $this->input->post('fechaFinAusencia');
            $traslape = 0; //$this->AccionesPersonalModel->validarTraslapeAusencia($usuario, $fechaInicio, $fechaFin, $id);
            if ($traslape == 0) {
                $data = array(
                    'id' => $id,
                    'fechaInicio' => $fechaInicio,
                    'fechaFin' => $fechaFin,
                    'usuario' => $usuario,
                    'cantidad' => $this->input->post('totalDiasAusencia'),
                    'comentario' => $this->input->post('comentarioAusencia'),
                    'horas' => $this->input->post('horasPrimerDiaAusencia')
                );
                $resultado = $this->AccionesPersonalModel->modificarAusencia($data);
            } else
                $resultado = -2;
        } catch (Exception $e) {
            log_message('error', $e->getMessage() . 'in' . $e->getFile() . ':' . $e->getLine());
            $resultado = -1;
        }
        echo $resultado;
    }

    //********************************************************************************* 
    //PERMISOS
    //*********************************************************************************
    function llenarTablaPermisos()
    {
        echo json_encode($this->AccionesPersonalModel->llenarTablaPermisos());
    }
    function llenarTablaPermisosUsuario()
    {
        $data = array(
            'usuario' => $this->input->post('usuario')
        );
        echo json_encode($this->AccionesPersonalModel->consultarPermisosUsuario($data));
    }
    function agregarPermiso()
    {
        try {
            $usuario = $this->input->post('usuarioIdPermiso');
            $fechaInicio = $this->input->post('fechaInicioPermiso');
            $fechaFin = $this->input->post('fechaFinPermiso');
            $traslape = $this->AccionesPersonalModel->validarTraslapePermiso($usuario, $fechaInicio, $fechaFin);
            if ($traslape == 0) {
                $data = array(
                    'fechaInicio' => $fechaInicio,
                    'fechaFin' => $fechaFin,
                    'usuario' => $usuario,
                    'cantidad' => $this->input->post('totalDiasPermiso'),
                    'comentario' => $this->input->post('comentarioPermiso'),
                    'horas' => $this->input->post('horasPrimerDiaPermiso'),
                    'tipo' => $this->input->post('tipoPermisoPermiso')
                );
                $resultado = $this->AccionesPersonalModel->agregarPermiso($data);
            } else
                $resultado = -2;
        } catch (Exception $e) {
            log_message('error', $e->getMessage() . 'in' . $e->getFile() . ':' . $e->getLine());
            $resultado = -1;
        }
        echo $resultado;
    }
    function modificarPermiso()
    {
        try {
            $id = $this->input->post('permisoId');
            $usuario = $this->input->post('usuarioIdPermiso');
            $fechaInicio = $this->input->post('fechaInicioPermiso');
            $fechaFin = $this->input->post('fechaFinPermiso');
            $traslape = 0; //$this->AccionesPersonalModel->validarTraslapePermiso($usuario, $fechaInicio, $fechaFin, $id);
            if ($traslape == 0) {
                $data = array(
                    'id' => $id,
                    'fechaInicio' => $fechaInicio,
                    'fechaFin' => $fechaFin,
                    'usuario' => $usuario,
                    'cantidad' => $this->input->post('totalDiasPermiso'),
                    'comentario' => $this->input->post('comentarioPermiso'),
                    'horas' => $this->input->post('horasPrimerDiaPermiso'),
                    'tipo' => $this->input->post('tipoPermisoPermiso')
                );
                $resultado = $this->AccionesPersonalModel->modificarPermiso($data);
            } else
                $resultado = -2;
        } catch (Exception $e) {
            log_message('error', $e->getMessage() . 'in' . $e->getFile() . ':' . $e->getLine());
            $resultado = -1;
        }
        echo $resultado;
    }
    function actualizarEstado()
    {
        try {
            $tipoExcepcion = $this->input->post('tipoExcepcion');
            $data = array(
                'id' => $this->input->post('id'),
                'estado' => $this->input->post('estado'),
                'aprobadoPor' => $this->session->userdata['UserData']['UsuarioId']
            );
            $resultado = $this->AccionesPersonalModel->actualizarEstado($data, $tipoExcepcion);
        } catch (Exception $e) {
            log_message('error', $e->getMessage() . 'in' . $e->getFile() . ':' . $e->getLine());
            $resultado = -1;
        }
        echo $resultado;
    }
}
