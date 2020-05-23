import myAlerts from "./myAlerts";
export default APP.miPerfil = (function() {
	let init = () => {
		menuOptionClick();
		let usuario = $("#UsuarioId").val();

		$("#usuarioIdPerfil").val(usuario);
		consultarDatosUsuario(usuario);

		$("#usuarioIdPerfil").change(function() {
			usuario = $("#usuarioIdPerfil").val();
			consultarDatosUsuario(usuario);
		});
	};
	let consultarDatosUsuario = usuario => {
		llenarTablaIncapacidadesUsuario(usuario);
		llenarTablaVacacionesUsuario(usuario);
		llenarTablaAusenciasUsuario(usuario);
		llenarTablaPermisosUsuario(usuario);
		consultarCalculoVacaciones(usuario);
	};
	let consultarCalculoVacaciones = usuario => {
		let parametros = {
			usuario: usuario
		};
		$.ajax({
			type: "POST",
			dataType: "json",
			url: base_url + "MiPerfilController/consultarCalculoVacaciones/",
			data: parametros,
			success: function(resp) {
				$("#disponibles").text(resp[0]._vacDisponibles);
				$("#acumuladas").text(resp[0]._vacAcumuladas);
				$("#disfrutadas").text(resp[0]._vacDisfrutadas);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert(errorThrown);
			}
		});
	};
	//********************************************************************************* */
	//	VACACIONES
	//********************************************************************************* */
	let llenarTablaVacacionesUsuario = usuario => {
		$("#tblVacaciones").DataTable({
			bDestroy: true,
			processing: true,
			ajax: {
				type: "POST",
				url:
					base_url + "/AccionesPersonalController/llenarTablaVacacionesUsuario",
				data: {
					usuario: usuario
				},
				dataSrc: "",
				error: function(jqXHR, textStatus, errorThrown) {
					$("#tblVacaciones")
						.DataTable()
						.clear()
						.draw();
				}
			},
			dom: "Bfrtip",
			columnDefs: [
				{
					targets: [6, 7, 8],
					visible: false,
					searchable: false
				}
			],
			columns: [
				{
					data: null,
					bSortable: false,
					mRender: function(data, type, full) {
						let span = "";
						if (data.estadoVacacion == 1)
							span = '<span class="right badge badge-primary">Pendiente</span>';
						else if (data.estadoVacacion == 2)
							span = '<span class="right badge badge-success">Aprobada</span>';
						else if (data.estadoVacacion == 3)
							span = '<span class="right badge badge-danger">Rechazada</span>';
						return span;
					}
				},
				{
					data: "fechaInicioVacacion"
				},
				{
					data: "fechaFinVacacion"
				},
				{
					data: "totalDiasVacacion"
				},
				{
					data: "usuarioNombre"
				},
				{
					data: "comentarioVacacion"
				},
				{
					data: "estadoVacacion"
				},
				{
					data: "vacacionId"
				},
				{
					data: "usuarioIdVacacion"
				}
			],
			buttons: [
				{
					text: '<i class="fa fa-sync"></i>',
					titleAttr: "Actualizar",
					action: function(e, dt, node, config) {
						llenarTablaVacaciones();
					}
				}
			]
		});
	};

	//********************************************************************************* */
	//	INCAPACIDADES
	//********************************************************************************* */
	let llenarTablaIncapacidadesUsuario = usuario => {
		$("#tblIncapacidades").DataTable({
			bDestroy: true,
			processing: true,
			ajax: {
				type: "POST",
				url:
					base_url +
					"/AccionesPersonalController/llenarTablaIncapacidadesUsuario",
				data: {
					usuario: usuario
				},
				dataSrc: "",
				error: function(jqXHR, textStatus, errorThrown) {
					$("#tblIncapacidades")
						.DataTable()
						.clear()
						.draw();
				}
			},
			dom: "Bfrtip",
			columnDefs: [
				{
					targets: [7, 8, 9],
					visible: false,
					searchable: false
				}
			],
			columns: [
				{
					data: null,
					bSortable: false,
					mRender: function(data, type, full) {
						let span = "";
						if (data.estadoIncapacidad == 1)
							span = '<span class="right badge badge-primary">Pendiente</span>';
						else if (data.estadoIncapacidad == 2)
							span = '<span class="right badge badge-success">Aprobada</span>';
						else if (data.estadoIncapacidad == 3)
							span = '<span class="right badge badge-danger">Rechazada</span>';
						return span;
					}
				},
				{
					data: "fechaInicioIncapacidad"
				},
				{
					data: "fechaFinIncapacidad"
				},
				{
					data: "totalDiasIncapacidad"
				},
				{
					data: "horasPrimerDiaIncapacidad"
				},
				{
					data: "usuarioNombre"
				},
				{
					data: "comentarioIncapacidad"
				},
				{
					data: "estadoIncapacidad"
				},
				{
					data: "incapacidadId"
				},
				{
					data: "usuarioIdIncapacidad"
				}
			],
			buttons: [
				{
					text: '<i class="fa fa-sync"></i>',
					titleAttr: "Actualizar",
					action: function(e, dt, node, config) {
						llenarTablaIncapacidades();
					}
				}
			]
		});
	};

	//********************************************************************************* */
	//	AUSENCIAS
	//********************************************************************************* */
	let llenarTablaAusenciasUsuario = usuario => {
		$("#tblAusencias").DataTable({
			bDestroy: true,
			processing: true,
			ajax: {
				type: "POST",
				url:
					base_url + "/AccionesPersonalController/llenarTablaAusenciasUsuario",
				data: {
					usuario: usuario
				},
				dataSrc: "",
				error: function(jqXHR, textStatus, errorThrown) {
					$("#tblAusencias")
						.DataTable()
						.clear()
						.draw();
				}
			},
			dom: "Bfrtip",
			columnDefs: [
				{
					targets: [7, 8, 9],
					visible: false,
					searchable: false
				}
			],
			columns: [
				{
					data: null,
					bSortable: false,
					mRender: function(data, type, full) {
						let span = "";
						if (data.estadoAusencia == 1)
							span = '<span class="right badge badge-primary">Pendiente</span>';
						else if (data.estadoAusencia == 2)
							span = '<span class="right badge badge-success">Aprobada</span>';
						else if (data.estadoAusencia == 3)
							span = '<span class="right badge badge-danger">Rechazada</span>';
						return span;
					}
				},
				{
					data: "fechaInicioAusencia"
				},
				{
					data: "fechaFinAusencia"
				},
				{
					data: "totalDiasAusencia"
				},
				{
					data: "horasPrimerDiaAusencia"
				},
				{
					data: "usuarioNombre"
				},
				{
					data: "comentarioAusencia"
				},
				{
					data: "estadoAusencia"
				},
				{
					data: "ausenciaId"
				},
				{
					data: "usuarioIdAusencia"
				}
			],
			buttons: [
				{
					text: '<i class="fa fa-sync"></i>',
					titleAttr: "Actualizar",
					action: function(e, dt, node, config) {
						llenarTablaAusencias();
					}
				}
			]
		});
	};

	//********************************************************************************* */
	//	PERMISOS
	//********************************************************************************* */
	let llenarTablaPermisosUsuario = usuario => {
		$("#tblPermisos").DataTable({
			bDestroy: true,
			processing: true,
			ajax: {
				type: "POST",
				url:
					base_url + "/AccionesPersonalController/llenarTablaPermisosUsuario",
				data: {
					usuario: usuario
				},
				dataSrc: "",
				error: function(jqXHR, textStatus, errorThrown) {
					$("#tblPermisos")
						.DataTable()
						.clear()
						.draw();
				}
			},
			dom: "Bfrtip",
			columnDefs: [
				{
					targets: [5, 9, 10, 11],
					visible: false,
					searchable: false
				}
			],
			columns: [
				{
					data: null,
					bSortable: false,
					mRender: function(data, type, full) {
						let span = "";
						if (data.estadoPermiso == 1)
							span = '<span class="right badge badge-primary">Pendiente</span>';
						else if (data.estadoPermiso == 2)
							span = '<span class="right badge badge-success">Aprobada</span>';
						else if (data.estadoPermiso == 3)
							span = '<span class="right badge badge-danger">Rechazada</span>';
						return span;
					}
				},
				{
					data: "fechaInicioPermiso"
				},
				{
					data: "fechaFinPermiso"
				},
				{
					data: "totalDiasPermiso"
				},
				{
					data: "horasPrimerDiaPermiso"
				},
				{
					data: "tipoPermisoPermiso"
				},
				{
					data: null,
					bSortable: false,
					mRender: function(data, type, full) {
						let permiso = "";
						if (data.tipoPermisoPermiso == 1) permiso = "Permiso con Goce";
						else permiso = "Permiso sin Goce";
						return permiso;
					}
				},
				{
					data: "usuarioNombre"
				},
				{
					data: "comentarioPermiso"
				},
				{
					data: "estadoPermiso"
				},
				{
					data: "permisoId"
				},
				{
					data: "usuarioIdPermiso"
				}
			],
			buttons: [
				{
					text: '<i class="fa fa-sync"></i>',
					titleAttr: "Actualizar",
					action: function(e, dt, node, config) {
						llenarTablaPermisos();
					}
				}
			]
		});
	};

	let menuOptionClick = () => {
		$("li a").removeClass("active");
		$("li").removeClass("menu-open");
		$("#liAcciones").addClass("menu-open");
		$("#linkAcciones").addClass("active");
		$("#linkAddAcciones").addClass("active");
	};

	return {
		init: init
	};
})();
