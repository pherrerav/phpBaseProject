<?php
class PerfilesModel extends CI_Model
{

    // ****************************************************************************************************************
    //funcion para agregar un nuevo perfil a la base de datos
    function agregarPerfil($perfil, $misChk)
    {
        $resultado = -1;
        $this->db->trans_begin();
        $this->db->query('Insert into Perfil (perfilNombre) values ("' . $perfil . '")');
        if ($this->db->trans_status() === TRUE) {
            $resultado = 1;
            $IdPerfil = $this->buscarPerfilId();
            $data = $this->permisosToArray($misChk, $IdPerfil);
            if (!empty($data)) {
                $this->db->insert_batch('pagina_perfil', $data);
                if ($this->db->trans_status() === TRUE)
                    $this->db->trans_commit();
                else {
                    $this->db->trans_rollback();
                    $resultado = -1;
                }
            } else
                $this->db->trans_commit();
        }
        return $resultado;
    }
    // ****************************************************************************************************************
    // Esta funcion modifica un perfil en la base de datos. Elimina todos los permisos previos e inserta los nuevos
    function modificarPerfil($idPerfil, $misChk)
    {
        $resultado = -1;
        $this->db->trans_begin();
        $this->db->query('DELETE FROM pagina_perfil WHERE perfilId = "' . $idPerfil . '" ');
        if ($this->db->trans_status() === TRUE) {
            $resultado = 1;
            $data = $this->permisosToArray($misChk, $idPerfil);
            if (!empty($data)) {
                $this->db->insert_batch('pagina_perfil', $data);
                if ($this->db->trans_status() === TRUE)
                    $this->db->trans_commit();
                else {
                    $this->db->trans_rollback();
                    $resultado = -1;
                }
            } else
                $this->db->trans_commit();
        }
        return $resultado;
    }
    // **************************************************************************************************************
    //poner las páginas y el perfil en un arreglo para guardarlo en la BD	
    private function permisosToArray($misChk, $IdPerfil)
    {
        $array = explode(",", $misChk);
        $data = [];
        for ($i = 0; $i < count($array) - 1; $i++) {
            $data[] = array(
                'paginaId' => $array[$i],
                'perfilId' => $IdPerfil
            );
        }
        return $data;
    }
    // *********************************************************************************************************************
    //funcion para validar que no haya perfiles duplicados.
    function buscarPerfilesDuplicados($perfil)
    {
        $duplicado = true;
        $data = array(
            'perfil' => $perfil
        );
        $sql = 'SELECT perfilId FROM perfil WHERE perfilNombre= ?';
        $query = $this->db->query($sql, $data);
        if ($query->num_rows() == 0)
            $duplicado = false;
        return $duplicado;
    }
    // ****************************************************************************************************************
    //funcion para devolver la lista de las páginas del sitio para los perfiles de usuario
    function buscarPaginas()
    {
        $sql = "SELECT * FROM pagina";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    // ***********************************************************************************************
    //traer el último id de perfil ingresado
    private function buscarPerfilId()
    {
        $sql = "SELECT max(perfilId) as perfilId FROM perfil ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $Perfil = $row['perfilId'];
            }
        } else {
            $Perfil = 1;
        }

        return $Perfil;
    }
    // *********************************************************************************************
    //buscar un perfil seleccionado y extrae las páginas a las que tiene acceso, se utiliza cuando se hace clic sobre la tabla de perfiles a la hora de realizar una consulta
    function consultaPerfiles($idPerfil)
    {
        $sql = 'SELECT paginaId FROM pagina_perfil WHERE perfilId= "' . $idPerfil . '"';
        $query = $this->db->query($sql);
        $Paginas = array();
        foreach ($query->result_array() as $row) {
            $Paginas[] = array('paginaId' => $row['paginaId']);
        }
        return json_encode($Paginas);
    }
    // ************************************************************************************************************
    //Genera un listado de los perfiles para llenar los select
    function BuscarPerfiles()
    {
        $query = $this->db->query('SELECT * FROM perfil');
        return $query->result_array();
    }
}
