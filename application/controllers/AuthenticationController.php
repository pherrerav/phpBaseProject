<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthenticationController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("AuthenticationModel");
    }
    public function index()
    {
        $this->load->view("seguridad/login");
    }
    function AccessGranted()
    {
        $this->load->view("acciones_personal/accionesPersonal");
    }
    function AccessValidacion()
    {
        if ($this->form_validation->run("loginForm") == false)
            $result = validation_errors();
        else {
            $usuario = $this->input->post("usuario");
            $password = $this->input->post("clave");
            $validarAD = 1; //$this->ValidacionAD($usuario, $password);
            if ($validarAD == 1)
                $result = $this->ValidarUsuarioSistema($usuario);
            else
                $result = $validarAD;
        }
        echo $result;
    }
    private function ValidarUsuarioSistema($usuario)
    {
        try {
            $result = $this->AuthenticationModel->ValidarUsuarioSistema($usuario);
            if ($result != -1) {
                $session_data = array(
                    'UsuarioId' => $result[0]->usuarioId,
                    'Usuario' => $result[0]->usuario,
                    'Nombre' => $result[0]->nombre,
                    'Perfil' => $result[0]->perfiles
                );
                $this->session->set_userdata('UserData', $session_data);
                $result = 1;
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage() . 'in' . $e->getFile() . ':' . $e->getLine());
            $result = 0;
        }
        return $result;
    }
    private function ValidacionAD($username, $password)
    {

        $server = '';
        $domain = '';
        $port = 389;

        $ldap_connection = ldap_connect($server, $port);
        if (!$ldap_connection)
            return 0;

        ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0);

        $ldap_bind = @ldap_bind($ldap_connection, $username . $domain, $password);

        if (!$ldap_bind) {
            return -2;
        } else {
            return 1;
        }
        ldap_close($ldap_connection);
    }

    public function logout()
    {
        $this->session->unset_userdata('UserData');
        redirect('login');
    }
}
