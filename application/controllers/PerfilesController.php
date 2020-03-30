<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PerfilesController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("PerfilesModel");
		$this->load->model("AuthenticationModel");
	}
	function index($IdPagina)
	{
		$perfil = ($this->session->userdata['UserData']['Perfil']);
		$Resultado = $this->AuthenticationModel->validarAccesos($IdPagina, $perfil);
		if ($Resultado == 1) {
			$data['paginas'] = $this->PerfilesModel->buscarPaginas();
			$this->load->view('Seguridad/Perfiles', $data);
		} else
			$this->load->view('AccesoDenegado');
	}
	function llenarTablaPerfiles()
	{
		echo json_encode($this->PerfilesModel->BuscarPerfiles());
	}
	function agregarPerfil()
	{
		try {
			$perfil = $this->input->post('perfil');
			$duplicado = $this->PerfilesModel->buscarPerfilesDuplicados($perfil);
			if (!$duplicado) {
				$misChk = $this->input->post('myCheckboxes');
				$resultado = $this->PerfilesModel->agregarPerfil($perfil, $misChk);
			} else
				$resultado = "Ya existe un registro con ese perfil";
		} catch (Exception $e) {
			$resultado = -1;
		}
		echo $resultado;
	}
	function modificarPerfil()
	{
		try {
			$perfilId = $this->input->post('perfilId');
			$misChk = $this->input->post('myCheckboxes');
			$resultado = $this->PerfilesModel->modificarPerfil($perfilId, $misChk);
		} catch (Exception $e) {
			$resultado = -1;
		}
		echo $resultado;
	}
	// **********************************************************************************************
	function consultaPerfiles()
	{
		$idPerfil = $this->input->post('IdPerfil');
		$resultado = $this->PerfilesModel->consultaPerfiles($idPerfil);
		echo $resultado;
	}
}
