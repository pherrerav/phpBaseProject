import myAlerts from "./myAlerts";
export default APP.perfiles = (function() {
	/*=========================================================================
          INICIALIZAR LA FUNCIÓN
      ==========================================================================*/
	let init = () => {
		menuOptionClick();
		llenarTabla();
		$("#tblPaginas").DataTable();
		document
			.getElementById("frmPerfiles")
			.addEventListener("submit", function(e) {
				e.preventDefault();
				if (!$("#perfilId").val()) agregarPerfil();
				else modificarPerfil();
			});
	};

	/*=========================================================================
          AGREGAR UN REGISTRO DE PERFIL A LA BASE DE DATOS
      ==========================================================================*/
	let agregarPerfil = () => {
		let myCheckboxes = ""; //GUARDAR LOS CHECKBOX MARCADOS EN UN ARREGLO
		$("#frmPerfiles input[type=checkbox]").each(function() {
			if (this.checked) myCheckboxes += $(this).attr("perfilId") + ", ";
		});
		let parametros = {
			perfil: document.getElementById("perfilNombre").value,
			myCheckboxes: myCheckboxes
		};
		$.ajax({
			type: "POST",
			dataType: "text",
			url: base_url + "PerfilesController/agregarPerfil/",
			data: parametros,
			success: function(respuesta) {
				if (respuesta == 1) {
					cancelar();
					myAlerts.myAlerts(
						"Registro almacenado satisfactoriamente",
						"Guardado",
						"success"
					);
				} else if (respuesta == -2) {
					myAlerts.myAlerts(
						"Ya existe ese perfil en el sistema",
						"Error",
						"error"
					);
				} else {
					myAlerts.myAlerts(
						"El registro no pudo ser almacenado",
						"Error",
						"error"
					);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert(errorThrown);
			}
		});
	};

	/*=========================================================================
          MODIFICAR UN REGISTRO DE PERFIL EN LA BASE DE DATOS
      ==========================================================================*/
	let modificarPerfil = () => {
		let myCheckboxes = ""; //GUARDAR LOS CHECKBOX MARCADOS EN UN ARREGLO
		$("#frmPerfiles input[type=checkbox]").each(function() {
			if (this.checked) myCheckboxes += $(this).attr("id") + ", ";
		});
		var parametros = {
			perfilId: document.getElementById("perfilId").value,
			//perfil: document.getElementById("perfilNombre").value,
			myCheckboxes: myCheckboxes
		};
		$.ajax({
			type: "POST",
			dataType: "text",
			url: base_url + "perfilesController/modificarPerfil/",
			data: parametros,
			success: function(respuesta) {
				if (respuesta == 1) {
					cancelar();
					myAlerts.myAlerts(
						"Registro modificado satisfactoriamente",
						"Modificado",
						"success"
					);
				} else {
					myAlerts.myAlerts(
						"El registro no pudo ser modificado",
						"Error",
						"error"
					);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert(errorThrown);
			}
		});
	};
	/*=========================================================================
          LLENAR LA TABLA DE PERFILES
      ==========================================================================*/
	let llenarTabla = () => {
		let table = $("#DataTables").DataTable({
			bDestroy: true,
			processing: true,
			ajax: {
				url: base_url + "perfilesController/llenarTablaPerfiles/",
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
					targets: [2],
					width: "5%",
					searchable: false
				},
				{
					targets: [0],
					visible: false,
					searchable: false
				}
			],
			columns: [
				{ data: "perfilId" },
				{ data: "perfilNombre" },
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
					titleAttr: "Nuevo Perfil",
					action: function(e, dt, node, config) {
						$("#frmPerfiles")[0].reset();
						$("#btnGuardar").show();
						$("#perfilModal").modal();
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
				$("#perfilModal").modal();
			}
		});
	};
	/*=========================================================================
          MÉTODO LLENAR EL FORMULARIO
      ==========================================================================*/
	let llenarFormulario = json => {
		$("#frmPerfiles")[0].reset();
		let IdPerfil = json.perfilId;
		let perfilNombre = json.perfilNombre;
		document.getElementById("perfilId").value = IdPerfil;
		document.getElementById("perfilNombre").value = perfilNombre;
		$.ajax({
			type: "POST",
			dataType: "json",
			url: base_url + "perfilesController/consultaPerfiles/",
			data: {
				IdPerfil: IdPerfil
			},
			success: function(respuesta) {
				respuesta = JSON.stringify(respuesta);
				let paginas = $.parseJSON(respuesta);
				$(function() {
					paginas = eval(paginas);
					for (let i in paginas) {
						document.getElementById(paginas[i]["paginaId"]).checked = true;
					}
				});
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert(errorThrown);
			}
		});
	};

	/*=========================================================================
          MÉTODO QUE SE ENCARGA DE LIMPIAR EL FORMULARIO Y CERRAR EL MODAL
      ==========================================================================*/
	let cancelar = () => {
		$("#frmPerfiles")[0].reset();
		$("#perfilModal").modal("hide");
		llenarTabla();
	};
	let menuOptionClick = () => {
		$("li a").removeClass("active");
		$("li").removeClass("menu-open");
		$("#liSeguridad").addClass("menu-open");
		$("#linkSeguridad").addClass("active");
		$("#linkPerfiles").addClass("active");
	};
	return {
		init: init
	};
})();
