import myAlerts from "./myAlerts";
export default APP.accionesPersonal = (function () {
	let init = () => {
		menuOptionClick();
		llenarTablaIncapacidades();
		llenarTablaVacaciones();
		llenarTablaAusencias();
		llenarTablaPermisos();
		actionsHandler();
	};

	let actionsHandler = () => {
		document
			.getElementById("vacacionForm")
			.addEventListener("submit", function (e) {
				e.preventDefault();
				ValidarFormularioVacacion();
				if ($("#vacacionForm").valid()) {
					if (!$("#vacacionId").val()) GuardarVacacion();
					else ModificarVacacion();
				}
			});
		document
			.getElementById("incapacidadForm")
			.addEventListener("submit", function (e) {
				e.preventDefault();
				ValidarFormularioIncapacidad();
				if ($("#incapacidadForm").valid()) {
					if (!$("#incapacidadId").val()) GuardarIncapacidad();
					else ModificarIncapacidad();
				}
			});
		document
			.getElementById("ausenciaForm")
			.addEventListener("submit", function (e) {
				e.preventDefault();
				ValidarFormularioAusencia();
				if ($("#ausenciaForm").valid()) {
					if (!$("#ausenciaId").val()) GuardarAusencia();
					else ModificarAusencia();
				}
			});
		document
			.getElementById("permisoForm")
			.addEventListener("submit", function (e) {
				e.preventDefault();
				ValidarFormularioPermiso();
				if ($("#permisoForm").valid()) {
					if (!$("#permisoId").val()) GuardarPermiso();
					else ModificarPermiso();
				}
			});
	};
	//********************************************************************************* */
	//	VACACIONES
	//********************************************************************************* */
	let llenarTablaVacaciones = () => {
		$("#fechaInicioVacacion").datepicker({ dateFormat: "yy-mm-dd" }).val();
		$("#fechaFinVacacion").datepicker({ dateFormat: "yy-mm-dd" }).val();

		$("#tblVacaciones").DataTable({
			bDestroy: true,
			processing: true,
			ajax: {
				url: base_url + "/AccionesPersonalController/llenarTablaVacaciones",
				dataSrc: "",
				error: function (jqXHR, textStatus, errorThrown) {
					$("#tblVacaciones").DataTable().clear().draw();
				},
			},
			dom: "Bfrtip",
			columnDefs: [
				{
					targets: [9],
					searchable: false,
				},
				{
					targets: [6, 7, 8],
					visible: false,
					searchable: false,
				},
			],
			columns: [
				{
					data: null,
					bSortable: false,
					mRender: function (data, type, full) {
						let span = "";
						if (data.estadoVacacion == 1)
							span = '<span class="right badge badge-primary">Pendiente</span>';
						else if (data.estadoVacacion == 2)
							span = '<span class="right badge badge-success">Aprobada</span>';
						else if (data.estadoVacacion == 3)
							span = '<span class="right badge badge-danger">Rechazada</span>';
						return span;
					},
				},
				{
					data: "fechaInicioVacacion",
				},
				{
					data: "fechaFinVacacion",
				},
				{
					data: "totalDiasVacacion",
				},
				{
					data: "usuarioNombre",
				},
				{
					data: "comentarioVacacion",
				},
				{
					data: "estadoVacacion",
				},
				{
					data: "vacacionId",
				},
				{
					data: "usuarioIdVacacion",
				},
				{
					data: null,
					bSortable: false,
					mRender: function (data, type, full) {
						let perfil = $("#PerfilId").val();
						if (data.estadoVacacion == 1 && perfil == 1) {
							let botones =
								'<button title="Editar" name ="editarV" class="btn btn-info btn-sm"><i class="fa fa-edit fa-sm"></i></button> <button  title="Aprobar" name ="aprobarV" class="btn btn-success btn-sm"><i class="fa fa-thumbs-up fa-sm"></i></button> <button title="Denegar" name ="denegarV" class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down fa-sm"></i></button> <button title="Pendiente" name ="pendienteV" class="btn btn-primary btn-sm"><i class="fa fa-backspace fa-sm"></i></button> ';
							return botones;
						} else if (data.estadoVacacion != 1 && perfil == 1) {
							let botones =
								'<button  name ="aprobarV" title="Aprobar" class="btn btn-success btn-sm"><i class="fa fa-thumbs-up fa-sm"></i></button> <button title="Denegar"  name ="denegarV" class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down fa-sm"></i> </button> <button title="Pendiente" name ="pendienteV" class="btn btn-primary btn-sm"><i class="fa fa-backspace fa-sm"></i></button> ';
							return botones;
						} else if (data.estadoVacacion == 1 && perfil != 1) {
							let botones =
								'<button  name ="editarV" title="Editar" class="btn btn-info btn-sm"><i class="fa fa-edit fa-sm"></i></button>';
							return botones;
						} else return "";
					},
				},
			],
			buttons: [
				{
					text: '<i class="fa fa-plus"></i>',
					titleAttr: "Nueva Vacación",
					action: function (e, dt, node, config) {
						$("#vacacionForm")[0].reset();
						$("#vacacionModal").modal();
					},
				},
				{
					text: '<i class="fa fa-sync"></i>',
					titleAttr: "Actualizar",
					action: function (e, dt, node, config) {
						llenarTablaVacaciones();
					},
				},
			],
		});
		$("#tblVacaciones tbody").on("click", "button", function () {
			let table = $("#tblVacaciones").DataTable();
			let action = this.name;
			let data = table.row($(this).parents("tr")).data();
			let id = data.vacacionId;
			if (action.substring(0, 6) == "editar") {
				llenarFormulario(data);
				$("#vacacionModal").modal();
			} else if (action.substring(0, 7) == "aprobar")
				actualizarEstado(2, id, 1);
			else if (action.substring(0, 7) == "denegar") actualizarEstado(3, id, 1);
			else if (action.substring(0, 9) == "pendiente")
				actualizarEstado(1, id, 1);
		});
	};

	let GuardarVacacion = () => {
		var parametros = {
			usuarioIdVacacion: $("#usuarioIdVacacion").val(),
			fechaInicioVacacion: $("#fechaInicioVacacion").val(),
			fechaFinVacacion: $("#fechaFinVacacion").val(),
			totalDiasVacacion: $("#totalDiasVacacion").val(),
			comentarioVacacion: $("#comentarioVacacion").val(),
		};
		$.ajax({
			type: "POST",
			dataType: "text",
			url: base_url + "AccionesPersonalController/agregarVacacion/",
			data: parametros,
			success: function (respuesta) {
				if (respuesta == -1) {
					myAlerts.myAlerts(
						"El registro no pudo ser almacenado",
						"Error",
						"error"
					);
				} else if (respuesta == -2)
					myAlerts.myAlerts(
						"Las fechas se traslapan con un registro existente",
						"Error",
						"error"
					);
				else if (respuesta == 1) {
					$("#vacacionForm")[0].reset();
					$("#vacacionModal").modal("hide");
					llenarTablaVacaciones();
					myAlerts.myAlerts(
						"Registro almacenado satisfactoriamente",
						"Guardado",
						"success"
					);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(errorThrown);
			},
		});
	};
	let ModificarVacacion = () => {
		var parametros = {
			vacacionId: $("#vacacionId").val(),
			usuarioIdVacacion: $("#usuarioIdVacacion").val(),
			fechaInicioVacacion: $("#fechaInicioVacacion").val(),
			fechaFinVacacion: $("#fechaFinVacacion").val(),
			totalDiasVacacion: $("#totalDiasVacacion").val(),
			comentarioVacacion: $("#comentarioVacacion").val(),
		};
		$.ajax({
			type: "POST",
			dataType: "text",
			url: base_url + "AccionesPersonalController/modificarVacacion/",
			data: parametros,
			success: function (respuesta) {
				if (respuesta == -1) {
					myAlerts.myAlerts(
						"El registro no pudo ser modificado",
						"Error",
						"error"
					);
				} else if (respuesta == -2)
					myAlerts.myAlerts(
						"Las fechas se traslapan con un registro existente",
						"Error",
						"error"
					);
				else if (respuesta == 1) {
					$("#vacacionForm")[0].reset();
					$("#vacacionModal").modal("hide");
					llenarTablaVacaciones();
					myAlerts.myAlerts(
						"Registro modificado satisfactoriamente",
						"Modificado",
						"success"
					);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(errorThrown);
			},
		});
	};
	let ValidarFormularioVacacion = () => {
		$("#vacacionForm").validate({
			errorElement: "div",
			errorClass: "help-block",
			focusInvalid: false,
			ignore: "",
			rules: {
				usuarioVacacion: {
					required: true,
				},
				fechaInicioVacacion: {
					required: true,
				},
				fechaFinVacacion: {
					required: true,
				},
				totalDiasVacacion: {
					required: true,
					number: true,
					min: 1,
				},
			},
			messages: {
				usuarioVacacion: "El campo es obligatorio.",
				fechaInicioVacacion: {
					required: "El campo es obligatorio.",
					date: "El formato de la fecha no es correcto",
				},
				fechaFinVacacion: {
					required: "El campo es obligatorio.",
					date: "El formato de la fecha no es correcto",
				},
				totalDiasVacacion: {
					required: "El campo es obligatorio.",
					number: "El dato debe ser numérico",
					min: "El mínimo debe ser 1",
				},
			},
			highlight: function (e) {
				$(e)
					.closest(".form-group")
					.removeClass("has-info")
					.addClass("has-error");
			},
			success: function (e) {
				$(e).closest(".form-group").removeClass("has-error"); //.addClass('has-info');
				$(e).remove();
			},
			errorPlacement: function (error, element) {
				var name = element.attr("name");
				var errorSelector = '.validation_error_message[for="' + name + '"]';
				var $element = $(errorSelector);
				if ($element.length) {
					$(errorSelector).html(error.html());
				} else {
					error.insertAfter(element);
				}
			},
		});
	};
	//********************************************************************************* */
	//	INCAPACIDADES
	//********************************************************************************* */
	let llenarTablaIncapacidades = () => {
		$("#fechaInicioIncapacidad").datepicker({ dateFormat: "yy-mm-dd" }).val();
		$("#fechaFinIncapacidad").datepicker({ dateFormat: "yy-mm-dd" }).val();

		$("#tblIncapacidades").DataTable({
			bDestroy: true,
			processing: true,
			ajax: {
				url: base_url + "/AccionesPersonalController/llenarTablaIncapacidades",
				dataSrc: "",
				error: function (jqXHR, textStatus, errorThrown) {
					$("#tblIncapacidades").DataTable().clear().draw();
				},
			},
			dom: "Bfrtip",
			columnDefs: [
				{
					targets: [10],
					searchable: false,
				},
				{
					targets: [7, 8, 9],
					visible: false,
					searchable: false,
				},
			],
			columns: [
				{
					data: null,
					bSortable: false,
					mRender: function (data, type, full) {
						let span = "";
						if (data.estadoIncapacidad == 1)
							span = '<span class="right badge badge-primary">Pendiente</span>';
						else if (data.estadoIncapacidad == 2)
							span = '<span class="right badge badge-success">Aprobada</span>';
						else if (data.estadoIncapacidad == 3)
							span = '<span class="right badge badge-danger">Rechazada</span>';
						return span;
					},
				},
				{
					data: "fechaInicioIncapacidad",
				},
				{
					data: "fechaFinIncapacidad",
				},
				{
					data: "totalDiasIncapacidad",
				},
				{
					data: "horasPrimerDiaIncapacidad",
				},
				{
					data: "usuarioNombre",
				},
				{
					data: "comentarioIncapacidad",
				},
				{
					data: "estadoIncapacidad",
				},
				{
					data: "incapacidadId",
				},
				{
					data: "usuarioIdIncapacidad",
				},
				{
					data: null,
					bSortable: false,
					mRender: function (data, type, full) {
						let perfil = $("#PerfilId").val();
						if (data.estadoIncapacidad == 1 && perfil == 1) {
							let botones =
								'<button title="Editar" name ="editarI" class="btn btn-info btn-sm"><i class="fa fa-edit fa-sm"></i></button> <button  title="Aprobar" name ="aprobarI" class="btn btn-success btn-sm"><i class="fa fa-thumbs-up fa-sm"></i></button> <button title="Denegar" name ="denegarI" class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down fa-sm"></i></button> <button title="Pendiente" name ="pendienteI" class="btn btn-primary btn-sm"><i class="fa fa-backspace fa-sm"></i></button> ';
							return botones;
						} else if (data.estadoIncapacidad != 1 && perfil == 1) {
							let botones =
								'<button  name ="aprobarI" title="Aprobar" class="btn btn-success btn-sm"><i class="fa fa-thumbs-up fa-sm"></i></button> <button title="Denegar"  name ="denegarI" class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down fa-sm"></i> </button> <button title="Pendiente" name ="pendienteI" class="btn btn-primary btn-sm"><i class="fa fa-backspace fa-sm"></i></button> ';
							return botones;
						} else if (data.estadoIncapacidad == 1 && perfil != 1) {
							let botones =
								'<button  name ="editarI" title="Editar" class="btn btn-info btn-sm"><i class="fa fa-edit fa-sm"></i></button>';
							return botones;
						} else return "";
					},
				},
			],
			buttons: [
				{
					text: '<i class="fa fa-plus"></i>',
					titleAttr: "Nueva Incapacidad",
					action: function (e, dt, node, config) {
						$("#incapacidadForm")[0].reset();
						$("#incapacidadModal").modal();
					},
				},
				{
					text: '<i class="fa fa-sync"></i>',
					titleAttr: "Actualizar",
					action: function (e, dt, node, config) {
						llenarTablaIncapacidades();
					},
				},
			],
		});
		$("#tblIncapacidades tbody").on("click", "button", function () {
			let table = $("#tblIncapacidades").DataTable();
			let action = this.name;
			let data = table.row($(this).parents("tr")).data();
			let id = data.incapacidadId;
			if (action.substring(0, 6) == "editar") {
				llenarFormulario(data);
				$("#incapacidadModal").modal();
			} else if (action.substring(0, 7) == "aprobar")
				actualizarEstado(2, id, 2);
			else if (action.substring(0, 7) == "denegar") actualizarEstado(3, id, 2);
			else if (action.substring(0, 9) == "pendiente")
				actualizarEstado(1, id, 2);
		});
	};
	let GuardarIncapacidad = () => {
		var parametros = {
			usuarioIdIncapacidad: $("#usuarioIdIncapacidad").val(),
			fechaInicioIncapacidad: $("#fechaInicioIncapacidad").val(),
			fechaFinIncapacidad: $("#fechaFinIncapacidad").val(),
			horasPrimerDiaIncapacidad: $("#horasPrimerDiaIncapacidad").val(),
			totalDiasIncapacidad: $("#totalDiasIncapacidad").val(),
			comentarioIncapacidad: $("#comentarioIncapacidad").val(),
		};
		$.ajax({
			type: "POST",
			dataType: "text",
			url: base_url + "AccionesPersonalController/agregarIncapacidad/",
			data: parametros,
			success: function (respuesta) {
				if (respuesta == -1) {
					myAlerts.myAlerts(
						"El registro no pudo ser almacenado",
						"Error",
						"error"
					);
				} else if (respuesta == -2)
					myAlerts.myAlerts(
						"Las fechas se traslapan con un registro existente",
						"Error",
						"error"
					);
				else if (respuesta == 1) {
					$("#incapacidadForm")[0].reset();
					$("#incapacidadModal").modal("hide");
					llenarTablaIncapacidades();
					myAlerts.myAlerts(
						"Registro almacenado satisfactoriamente",
						"Guardado",
						"success"
					);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(errorThrown);
			},
		});
	};
	let ModificarIncapacidad = () => {
		var parametros = {
			incapacidadId: $("#incapacidadId").val(),
			usuarioIdIncapacidad: $("#usuarioIdIncapacidad").val(),
			fechaInicioIncapacidad: $("#fechaInicioIncapacidad").val(),
			fechaFinIncapacidad: $("#fechaFinIncapacidad").val(),
			horasPrimerDiaIncapacidad: $("#horasPrimerDiaIncapacidad").val(),
			totalDiasIncapacidad: $("#totalDiasIncapacidad").val(),
			comentarioIncapacidad: $("#comentarioIncapacidad").val(),
		};
		$.ajax({
			type: "POST",
			dataType: "text",
			url: base_url + "AccionesPersonalController/modificarIncapacidad/",
			data: parametros,
			success: function (respuesta) {
				if (respuesta == -1) {
					myAlerts.myAlerts(
						"El registro no pudo ser modificado",
						"Error",
						"error"
					);
				} else if (respuesta == -2)
					myAlerts.myAlerts(
						"Las fechas se traslapan con un registro existente",
						"Error",
						"error"
					);
				else if (respuesta == 1) {
					$("#incapacidadForm")[0].reset();
					$("#incapacidadModal").modal("hide");
					llenarTablaIncapacidades();
					myAlerts.myAlerts(
						"Registro almacenado satisfactoriamente",
						"Modificado",
						"success"
					);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(errorThrown);
			},
		});
	};
	let ValidarFormularioIncapacidad = () => {
		$("#incapacidadForm").validate({
			errorElement: "div",
			errorClass: "help-block",
			focusInvalid: false,
			ignore: "",
			rules: {
				usuarioIncapacidad: {
					required: true,
				},
				fechaInicioIncapacidad: {
					required: true,
				},
				fechaFinIncapacidad: {
					required: true,
				},
				horasPrimerDiaIncapacidad: {
					required: true,
					number: true,
				},
				totalDiasIncapacidad: {
					required: true,
					number: true,
				},
			},
			messages: {
				usuarioIncapacidad: "El campo es obligatorio.",
				fechaInicioIncapacidad: {
					required: "El campo es obligatorio.",
					date: "El formato de la fecha no es correcto",
				},
				fechaFinIncapacidad: {
					required: "El campo es obligatorio.",
					date: "El formato de la fecha no es correcto",
				},
				horasPrimerDiaIncapacidad: {
					required: "El campo es obligatorio.",
					number: "El dato debe ser numérico",
				},
				totalDiasIncapacidad: {
					required: "El campo es obligatorio.",
					number: "El dato debe ser numérico",
				},
			},
			highlight: function (e) {
				$(e)
					.closest(".form-group")
					.removeClass("has-info")
					.addClass("has-error");
			},
			success: function (e) {
				$(e).closest(".form-group").removeClass("has-error"); //.addClass('has-info');
				$(e).remove();
			},
			errorPlacement: function (error, element) {
				var name = element.attr("name");
				var errorSelector = '.validation_error_message[for="' + name + '"]';
				var $element = $(errorSelector);
				if ($element.length) {
					$(errorSelector).html(error.html());
				} else {
					error.insertAfter(element);
				}
			},
		});
	};
	//********************************************************************************* */
	//	AUSENCIAS
	//********************************************************************************* */
	let llenarTablaAusencias = () => {
		$("#fechaInicioAusencia").datepicker({ dateFormat: "yy-mm-dd" }).val();
		$("#fechaFinAusencia").datepicker({ dateFormat: "yy-mm-dd" }).val();

		$("#tblAusencias").DataTable({
			bDestroy: true,
			processing: true,
			ajax: {
				url: base_url + "/AccionesPersonalController/llenarTablaAusencias",
				dataSrc: "",
				error: function (jqXHR, textStatus, errorThrown) {
					$("#tblAusencias").DataTable().clear().draw();
				},
			},
			dom: "Bfrtip",
			columnDefs: [
				{
					targets: [10],
					searchable: false,
				},
				{
					targets: [7, 8, 9],
					visible: false,
					searchable: false,
				},
			],
			columns: [
				{
					data: null,
					bSortable: false,
					mRender: function (data, type, full) {
						let span = "";
						if (data.estadoAusencia == 1)
							span = '<span class="right badge badge-primary">Pendiente</span>';
						else if (data.estadoAusencia == 2)
							span = '<span class="right badge badge-success">Aprobada</span>';
						else if (data.estadoAusencia == 3)
							span = '<span class="right badge badge-danger">Rechazada</span>';
						return span;
					},
				},
				{
					data: "fechaInicioAusencia",
				},
				{
					data: "fechaFinAusencia",
				},
				{
					data: "totalDiasAusencia",
				},
				{
					data: "horasPrimerDiaAusencia",
				},
				{
					data: "usuarioNombre",
				},
				{
					data: "comentarioAusencia",
				},
				{
					data: "estadoAusencia",
				},
				{
					data: "ausenciaId",
				},
				{
					data: "usuarioIdAusencia",
				},
				{
					data: null,
					bSortable: false,
					mRender: function (data, type, full) {
						let perfil = $("#PerfilId").val();
						if (data.estadoAusencia == 1 && perfil == 1) {
							let botones =
								'<button title="Editar" name ="editarA" class="btn btn-info btn-sm"><i class="fa fa-edit fa-sm"></i></button> <button  title="Aprobar" name ="aprobarA" class="btn btn-success btn-sm"><i class="fa fa-thumbs-up fa-sm"></i></button> <button title="Denegar" name ="denegarA" class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down fa-sm"></i></button> <button title="Pendiente" name ="pendienteA" class="btn btn-primary btn-sm"><i class="fa fa-backspace fa-sm"></i></button> ';
							return botones;
						} else if (data.estadoAusencia != 1 && perfil == 1) {
							let botones =
								'<button  name ="aprobarA" title="Aprobar" class="btn btn-success btn-sm"><i class="fa fa-thumbs-up fa-sm"></i></button> <button title="Denegar"  name ="denegarA" class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down fa-sm"></i> </button> <button title="Pendiente" name ="pendienteA" class="btn btn-primary btn-sm"><i class="fa fa-backspace fa-sm"></i></button> ';
							return botones;
						} else if (data.estadoAusencia == 1 && perfil != 1) {
							let botones =
								'<button  name ="editarA" title="Editar" class="btn btn-info btn-sm"><i class="fa fa-edit fa-sm"></i></button>';
							return botones;
						} else return "";
					},
				},
			],
			buttons: [
				{
					text: '<i class="fa fa-plus"></i>',
					titleAttr: "Nueva Ausencia",
					action: function (e, dt, node, config) {
						$("#ausenciaForm")[0].reset();
						$("#ausenciaModal").modal();
					},
				},
				{
					text: '<i class="fa fa-sync"></i>',
					titleAttr: "Actualizar",
					action: function (e, dt, node, config) {
						llenarTablaAusencias();
					},
				},
			],
		});
		$("#tblAusencias tbody").on("click", "button", function () {
			let table = $("#tblAusencias").DataTable();
			let action = this.name;
			let data = table.row($(this).parents("tr")).data();
			let id = data.ausenciaId;
			if (action.substring(0, 6) == "editar") {
				llenarFormulario(data);
				$("#ausenciaModal").modal();
			} else if (action.substring(0, 7) == "aprobar")
				actualizarEstado(2, id, 3);
			else if (action.substring(0, 7) == "denegar") actualizarEstado(3, id, 3);
			else if (action.substring(0, 9) == "pendiente")
				actualizarEstado(1, id, 3);
		});
	};
	let GuardarAusencia = () => {
		var parametros = {
			usuarioIdAusencia: $("#usuarioIdAusencia").val(),
			fechaInicioAusencia: $("#fechaInicioAusencia").val(),
			fechaFinAusencia: $("#fechaFinAusencia").val(),
			horasPrimerDiaAusencia: $("#horasPrimerDiaAusencia").val(),
			totalDiasAusencia: $("#totalDiasAusencia").val(),
			comentarioAusencia: $("#comentarioAusencia").val(),
		};
		$.ajax({
			type: "POST",
			dataType: "text",
			url: base_url + "AccionesPersonalController/agregarAusencia/",
			data: parametros,
			success: function (respuesta) {
				if (respuesta == -1) {
					myAlerts.myAlerts(
						"El registro no pudo ser almacenado",
						"Error",
						"error"
					);
				} else if (respuesta == -2)
					myAlerts.myAlerts(
						"Las fechas se traslapan con un registro existente",
						"Error",
						"error"
					);
				else if (respuesta == 1) {
					$("#ausenciaForm")[0].reset();
					$("#ausenciaModal").modal("hide");
					llenarTablaAusencias();
					myAlerts.myAlerts(
						"Registro almacenado satisfactoriamente",
						"Guardado",
						"success"
					);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(errorThrown);
			},
		});
	};
	let ModificarAusencia = () => {
		var parametros = {
			ausenciaId: $("#ausenciaId").val(),
			usuarioIdAusencia: $("#usuarioIdAusencia").val(),
			fechaInicioAusencia: $("#fechaInicioAusencia").val(),
			fechaFinAusencia: $("#fechaFinAusencia").val(),
			horasPrimerDiaAusencia: $("#horasPrimerDiaAusencia").val(),
			totalDiasAusencia: $("#totalDiasAusencia").val(),
			comentarioAusencia: $("#comentarioAusencia").val(),
		};
		$.ajax({
			type: "POST",
			dataType: "text",
			url: base_url + "AccionesPersonalController/modificarAusencia/",
			data: parametros,
			success: function (respuesta) {
				if (respuesta == -1) {
					myAlerts.myAlerts(
						"El registro no pudo ser modificado",
						"Error",
						"error"
					);
				} else if (respuesta == -2)
					myAlerts.myAlerts(
						"Las fechas se traslapan con un registro existente",
						"Error",
						"error"
					);
				else if (respuesta == 1) {
					$("#ausenciaForm")[0].reset();
					$("#ausenciaModal").modal("hide");
					llenarTablaAusencias();
					myAlerts.myAlerts(
						"Registro almacenado satisfactoriamente",
						"Modificado",
						"success"
					);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(errorThrown);
			},
		});
	};
	let ValidarFormularioAusencia = () => {
		$("#AusenciaForm").validate({
			errorElement: "div",
			errorClass: "help-block",
			focusInvalid: false,
			ignore: "",
			rules: {
				usuarioAusencia: {
					required: true,
				},
				fechaInicioAusencia: {
					required: true,
				},
				fechaFinAusencia: {
					required: true,
				},
				horasPrimerDiaAusencia: {
					required: true,
					number: true,
				},
				totalDiasAusencia: {
					required: true,
					number: true,
				},
			},
			messages: {
				usuarioAusencia: "El campo es obligatorio.",
				fechaInicioAusencia: {
					required: "El campo es obligatorio.",
					date: "El formato de la fecha no es correcto",
				},
				fechaFinAusencia: {
					required: "El campo es obligatorio.",
					date: "El formato de la fecha no es correcto",
				},
				horasPrimerDiaAusencia: {
					required: "El campo es obligatorio.",
					number: "El dato debe ser numérico",
				},
				totalDiasAusencia: {
					required: "El campo es obligatorio.",
					number: "El dato debe ser numérico",
				},
			},
			highlight: function (e) {
				$(e)
					.closest(".form-group")
					.removeClass("has-info")
					.addClass("has-error");
			},
			success: function (e) {
				$(e).closest(".form-group").removeClass("has-error"); //.addClass('has-info');
				$(e).remove();
			},
			errorPlacement: function (error, element) {
				var name = element.attr("name");
				var errorSelector = '.validation_error_message[for="' + name + '"]';
				var $element = $(errorSelector);
				if ($element.length) {
					$(errorSelector).html(error.html());
				} else {
					error.insertAfter(element);
				}
			},
		});
	};
	//********************************************************************************* */
	//	PERMISOS
	//********************************************************************************* */
	let llenarTablaPermisos = () => {
		$("#fechaInicioPermiso").datepicker({ dateFormat: "yy-mm-dd" }).val();
		$("#fechaFinPermiso").datepicker({ dateFormat: "yy-mm-dd" }).val();

		$("#tblPermisos").DataTable({
			bDestroy: true,
			processing: true,
			ajax: {
				url: base_url + "/AccionesPersonalController/llenarTablaPermisos",
				dataSrc: "",
				error: function (jqXHR, textStatus, errorThrown) {
					$("#tblPermisos").DataTable().clear().draw();
				},
			},
			dom: "Bfrtip",
			columnDefs: [
				{
					targets: [12],
					searchable: false,
				},
				{
					targets: [5, 9, 10, 11],
					visible: false,
					searchable: false,
				},
			],
			columns: [
				{
					data: null,
					bSortable: false,
					mRender: function (data, type, full) {
						let span = "";
						if (data.estadoPermiso == 1)
							span = '<span class="right badge badge-primary">Pendiente</span>';
						else if (data.estadoPermiso == 2)
							span = '<span class="right badge badge-success">Aprobada</span>';
						else if (data.estadoPermiso == 3)
							span = '<span class="right badge badge-danger">Rechazada</span>';
						return span;
					},
				},
				{
					data: "fechaInicioPermiso",
				},
				{
					data: "fechaFinPermiso",
				},
				{
					data: "totalDiasPermiso",
				},
				{
					data: "horasPrimerDiaPermiso",
				},
				{
					data: "tipoPermisoPermiso",
				},
				{
					data: null,
					bSortable: false,
					mRender: function (data, type, full) {
						let permiso = "";
						if (data.tipoPermisoPermiso == 1) permiso = "Permiso con Goce";
						else permiso = "Permiso sin Goce";
						return permiso;
					},
				},
				{
					data: "usuarioNombre",
				},
				{
					data: "comentarioPermiso",
				},
				{
					data: "estadoPermiso",
				},
				{
					data: "permisoId",
				},
				{
					data: "usuarioIdPermiso",
				},
				{
					data: null,
					bSortable: false,
					mRender: function (data, type, full) {
						let perfil = $("#PerfilId").val();
						if (data.estadoPermiso == 1 && perfil == 1) {
							let botones =
								'<button title="Editar" name ="editarP" class="btn btn-info btn-sm"><i class="fa fa-edit fa-sm"></i></button> <button  title="Aprobar" name ="aprobarP" class="btn btn-success btn-sm"><i class="fa fa-thumbs-up fa-sm"></i></button> <button title="Denegar" name ="denegarP" class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down fa-sm"></i></button> <button title="Pendiente" name ="pendienteP" class="btn btn-primary btn-sm"><i class="fa fa-backspace fa-sm"></i></button> ';
							return botones;
						} else if (data.estadoPermiso != 1 && perfil == 1) {
							let botones =
								'<button  name ="aprobarP" title="Aprobar" class="btn btn-success btn-sm"><i class="fa fa-thumbs-up fa-sm"></i></button> <button title="Denegar"  name ="denegarP" class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down fa-sm"></i></button> <button title="Pendiente" name ="pendienteP" class="btn btn-primary btn-sm"><i class="fa fa-backspace fa-sm"></i></button> ';
							return botones;
						} else if (data.estadoPermiso == 1 && perfil != 1) {
							let botones =
								'<button  name ="editarP" title="Editar" class="btn btn-info btn-sm"><i class="fa fa-edit fa-sm"></i></button>';
							return botones;
						} else return "";
					},
				},
			],
			buttons: [
				{
					text: '<i class="fa fa-plus"></i>',
					titleAttr: "Nueva Permiso",
					action: function (e, dt, node, config) {
						$("#permisoForm")[0].reset();
						$("#permisoModal").modal();
					},
				},
				{
					text: '<i class="fa fa-sync"></i>',
					titleAttr: "Actualizar",
					action: function (e, dt, node, config) {
						llenarTablaPermisos();
					},
				},
			],
		});
		$("#tblPermisos tbody").on("click", "button", function () {
			let table = $("#tblPermisos").DataTable();
			let action = this.name;
			let data = table.row($(this).parents("tr")).data();
			let id = data.permisoId;
			if (action.substring(0, 6) == "editar") {
				$("#btnGuardarPermiso").show();
				llenarFormulario(data);
				$("#permisoModal").modal();
			} else if (action.substring(0, 7) == "aprobar")
				actualizarEstado(2, id, 4);
			else if (action.substring(0, 7) == "denegar") actualizarEstado(3, id, 4);
			else if (action.substring(0, 9) == "pendiente")
				actualizarEstado(1, id, 4);
		});
	};
	let GuardarPermiso = () => {
		var parametros = {
			usuarioIdPermiso: $("#usuarioIdPermiso").val(),
			fechaInicioPermiso: $("#fechaInicioPermiso").val(),
			fechaFinPermiso: $("#fechaFinPermiso").val(),
			horasPrimerDiaPermiso: $("#horasPrimerDiaPermiso").val(),
			totalDiasPermiso: $("#totalDiasPermiso").val(),
			comentarioPermiso: $("#comentarioPermiso").val(),
			tipoPermisoPermiso: $("#tipoPermisoPermiso").val(),
		};
		$.ajax({
			type: "POST",
			dataType: "text",
			url: base_url + "AccionesPersonalController/agregarPermiso/",
			data: parametros,
			success: function (respuesta) {
				if (respuesta == -1) {
					myAlerts.myAlerts(
						"El registro no pudo ser almacenado",
						"Error",
						"error"
					);
				} else if (respuesta == -2)
					myAlerts.myAlerts(
						"Las fechas se traslapan con un registro existente",
						"Error",
						"error"
					);
				else if (respuesta == 1) {
					$("#permisoForm")[0].reset();
					$("#permisoModal").modal("hide");
					llenarTablaPermisos();
					myAlerts.myAlerts(
						"Registro almacenado satisfactoriamente",
						"Guardado",
						"success"
					);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(errorThrown);
			},
		});
	};
	let ModificarPermiso = () => {
		var parametros = {
			permisoId: $("#permisoId").val(),
			usuarioIdPermiso: $("#usuarioIdPermiso").val(),
			fechaInicioPermiso: $("#fechaInicioPermiso").val(),
			fechaFinPermiso: $("#fechaFinPermiso").val(),
			horasPrimerDiaPermiso: $("#horasPrimerDiaPermiso").val(),
			totalDiasPermiso: $("#totalDiasPermiso").val(),
			comentarioPermiso: $("#comentarioPermiso").val(),
			tipoPermisoPermiso: $("#tipoPermisoPermiso").val(),
		};
		$.ajax({
			type: "POST",
			dataType: "text",
			url: base_url + "AccionesPersonalController/modificarPermiso/",
			data: parametros,
			success: function (respuesta) {
				if (respuesta == -1) {
					myAlerts.myAlerts(
						"El registro no pudo ser modificado",
						"Error",
						"error"
					);
				} else if (respuesta == -2)
					myAlerts.myAlerts(
						"Las fechas se traslapan con un registro existente",
						"Error",
						"error"
					);
				else if (respuesta == 1) {
					$("#permisoForm")[0].reset();
					$("#permisoModal").modal("hide");
					llenarTablaPermisos();
					myAlerts.myAlerts(
						"Registro almacenado satisfactoriamente",
						"Modificado",
						"success"
					);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(errorThrown);
			},
		});
	};
	let ValidarFormularioPermiso = () => {
		$("#permisoForm").validate({
			errorElement: "div",
			errorClass: "help-block",
			focusInvalid: false,
			ignore: "",
			rules: {
				usuarioPermiso: {
					required: true,
				},
				fechaInicioPermiso: {
					required: true,
				},
				fechaFinPermiso: {
					required: true,
				},
				tipoPermisoPermiso: {
					required: true,
				},
				horasPrimerDiaPermiso: {
					required: true,
					number: true,
				},
				totalDiasPermiso: {
					required: true,
					number: true,
				},
			},
			messages: {
				usuarioPermiso: "El campo es obligatorio.",
				tipoPermisoPermiso: "El campo es obligatorio.",
				fechaInicioPermiso: {
					required: "El campo es obligatorio.",
					date: "El formato de la fecha no es correcto",
				},
				fechaFinPermiso: {
					required: "El campo es obligatorio.",
					date: "El formato de la fecha no es correcto",
				},
				horasPrimerDiaPermiso: {
					required: "El campo es obligatorio.",
					number: "El dato debe ser numérico",
				},
				totalDiasPermiso: {
					required: "El campo es obligatorio.",
					number: "El dato debe ser numérico",
				},
			},
			highlight: function (e) {
				$(e)
					.closest(".form-group")
					.removeClass("has-info")
					.addClass("has-error");
			},
			success: function (e) {
				$(e).closest(".form-group").removeClass("has-error"); //.addClass('has-info');
				$(e).remove();
			},
			errorPlacement: function (error, element) {
				var name = element.attr("name");
				var errorSelector = '.validation_error_message[for="' + name + '"]';
				var $element = $(errorSelector);
				if ($element.length) {
					$(errorSelector).html(error.html());
				} else {
					error.insertAfter(element);
				}
			},
		});
	};

	let menuOptionClick = () => {
		$("li a").removeClass("active");
		$("li").removeClass("menu-open");
		$("#liAcciones").addClass("menu-open");
		$("#linkAcciones").addClass("active");
		$("#linkAddAcciones").addClass("active");
	};
	/*=========================================================================
	MÉTODO LLENAR EL FORMULARIO AL HCER CLIC EN UNA FILA DE LA TABLA
    ==========================================================================*/
	let llenarFormulario = (json) => {
		$.each(json, function (k, v) {
			$(`#${k}`).val(v);
		});
	};
	let actualizarEstado = (estado, id, tipoExcepcion) => {
		var parametros = {
			id: id,
			estado: estado,
			tipoExcepcion: tipoExcepcion,
		};
		$.ajax({
			type: "POST",
			dataType: "text",
			url: base_url + "AccionesPersonalController/actualizarEstado/",
			data: parametros,
			success: function (respuesta) {
				if (respuesta != 1) {
					myAlerts.myAlerts(
						"El registro no pudo ser modificado",
						"Error",
						"error"
					);
				} else {
					if (tipoExcepcion == 1) llenarTablaVacaciones();
					else if (tipoExcepcion == 2) llenarTablaIncapacidades();
					else if (tipoExcepcion == 3) llenarTablaAusencias();
					else llenarTablaPermisos();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(errorThrown);
			},
		});
	};
	return {
		init: init,
	};
})();
