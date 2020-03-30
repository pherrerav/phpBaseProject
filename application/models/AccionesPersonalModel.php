<?php
class AccionesPersonalModel extends CI_Model
{
    //********************************************************************************* 
    //VACACIONES
    //*********************************************************************************

    //funcion para agregar un nueva vacacion a la base de datos
    function agregarVacacion($data)
    {
        $sql = 'call pa_agregarVacacion (?, ?, ?, ?, ?)';
        if ($this->db->query($sql, $data))
            $resultado = 1;
        else
            $resultado = -1;
        return $resultado;
    }

    //funcion para modificar una vacacion a la base de datos
    function modificarVacacion($data)
    {
        $sql = 'call pa_modificarVacacion (?, ?, ?, ?, ?, ?)';
        if ($this->db->query($sql, $data))
            $resultado = 1;
        else
            $resultado = -1;
        return $resultado;
    }

    function validarTraslapeVacacion($usuario, $fechaIncio, $fechaFin, $id)
    {
        $data = array(
            'usuario' => $usuario,
            'fechaInicio' => $fechaIncio,
            'fechaFin' => $fechaFin,
            'id' => $id
        );
        $duplicado = true;
        $sql = 'call pa_validarTraslapeVacacion(?, ?, ?, ?)';
        $query = $this->db->query($sql, $data);
        if ($query->num_rows() == 0)
            $duplicado = false;

        $this->db->close();
        return $duplicado;
    }

    //funcion para llenar la tabla de vacaciones para consulta y aprobación
    function llenarTablaVacaciones()
    {
        $perfil = $this->session->userdata['UserData']['Perfil'];
        $data = array(
            '_usuario' => $this->session->userdata['UserData']['UsuarioId']
        );
        switch ($perfil) {
            case ADMINISTRADOR:
                PLANILLAS: $sql = 'call pa_ConsultarVacacionesTodos';
                break;
            case  SUP_OUTSOURSING:
                $sql = 'call pa_ConsultarVacacionesOutSoursing (?)';
                break;
            case CLIENTE:
                OUTSOURSING: $sql = 'call pa_ConsultarVacacionesUsuario (?)';
                break;
            default:
                break;
        }
        $query = $this->db->query($sql, $data);
        return $query->result_array();
    }
    //********************************************************************************* 
    //INCAPACIDADES
    //*********************************************************************************

    //funcion para agregar un nueva incapacidad a la base de datos
    function agregarIncapacidad($data)
    {
        $sql = 'call pa_agregarIncapacidad (?, ?, ?, ?, ?, ?)';
        if ($this->db->query($sql, $data))
            $resultado = 1;
        else
            $resultado = -1;
        return $resultado;
    }

    //funcion para modificar una incapacidad a la base de datos
    function modificarIncapacidad($data)
    {
        $sql = 'call pa_modificarIncapacidad (?, ?, ?, ?, ?, ?, ?)';
        if ($this->db->query($sql, $data))
            $resultado = 1;
        else
            $resultado = -1;
        return $resultado;
    }

    function validarTraslapeIncapacidad($usuario, $fechaIncio, $fechaFin)
    {
        $data = array(
            'usuario' => $usuario,
            'fechaInicio' => $fechaIncio,
            'fechaFin' => $fechaFin
        );
        $duplicado = true;
        $sql = 'call pa_validarTraslapeIncapacidad(?, ?, ?)';
        $query = $this->db->query($sql, $data);
        if ($query->num_rows() == 0)
            $duplicado = false;

        $this->db->close();
        return $duplicado;
    }

    //funcion para llenar la tabla de incapacidades para consulta y aprobación
    function llenarTablaIncapacidades()
    {
        $perfil = $this->session->userdata['UserData']['Perfil'];
        $data = array(
            '_usuario' => $this->session->userdata['UserData']['UsuarioId']
        );
        switch ($perfil) {
            case ADMINISTRADOR:
                PLANILLAS: $sql = 'call pa_ConsultarIncapacidadesTodos';
                break;
            case  SUP_OUTSOURSING:
                $sql = 'call pa_ConsultarIncapacidadesOutSoursing (?)';
                break;
            default:
                break;
        }
        $query = $this->db->query($sql, $data);
        return $query->result_array();
    }
    //********************************************************************************* 
    //AUSENCIAS
    //*********************************************************************************

