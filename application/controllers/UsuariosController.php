<?php

class UsuariosController extends CI_Controller
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
			$data["perfiles"] = $this->PerfilesModel->BuscarPerfiles();
			$this->load->view('seguridad/usuarios', $data);
		} else	$this->load->view('Seguridad/AccesoDenegado');
	}
	function LlenarTablaUsuarios()
	{
		echo json_encode($this->UsuariosModel->llenarTablaUsuarios());
	}
	function agregarUsuario()
	{
		if ($this->form_validation->run("userForm") == FALSE) {
			$this->index(1);
		} else {
			try {
				$usuario = $this->input->post('usuario');
				$data = array(
					'usuario' => $usuario,
					'nombre' => $this->input->post('nombre'),
					'apellidos' => $this->input->post('apellidos'),
					'perfiles' => $this->input->post('perfiles'),
					'estado' => $this->input->post('estado'),
					'fechaIngreso' => $this->input->post('fechaIngreso')
				);
				$resultado = $this->UsuariosModel->agregarUsuario($data);
			} catch (Exception $e) {
				log_message('error', $e->getMessage() . 'in' . $e->getFile() . ':' . $e->getLine());
				$resultado = -1;
			}
			echo $resultado;
		}
	}
	function modificarUsuario()
	{
		try {
			$data = array(
				'usuarioId' => $this->input->post('usuarioId'),
				'usuario' => $this->input->post('usuario'),
				'nombre' => $this->input->post('nombre'),
				'apellidos' => $this->input->post('apellidos'),
				'perfiles' => $this->input->post('perfiles'),
				'estado' => $this->input->post('estado'),
				'fechaIngreso' => $this->input->post('fechaIngreso')
			);
			$resultado = $this->UsuariosModel->modificarUsuario($data);
		} catch (Exception $e) {
			log_message('error', $e->getMessage() . 'in' . $e->getFile() . ':' . $e->getLine());
			$resultado = -1;
		}
		echo $resultado;
	}
}
