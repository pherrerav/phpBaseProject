<?php
class AuthenticationModel extends CI_Model
{
    function validarAccesos($idPagina, $perfil)
    {
        $data = array(
            'idPagina' => $idPagina,
            'perfil' => $perfil
        );
        $sql = 'select * from pagina_perfil where paginaId = ? and perfilId = ?';
        $query = $this->db->query($sql, $data);
        $query->result_array();
        if ($query->num_rows() == 0)
            $result = -1;
        else
            $result = 1;

        return $result;
    }

    function ValidarUsuarioSistema($usuario)
    {
        $data = array(
            'usuario' => $usuario
        );
        $sql = 'select usuarioId, usuario, nombre, perfiles 
        from usuario 
        where usuario = ? and estado = 1';
        $query = $this->db->query($sql, $data);
        if ($query->num_rows() == 0)
            $result = -1;
        else
            $result = $query->result();

        return $result;
    }
}
