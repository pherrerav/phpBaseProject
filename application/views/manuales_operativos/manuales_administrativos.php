<?php $this->load->view('includes/header.php') ?>
<link rel="stylesheet" href="<?php echo base_url('assets/dist/librerias/dropzone/dropzone.css') ?>">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manuales Administrativos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Manuales</a></li>
                        <li class="breadcrumb-item active">Manuales Adm</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="DataTables" class="table table-bordered table-striped display compact" width="100%">
                                <thead>
                                    <tr>
                                        <th>Manual</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div class="modal fade bs-example-modal-lg" id="manualModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Cargar Manuales Administrativos</h5>
                                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class='content'>
                                                <!-- Dropzone -->
                                                <div id="my-dropzone" class="dropzone">
                                                    <div class="dz-message" align="center">
                                                        <h3>Arrastre los archivos</h3> ó <strong>haga clic</strong> para cargar.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- /.control-sidebar -->
<?php $this->load->view('includes/footer.php') ?>
<script src="<?php echo base_url('assets/dist/librerias/dropzone/dropzone.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        APP.manualesAdmin.init();
    });

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#my-dropzone", {
        url: base_url + "ManualesController/do_Upload/administrativo",
        acceptedFiles: ".doc,.docx,.pdf,.xls,.xlsx",
        autoProcessQueue: true,
        maxFilesize: 5,
        addRemoveLinks: true,
        parallelUploads: 20,

        removedFiles: function(file) {
            let name = file.name;
            $.ajax({
                type: "post",
                url: base_url + "ManualesController/Remove/administrativo",
                data: {
                    file: name
                },
                dataType: "html"
            });
        }
    });
</script>