    //funcion para agregar un nueva ausencia a la base de datos
    function agregarAusencia($data)
    {
        $sql = 'call pa_agregarAusencia (?, ?, ?, ?, ?, ?)';
        if ($this->db->query($sql, $data))
            $resultado = 1;
        else
            $resultado = -1;
        return $resultado;
    }

    //funcion para modificar una Ausencia a la base de datos
    function modificarAusencia($data)
    {
        $sql = 'call pa_modificarAusencia (?, ?, ?, ?, ?, ?, ?)';
        if ($this->db->query($sql, $data))
            $resultado = 1;
        else
            $resultado = -1;
        return $resultado;
    }

    function validarTraslapeAusencia($usuario, $fechaIncio, $fechaFin)
    {
        $data = array(
            'usuario' => $usuario,
            'fechaInicio' => $fechaIncio,
            'fechaFin' => $fechaFin
        );
        $sql = 'call pa_validarTraslapeAusencia(?, ?, ?)';
        $query = $this->db->query($sql, $data);
        $duplicado = true;
        if ($query->num_rows() == 0)
            $duplicado = false;

        $this->db->close();
        return $duplicado;
    }
    //funcion para llenar la tabla de ausencias para consulta y aprobación
    function llenarTablaAusencias()
    {
        $perfil = $this->session->userdata['UserData']['Perfil'];
        $data = array(
            '_usuario' => $this->session->userdata['UserData']['UsuarioId']
        );
        switch ($perfil) {
            case ADMINISTRADOR:
                PLANILLAS: $sql = 'call pa_ConsultarAusenciasTodos';
                break;
            case  SUP_OUTSOURSING:
                $sql = 'call pa_ConsultarAusenciasOutSoursing (?)';
                break;
            default:
                break;
        }
        $query = $this->db->query($sql, $data);
        return $query->result_array();
    }
    //********************************************************************************* 
    //PERMISOS
    //*********************************************************************************

    //funcion para agregar un nueva permiso a la base de datos
    function agregarPermiso($data)
    {
        $sql = 'call pa_agregarPermiso (?, ?, ?, ?, ?, ?, ?)';
        if ($this->db->query($sql, $data))
            $resultado = 1;
        else
            $resultado = -1;
        return $resultado;
    }

    //funcion para modificar una Permiso a la base de datos
    function modificarPermiso($data)
    {
        $sql = 'call pa_modificarPermiso (?, ?, ?, ?, ?, ?, ?, ?)';
        if ($this->db->query($sql, $data))
            $resultado = 1;
        else
            $resultado = -1;
        return $resultado;
    }
    function validarTraslapePermiso($usuario, $fechaIncio, $fechaFin)
    {
        $data = array(
            'usuario' => $usuario,
            'fechaInicio' => $fechaIncio,
            'fechaFin' => $fechaFin
        );
        $sql = 'call pa_validarTraslapePermiso(?, ?, ?)';
        $query = $this->db->query($sql, $data);
        $duplicado = true;
        if ($query->num_rows() == 0)
            $duplicado = false;

        $this->db->close();
        return $duplicado;
    }

    //funcion para llenar la tabla de permisos para consulta y aprobación
    function llenarTablaPermisos()
    {
        $perfil = $this->session->userdata['UserData']['Perfil'];
        $data = array(
            '_usuario' => $this->session->userdata['UserData']['UsuarioId']
        );
        switch ($perfil) {
            case ADMINISTRADOR:
                PLANILLAS: $sql = 'call pa_ConsultarPermisosTodos';
                break;
            case  SUP_OUTSOURSING:
                $sql = 'call pa_ConsultarPermisosOutSoursing (?)';
                break;
            default:
                break;
        }
        $query = $this->db->query($sql, $data);
        return $query->result_array();
    }
    //*********************************************************************************** */
    //APROBAR ACCIONES DE PERSONAL
    //*********************************************************************************** */
    function actualizarEstado($data, $tipo)
    {
        switch ($tipo) {
            case VACACIONES:
                $sql = 'call pa_ActualizarEstadoVacacion (?, ?, ?)';
                break;
            case  INCAPACIDADES:
                $sql = 'call pa_ActualizarEstadoIncapacidad (?, ?, ?)';
                break;
            case  AUSENCIAS:
                $sql = 'call pa_ActualizarEstadoAusencia (?, ?, ?)';
                break;
            case  PERMISOS:
                $sql = 'call pa_ActualizarEstadoPermiso (?, ?, ?)';
                break;
            default:
                break;
        }
        if ($this->db->query($sql, $data))
            $resultado = 1;
        else
            $resultado = -1;
        return $resultado;
    }
}
