<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?php echo base_url('assets/dist/images/imagenWR.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Consultores</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url('assets/dist/images/user.png') ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <input type="hidden" id="PerfilId" value="<?php echo $this->session->userdata['UserData']['Perfil'] ?>" />
                <input type="hidden" id="UsuarioId" value="<?php echo $this->session->userdata['UserData']['UsuarioId'] ?>" />
                <a href="<?php echo base_url('miPerfil/6') ?>" class="d-block">Hola <?php echo $this->session->userdata['UserData']['Nombre'] ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview" id="liAcciones">
                    <a href="#" class="nav-link" id="linkAcciones">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                            Acciones de Personal
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('acciones/3') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon" id="linkAddAcciones"></i>
                                <p>Acciones de Personal</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview" id="liManuales">
                    <a href="#" class="nav-link" id="linkManuales">
                        <i class="nav-icon fas fa-file-pdf"></i>
                        <p>
                            Manuales de Puesto
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('manuales_adm/4') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manuales Administrativos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('manuales_out/5') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manuales Outsoursing</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview" id="liSeguridad">
                    <a href="#" class="nav-link" id="linkSeguridad">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>
                            Seguridad
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('usuarios/1') ?>" class="nav-link">
                                <i class="far fa-user nav-icon" id="linkUsuarios"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('perfiles/2') ?>" class="nav-link">
                                <i class="fa fa-cogs nav-icon" id="linkPerfiles"></i>
                                <p>Perfiles</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav> <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>