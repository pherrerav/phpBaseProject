<?php

class MiPerfilController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("UsuariosModel");
        $this->load->model("PerfilesModel");
        $this->load->model("AuthenticationModel");
    }
    function index($IdPagina)
    {
        $perfil = ($this->session->userdata['UserData']['Perfil']);
        $Resultado = $this->AuthenticationModel->validarAccesos($IdPagina, $perfil);
        if ($Resultado == 1) {
            $data['usuarios'] =  $this->UsuariosModel->listarUsuarios();
            $this->load->view('seguridad/miPerfil', $data);
        } else    $this->load->view('Seguridad/AccesoDenegado');
    }
}
