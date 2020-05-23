<?php

class MiPerfilController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("UsuariosModel");
        $this->load->model("PerfilesModel");
        $this->load->model("AuthenticationModel");
        $this->load->model("AccionesPersonalModel");
    }
    function index($IdPagina)
    {
        $perfil = ($this->session->userdata['UserData']['Perfil']);
        $Resultado = $this->AuthenticationModel->validarAccesos($IdPagina, $perfil);
        if ($Resultado == 1) {
            $data = array(
                'perfil' => $this->session->userdata['UserData']['Perfil'],
                'usuario' => $this->session->userdata['UserData']['UsuarioId']
            );
            $usuarios['usuarios'] =  $this->UsuariosModel->ConsultarUsuariosPorPerfil($data);
            $this->load->view('seguridad/miPerfil', $usuarios);
        } else    $this->load->view('Seguridad/AccesoDenegado');
    }

    function consultarCalculoVacaciones()
    {
        $data = array(
            'usuario' => $this->input->post('usuario')
        );
        echo json_encode($this->AccionesPersonalModel->consultarCalculoVacaciones($data));
    }
}
