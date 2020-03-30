<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManualesController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("AuthenticationModel");
    }

    public function administrativos($IdPagina)
    {
        $perfil = ($this->session->userdata['UserData']['Perfil']);
        $Resultado = $this->AuthenticationModel->validarAccesos($IdPagina, $perfil);
        if ($Resultado == 1) {
            $this->load->view('manuales_operativos/manuales_administrativos');
        } else    $this->load->view('Seguridad/AccesoDenegado');
    }
    public function outsoursing($IdPagina)
    {
        $perfil = ($this->session->userdata['UserData']['Perfil']);
        $Resultado = $this->AuthenticationModel->validarAccesos($IdPagina, $perfil);
        if ($Resultado == 1) {
            $this->load->view('manuales_operativos/manuales_outsoursing');
        } else    $this->load->view('Seguridad/AccesoDenegado');
    }

    // File upload
    public function do_Upload($carpeta)
    {
        if (!empty($_FILES['file']['name'])) {

            // Set preference
            $config['upload_path'] = 'uploads/manuales/' . $carpeta;
            $config['allowed_types'] = 'pdf|docx|doc|xlsx|xls';
            $config['max_size'] = '10000'; // max_size in kb
            $config['file_name'] = $_FILES['file']['name'];

            //Load upload library
            $this->load->library('upload', $config);

            // File upload
            if ($this->upload->do_upload('file')) {
                // Get data about the file
                $uploadData = $this->upload->data();
            }
        }
    }

    public function removeAdministrativos($archivo)
    {
        $this->load->helper("file");
        $path = ("uploads/manuales/administrativo/" . $archivo);
        if ($archivo && file_exists($path)) {
            unlink($path);
            echo 1;
        } else echo $path;
    }
    public function downloadAdministrativos($archivo)
    {
        $this->load->helper("download");
        $data = file_get_contents("uploads/manuales/administrativo/" . $archivo);
        force_download($archivo, $data);
    }

    public function removeOutsoursing($archivo)
    {
        $this->load->helper("file");
        $path = ("uploads/manuales/outsoursing/" . $archivo);
        if ($archivo && file_exists($path)) {
            unlink($path);
            echo 1;
        } else echo -1;
    }
    public function downloadOutsoursing($archivo)
    {
        $this->load->helper("download");
        $data = file_get_contents("uploads/manuales/outsoursing/" . $archivo);
        force_download($archivo, $data);
    }
    public function listarArchivos($carpeta)
    {
        $dir = "uploads/manuales/" . $carpeta;

        $data = [];

        foreach (new DirectoryIterator($dir) as $f) {
            $name = $f->getFilename();
            if ($f->isFile())
                $data[] = ['manuales' => $name];
        }
        echo json_encode($data);
    }
}
