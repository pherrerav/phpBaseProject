<?php
class UsuariosModel extends CI_Model
{

    // ********************************************************************************************************
    //funcion para agregar un nuevo usuario a la base de datos
    function agregarUsuario($data)
    {
        $sql = 'call pa_agregarUsuario (?, ?, ?, ?, ?, ?)';
        if ($this->db->query($sql, $data))
            $resultado = 1;
        else
            $resultado = -1;
        return $resultado;
    }
    // ********************************************************************************************************
    //funcion para modificar un registro de usuario 
    function modificarUsuario($data)
    {
        $sql = 'call pa_modificarUsuario (?, ?, ?, ?, ?, ?, ?)';
        if ($this->db->query($sql, $data))
            $resultado = 1;
        else
            $resultado = -1;
        return $resultado;
    }

    //** ******************************************************************************************************
    //Llenar tabla de Usuarios
    function llenarTablaUsuarios()
    {
        $sql = 'call pa_llenarTablaUsuarios()';
        $query = $this->db->query($sql);
        if ($query)
            $resultado = $query->result_array();
        else
            $resultado = -1;
        return $resultado;
    }
    // ********************************************************************************************************
    //funcion para validar que no haya usuarios duplicados.
    function buscarUsuariosDuplicados($usuario)
    {
        $duplicado = true;
        $data = array(
            'usuario' => $usuario
        );
        $sql = 'call pa_buscarUsuariosDuplicados (?)';
        $query = $this->db->query($sql, $data);
        if ($query->num_rows() == 0)
            $duplicado = false;
        return $duplicado;
    }
    //** ******************************************************************************************************
    //Listar Usuarios
    function listarUsuarios()
    {
        $sql = 'call pa_consultarUsuarios ()';
        $query = $this->db->query($sql);
        $resultado = $query->result_array();
        return $resultado;
    }
    function ConsultarUsuariosPorPerfil($data)
    {
        $sql = 'call pa_ConsultarUsuariosPorPerfil (?, ?)';
        $query = $this->db->query($sql, $data);
        $resultado = $query->result_array();
        return $resultado;
    }
}
