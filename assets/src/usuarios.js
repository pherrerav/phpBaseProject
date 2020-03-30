import myAlerts from "./myAlerts";
export default APP.usuarios = (function() {
	let init = () => {
		menuOptionClick();
		llenarTabla();
		document.getElementById("userForm").addEventListener("submit", function(e) {
			e.preventDefault();
			ValidarFormulario();
			if ($("#userForm").valid()) {
				if (!$("#usuarioId").val()) GuardarUsuario();
				else ModificarUsuario();
			}
		});
	};
	let llenarTabla = () => {
		$("#fechaIngreso")
			.datepicker({ dateFormat: "yy-mm-dd" })
			.val();
		$("#DataTables").DataTable({
			bDestroy: true,
			processing: true,
			ajax: {
				url: base_url + "/UsuariosController/LlenarTablaUsuarios",
				dataSrc: "",
				error: function(jqXHR, textStatus, errorThrown) {
					$("#DataTables")
						.DataTable()
						.clear()
						.draw();
				}
			},
			dom: "Bfrtip",
			columnDefs: [
				{
					targets: [8],
					width: "5%",
					searchable: false
				},
				{
					targets: [6, 7],
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
						if (data.estado == 1)
							span = '<span class="right badge badge-success">Activo</span>';
						else
							span = '<span class="right badge badge-danger">Inactivo</span>';
						return span;
					}
				},
				{
					data: "usuario"
				},
				{
					data: "nombre"
				},
				{
					data: "apellidos"
				},
				{
					data: "fechaIngreso"
				},
				{
					data: "perfilNombre"
				},
				{
					data: "estado"
				},
				{
					data: "usuarioId"
				},
				{
					data: null,
					bSortable: false,
					mRender: function(o) {
						let botones =
							'<button  name ="editar" class="btn btn-info btn-xs"><i class="fa fa-edit fa-xs"></i> Editar</button> ';
						return botones;
					}
				}
			],
			buttons: [
				{
					text: '<i class="fa fa-plus"></i>',
					titleAttr: "Nuevo Usuario",
					action: function(e, dt, node, config) {
						$("#userForm")[0].reset();
						$("#btnGuardar").show();
						$("#usuarioModal").modal();
					}
				},
				{
					text: '<i class="fa fa-sync"></i>',
					titleAttr: "Actualizar",
					action: function(e, dt, node, config) {
						llenarTabla();
					}
				}
			]
		});
		$("#DataTables tbody").on("click", "button", function() {
			let table = $("#DataTables").DataTable();
			let action = this.name;
			let data = table.row($(this).parents("tr")).data();
			if (action == "editar") {
				$("#btnGuardar").show();
				llenarFormulario(data);
				$("#usuarioModal").modal();
			}
		});
	};
	let GuardarUsuario = () => {
		if ($("#userForm").valid()) {
			var parametros = {
				usuario: document.getElementById("usuario").value,
				nombre: document.getElementById("nombre").value,
				apellidos: document.getElementById("apellidos").value,
				perfiles: document.getElementById("perfiles").value,
				estado: document.getElementById("estado").value,
				fechaIngreso: document.getElementById("fechaIngreso").value
			};
			$.ajax({
				type: "POST",
				dataType: "text",
				url: base_url + "UsuariosController/agregarUsuario/",
				data: parametros,
				success: function(respuesta) {
					if (respuesta == -1) {
						myAlerts.myAlerts(
							"El registro no pudo ser almacenado",
							"Error",
							"error"
						);
					} else if (respuesta == -2)
						myAlerts.myAlerts(
							"Ya existe un registro con ese código de usuario",
							"Error",
							"error"
						);
					else {
						Cancelar();
						llenarTabla();
						myAlerts.myAlerts(
							"Registro almacenado satisfactoriamente",
							"Guardado",
							"success"
						);
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					alert(errorThrown);
				}
			});
		}
	};

	let ModificarUsuario = () => {
		if ($("#userForm").valid()) {
			var parametros = {
				usuarioId: document.getElementById("usuarioId").value,
				usuario: document.getElementById("usuario").value,
				nombre: document.getElementById("nombre").value,
				apellidos: document.getElementById("apellidos").value,
				perfiles: document.getElementById("perfiles").value,
				estado: document.getElementById("estado").value,
				fechaIngreso: document.getElementById("fechaIngreso").value
			};
			$.ajax({
				type: "POST",
				dataType: "text",
				url: base_url + "UsuariosController/modificarUsuario/",
				data: parametros,
				success: function(respuesta) {
					if (respuesta != 1) {
						myAlerts.myAlerts(
							"El registro no pudo ser modificado",
							"Error",
							"error"
						);
					} else {
						Cancelar();
						llenarTabla();
						myAlerts.myAlerts(
							"Registro modificado satisfactoriamente",
							"Modificado",
							"success"
						);
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					alert(errorThrown);
				}
			});
		}
	};
	let ValidarFormulario = () => {
		$("#userForm").validate({
			errorElement: "div",
			errorClass: "help-block",
			focusInvalid: false,
			ignore: "",
			rules: {
				usuario: {
					required: true
				},
				nombre: {
					required: true
				},
				apellidos: {
					required: true
				},
				perfiles: {
					required: true
				}
			},
			messages: {
				usuario: "El campo usuario es obligatorio.",
				nombre: "El campo nombre es obligatorio.",
				apellidos: "El campo apellidos es obligatorio.",
				perfiles: "El campo perfiles es obligatorio."
			},
			highlight: function(e) {
				$(e)
					.closest(".form-group")
					.removeClass("has-info")
					.addClass("has-error");
			},
			success: function(e) {
				$(e)
					.closest(".form-group")
					.removeClass("has-error"); //.addClass('has-info');
				$(e).remove();
			},
			errorPlacement: function(error, element) {
				var name = element.attr("name");
				var errorSelector = '.validation_error_message[for="' + name + '"]';
				var $element = $(errorSelector);
				if ($element.length) {
					$(errorSelector).html(error.html());
				} else {
					error.insertAfter(element);
				}
			}
		});
	};
	/*=========================================================================
	MÉTODO LLENAR EL FORMULARIO AL HCER CLIC EN UNA FILA DE LA TABLA
    ==========================================================================*/
	let llenarFormulario = json => {
		$.each(json, function(k, v) {
			$(`#${k}`).val(v);
		});
	};
	let Cancelar = () => {
		$("#userForm")[0].reset();
		$("#usuarioModal").modal("hide");
	};

	let menuOptionClick = () => {
		$("li a").removeClass("active");
		$("li").removeClass("menu-open");
		$("#liSeguridad").addClass("menu-open");
		$("#linkSeguridad").addClass("active");
		$("#linkUsuarios").addClass("active");
	};
	return {
		init: init
	};
})();
