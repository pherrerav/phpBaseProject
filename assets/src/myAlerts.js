import Swal from "sweetalert2";
export default APP.myAlerts = (function() {
	let Mensajes = (miMensaje, miTitulo, tipoMensaje) => {
		Swal.fire({
			icon: tipoMensaje,
			title: miTitulo,
			text: miMensaje
		});
	};
	return {
		myAlerts: Mensajes
	};
})();
