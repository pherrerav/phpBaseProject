import myAlerts from "./myAlerts";
import Swal from "sweetalert2";
export default APP.manualesOut = (function() {
	let init = () => {
		menuOptionClick();
		//Archivos();
		llenarTabla();
	};

	let llenarTabla = () => {
		let perfil = $("#PerfilId").val();
		let ComandButtons = [];
		if (perfil == 1)
			//administrador
			ComandButtons = [
				{
					text: '<i class="fa fa-plus"></i>',
					titleAttr: "Nuevo Manual",
					action: function(e, dt, node, config) {
						$("#manualModal").modal();
					}
				},
				{
					text: '<i class="fa fa-sync"></i>',
					titleAttr: "Actualizar",
					action: function(e, dt, node, config) {
						llenarTabla();
					}
				}
			];
		else
			ComandButtons = [
				{
					text: '<i class="fa fa-sync"></i>',
					titleAttr: "Actualizar",
					action: function(e, dt, node, config) {
						llenarTabla();
					}
				}
			];
		$("#DataTables").DataTable({
			bDestroy: true,
			processing: true,
			ajax: {
				url: base_url + "/ManualesController/listarArchivos/outsoursing",
				dataSrc: "",
				error: function(jqXHR, textStatus, errorThrown) {
					$("#DataTables")
						.DataTable()
						.clear()
						.draw();
				}
			},
			dom: "Bfrtip",

			columns: [
				{
					data: "manuales"
				},
				{
					data: null,
					bSortable: false,
					mRender: function(o) {
						let botones = "";
						if (perfil == 1)
							//administrador
							botones =
								'<button  name ="descargar" class="btn btn-info btn-xs"><i class="fa fa-download fa-xs"></i> Descargar</button> <button  name ="eliminar" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-xs"></i> Eliminar</button> ';
						else
							botones =
								'<button  name ="descargar" class="btn btn-info btn-xs"><i class="fa fa-download fa-xs"></i> Descargar</button>';
						return botones;
					}
				}
			],
			buttons: ComandButtons
		});
		$("#DataTables tbody").on("click", "button", function() {
			let table = $("#DataTables").DataTable();
			let action = this.name;
			let data = table.row($(this).parents("tr")).data();
			if (action == "descargar")
				window.location.href = `${base_url}/manuales_out_download/${data.manuales}`;
			else if (action == "eliminar") mensajeEliminar(data);
		});
	};
	let eliminarArchivo = archivo => {
		$.ajax({
			type: "POST",
			dataType: "text",
			url: `${base_url}/manuales_out_remove/${archivo.manuales}`,
			success: function(respuesta) {
				if (respuesta == 1) {
					llenarTabla();
					myAlerts.myAlerts(
						"Archivo cargado satisfactoriamente",
						"Eliminado",
						"success"
					);
				} else {
					myAlerts.myAlerts(
						"El archivo no pudo ser eliminado",
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
	let mensajeEliminar = archivo => {
		Swal.fire({
			title: "Seguro que desea eliminar el archivo?",
			text: "El archivo no se podrá recuperar!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Sí, eliminar!"
		}).then(result => {
			if (result.value) {
				eliminarArchivo(archivo);
			}
		});
	};
	let menuOptionClick = () => {
		$("li a").removeClass("active");
		$("li").removeClass("menu-open");
		$("#liManuales").addClass("menu-open");
		$("#linkManuales").addClass("active");
	};
	return {
		init: init
	};
})();
