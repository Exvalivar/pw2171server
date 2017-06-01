var iniciaApp = function(){
	//alert("hola Ripardo guapo PD:gracias");
	var entrar=function(){
		// alert($("#txtUsuario").val());
		// alert($("#txtClave").val());
		var usuario=$("#txtUsuario").val();
		var clave  =$("#txtClave").val();
		var parametros="opcion=valida"+
						"&usuario="+usuario+
						"&clave="+clave+
						"&id="+Math.random();
		var validaEntrada = $.ajax({
			method:"POST",
			url:"php/datos.php",
			data:parametros,
			dataType:"json"
		});
		validaEntrada.done(function(data){
			alert(data.respuesta);
			if(data.respuesta==true){
				$("#datosUsuario").hide("slow");
				$("nav").show("slow");
			}
		});
		validaEntrada.fail(function(jqError,textStatus){
			alert("Solicitud fallida: "+textStatus);
		});
	}
	var teclaUsuario=function(tecla){
		if(tecla.which==13){
			$("#txtClave").focus();
		}
	}
	var teclaClave=function(tecla){
		if(tecla.which==13){
			entrar();
		}
	}
	//sección de declaración de eventows
	$("#btnEntrar").on("click",entrar);
	$("#txtUsuario").on("keypress",teclaUsuario);
	$("#txtClave").on("keypress",teclaClave)
}
$(document).ready(iniciaApp);