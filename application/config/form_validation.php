<?php
$config = array(
        //Validar formulario de login
        'loginForm' => array(
                array(
                        'field' => 'usuario',
                        'label' => 'Usuario',
                        'rules' => 'trim|required|xss_clean'
                ),
                array(
                        'field' => 'clave',
                        'label' => 'Clave',
                        'rules' => 'trim|required|xss_clean'
                )
        ),
        //Validar formulario del mantenimiento de usuarios
        'userForm' => array(
                array(
                        'field' => 'usuario',
                        'label' => 'Usuario',
                        'rules' => 'trim|required|xss_clean|max_length[20]'
                ),
                array(
                        'field' => 'nombre',
                        'label' => 'Nombre',
                        'rules' => 'trim|required|xss_clean|callback_alpha_dash_space|max_length[50]'
                ),
                array(
                        'field' => 'apellidos',
                        'label' => 'Apellidos',
                        'rules' => 'trim|required|xss_clean|callback_alpha_dash_space|max_length[50]'
                ),
                array(
                        'field' => 'perfiles',
                        'label' => 'Perfil',
                        'rules' => 'required|trim|xss_clean|numeric'
                ),
                array(
                        'field' => 'usuarioId',
                        'label' => 'Id',
                        'rules' => 'trim|xss_clean|numeric'
                )
        ),
        'vacacionForm' => array(
                array(
                        'field' => 'usuarioIdVacacion',
                        'label' => 'Usuario',
                        'rules' => 'trim|required|xss_clean'
                ),
                array(
                        'field' => 'fechaInicioVacacion',
                        'label' => 'Fecha Inicio',
                        'rules' => 'trim|required|xss_clean'
                ),
                array(
                        'field' => 'fechaFinVacacion',
                        'label' => 'Fecha Fin',
                        'rules' => 'trim|required|xss_clean'
                ),
                array(
                        'field' => 'totalDiasVacacion',
                        'label' => 'Cantidad de Días',
                        'rules' => 'trim|required|xss_clean|numeric'
                )
        ),
        //Validar formulario de perfiles
        'frmPerfiles' => array(
                array(
                        'field' => 'perfilNombre',
                        'label' => 'Perfil',
                        'rules' => 'trim|xss_clean|required|max_length[20]'
                ),
                array(
                        'field' => 'perfilId',
                        'label' => 'Perfil',
                        'rules' => 'trim|xss_clean|numeric'
                )
        ),
        'tipoTramiteForm' => array(
                array(
                        'field' => 'tipoTramiteNombre',
                        'label' => 'Tipo trámite',
                        'rules' => 'trim|xss_clean|required|max_length[50]'
                ),
        ),
        'consultasForm' => array(
                array(
                        'field' => 'asunto',
                        'label' => 'Asunto',
                        'rules' => 'trim|xss_clean|required|max_length[100]'
                ),
                array(
                        'field' => 'tipoTramite',
                        'label' => 'Tipo de tramite',
                        'rules' => 'trim|xss_clean'
                )
        ),


        'frmGerencias' => array(
                array(
                        'field' => 'gerencia',
                        'label' => 'Gerencia',
                        'rules' => 'trim|xss_clean|required|max_length[70]'
                )
        ),

);
