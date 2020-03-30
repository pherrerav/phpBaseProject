import $ from "jquery";
import validate from "jquery-validation";
import myAlerts from "./myAlerts";

window.jQuery = $;
window.$ = $;
window.jquery = $;

APP.authentication = (function() {
	let init = () => {
		$("#loginForm").validate();
		document
			.getElementById("loginForm")
			.addEventListener("submit", function(e) {
				e.preventDefault();
				if ($("#loginForm").valid()) {
					accessValidation();
				}
			});
	};
	let accessValidation = () => {
		let parametros = {
			usuario: $("#usuario").val(),
			clave: $("#clave").val()
		};
		$.ajax({
			type: "POST",
			dataType: "text",
			url: `${base_url}AuthenticationController/AccessValidacion/`,
			data: parametros,
			success: function(respuesta) {
				if (respuesta == 1) window.location.href = `acciones/3`;
				else if (respuesta == -2)
					myAlerts.myAlerts("Usuario o calve incorrectos", "Error", "error");
				else if (respuesta == -1)
					myAlerts.myAlerts(
						"Usuario no existe o se encuentra inactivo",
						"Error",
						"error"
					);
				else
					myAlerts.myAlerts(
						"Hubo problemas con el servidor de autenticación",
						"Error",
						"error"
					);
			}
		});
	};
	//let ValidarFormulario = () => {
	$("#loginForm").validate({
		errorElement: "div",
		errorClass: "help-block",
		focusInvalid: false,
		ignore: "",
		rules: {
			usuario: {
				required: true
			},
			clave: {
				required: true
			}
		},
		messages: {
			usuario: "El campo usuario es obligatorio.",
			clave: "El campo clave es obligatorio."
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
	//};
	return {
		init: init
	};
})();

APP.authentication.init();
